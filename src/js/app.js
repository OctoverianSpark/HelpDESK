import { Information } from './Class/Information.js'
import Particle from './Class/Particle.js'
import { TOAST } from './GLOBALS.js'
import { Chart } from 'chart.js'

Chart.defaults.font.family = 'Athiti'
Chart.defaults.backgroundColor = [
  'rgba(255, 99, 132, 1)',
  'rgb(93, 95, 226)',
  'rgba(255, 206, 86, 1)',
  'rgba(75, 192, 192, 1)',
  'rgba(153, 102, 255,1)',
  'rgba(255, 159, 64, 1)'
]

Chart.defaults.borderColor = [
  'rgba(255, 99, 132, 1)',
  'rgb(36, 81, 110)',
  'rgba(255, 206, 86, 1)',
  'rgb(39, 88, 88)',
  'rgba(153, 102, 255, 1)',
  'rgba(255, 159, 64, 1)'
]
console.log('App.js loaded')

function loginBackground () {
  const canvas = document.querySelector('.loginCanvas')

  if (!canvas) return

  const ctx = canvas.getContext('2d')

  canvas.width = innerWidth
  canvas.height = innerHeight

  let bolas = []
  for (let i = 0; i < 30; i++) {
    bolas.push(new Particle(canvas, canvas.width / 2, canvas.height / 2))
  }

  function animar () {
    ctx.clearRect(0, 0, canvas.width, canvas.height)

    bolas.forEach(Particle => {
      bolas.forEach(target => {
        let dx = target.x - Particle.x
        let dy = target.y - Particle.y
        let dist = Math.sqrt(dx ** 2 + dy ** 2)

        if (dist < 100) {
          ctx.beginPath()
          ctx.moveTo(Particle.x, Particle.y)
          ctx.lineTo(target.x, target.y)
          ctx.stroke()
          ctx.strokeStyle = '#2b0c7e'
          ctx.closePath()
        }
      })

      Particle.draw()
      Particle.move()
    })

    requestAnimationFrame(animar)
  }

  animar()
}

function showPswrd () {
  const psswrd = document.querySelector('#psswrd')
  const showPsswrdBtn = document.querySelector('.pswrd-btn')
  if (!showPsswrdBtn) return
  console.log(showPsswrdBtn)

  const icon = showPsswrdBtn.querySelector('i')
  showPsswrdBtn.addEventListener('click', e => {
    if (psswrd.type == 'password') {
      psswrd.type = 'text'
      icon.classList.remove('bi-eye-fill')
      icon.classList.add('bi-eye-slash-fill')
    } else {
      psswrd.type = 'password'
      icon.classList.remove('bi-eye-slash-fill')
      icon.classList.add('bi-eye-fill')
    }
  })
}

function notificarClickup () {
  const form = document.querySelector('.tickets-user-form')

  if (!form) return

  form.addEventListener('submit', e => {
    const api = 'pk_82319104_47GHX06YGVUDO4QUAIYXJAET4U5B4ZLW'

    const listId = '901408875624'

    const resp = fetch(`https://api.clickup.com/api/v2/list/${listId}/task`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: api
      },
      body: JSON.stringify({
        name: 'Ticket Creado',
        description: 'Revisar aplicacion de tickets'
      })
    })
  })
}

function modalKEY () {
  const modals = document.querySelectorAll('.modal')
  if (!modals.length > 0) return
  console.log(modals)

  document.addEventListener('keydown', e => {
    if (e.key.toLowerCase() === 'escape') {
      modals.forEach(modalElement => {
        if (modalElement.classList.contains('active')) {
          modalElement.classList.remove('active')
        }
      })
    }
  })
  modals.forEach(modal => {
    modal.addEventListener('click', e => {
      if (e.target === modal) modal.classList.remove('active')
    })
  })
}

function registerServiceWorker () {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
      .register('../../sw.js')
      .then(registration => {
        console.log('Service Worker registered with scope:', registration.scope)
      })
      .catch(error => {
        console.log('Service Worker registration failed:', error)
      })
  }
}

function setupDarkLightMode () {
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
  const savedTheme = localStorage.getItem('theme')
  const toggle = document.querySelector('.theme-btn')
  const icon = toggle.querySelector('i')

  const root = document.documentElement

  function setTheme (theme) {
    if (theme === 'dark') {
      root.setAttribute('data-theme', 'dark')
      icon.classList.replace('bi-moon-fill', 'bi-sun-fill')
    } else {
      root.setAttribute('data-theme', 'light')
      icon.classList.replace('bi-sun-fill', 'bi-moon-fill')
    }
    localStorage.setItem('theme', theme)
  }

  // Initialize theme
  if (savedTheme) {
    setTheme(savedTheme)
  } else {
    setTheme(prefersDark ? 'dark' : 'light')
  }

  toggle.addEventListener('click', e => {
    const theme = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark'
    root.setAttribute('data-theme', theme)
    localStorage.setItem('theme', theme)

    if (theme === 'dark') {
      icon.classList.replace('bi-moon-fill', 'bi-sun-fill')
    } else {
      icon.classList.replace('bi-sun-fill', 'bi-moon-fill')
    }
  })
}

async function openRDPModal () {
  const usersBTN = document.querySelectorAll('.usr-btn')
  const UsrMdl = document.querySelector('.user-detail-modal')
  if (!UsrMdl) return

  usersBTN.forEach(btn => {
    btn.addEventListener('click', async e => {
      const id = btn.getAttribute('data-id')

      const query = await Information.postJSON('/admin/server_users/find', {
        id: id
      })

      const rdpContent = `
            screen mode id:i:2
            desktopwidth:i:1920
            desktopheight:i:1080
            session bpp:i:32
            full address:s:${query.server.ip}
            username:s:${query.user.username}
            prompt for credentials:i:1
            audio mode:i:2
            redirectclipboard:i:1
            redirectprinters:i:1
            redirectcomports:i:0
            redirectsmartcards:i:1`

      UsrMdl.classList.remove('hidden')

      Object.entries(query.user).forEach(([key, value]) => {
        if (key === 'server_id') return

        if (key === 'id') {
          const dltbtn = UsrMdl.querySelector('.delete-usr-btn')
          const updatebtn = UsrMdl.querySelector('.update-usr-btn')

          dltbtn.setAttribute('data-id', value)
          updatebtn.setAttribute('data-id', value)
          return
        }

        const span = UsrMdl.querySelector(`#${key}`)

        span.textContent = value
      })

      document.querySelector('#server').textContent = ' ' + query.server.ip

      const rdpBTN = document.querySelector('.download-rdp')

      rdpBTN.addEventListener('click', e => {
        const blob = new Blob([rdpContent], { type: 'aplication/rdp' })
        const url = URL.createObjectURL(blob)

        const a = document.createElement('a')
        a.href = url
        a.download = 'conexion.rdp'
        document.body.appendChild(a)
        a.click()
        document.body.removeChild(a)
        URL.revokeObjectURL(url)
      })
    })
  })
}

function inputRangeTitle () {
  const rangeConts = document.querySelectorAll('.range-wth-title')

  const keys = {
    1: 'Muy Deficiente',
    2: 'Deficiente',
    3: 'Aceptable',
    4: 'Bueno',
    5: 'Excelente'
  }

  rangeConts.forEach(container => {
    const range = container.querySelector('input')
    const value = container.querySelector('.value')

    range.addEventListener('input', e => {
      value.textContent = e.target.value + ' - ' + keys[e.target.value]
    })
  })
}

function setRanges () {
  const form = document.querySelector('.satisfaction-form')

  if (!form) return

  const containers = document.querySelectorAll('.indv-test')

  containers.forEach(container => {
    const ranges = container.querySelectorAll("input[type='range']")

    const yesno = container.querySelectorAll('.yes-no-radio')

    yesno.forEach(element => {
      const radio = element.querySelector('input')

      radio.addEventListener('input', e => {
        if (e.target.value === 'si')
          ranges.forEach(range => (range.disabled = false))
        if (e.target.value === 'no')
          ranges.forEach(range => (range.disabled = true))
      })
    })
  })
}

function manageSidebar () {
  const sidebar = document.querySelector('.menu-sidebar')
}

document.addEventListener('DOMContentLoaded', e => {
  manageSidebar()
  loginBackground()
  showPswrd()
  notificarClickup()
  modalKEY()
  registerServiceWorker()
  openRDPModal()
  inputRangeTitle()
  setRanges()
  setupDarkLightMode()

  const urlParams = new URLSearchParams(window.location.search)
  const errorParam = urlParams.get('err')

  if (errorParam == 4) {
    console.error(`Error: ${errorParam}`)
    TOAST(`El nombre del equipo ya existe!!!`, 'center', '#')
  }
})

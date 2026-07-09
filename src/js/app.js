import { Information } from './Class/Information.js'
import Particle from './Class/Particle.js'
import { TOAST } from './GLOBALS.js'
import { Chart } from 'chart.js'
import { safeFetch, sleep } from './GLOBALS.js'

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
    const api = 'pk_82319104_T6BX3F3VC93FCDSY12579HIGOR2U59BN'

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

function inventorySync () {
  const api = 'pk_82319104_T6BX3F3VC93FCDSY12579HIGOR2U59BN'

  const syncBTN = document.querySelector('#sync-btn')

  syncBTN.addEventListener('click', async e => {
    TOAST('Sincronizando...')

    const toFind = {
      marca: 'MARCA',
      modelo: 'MODELO',
      color: 'COLOR',
      serial: 'SERIAL',
      correo_dominio: 'CORREO',
      propietario: 'PROPIETARIO',
      area: 'DEPARTAMENTO'
    }
    const listId = '901409642306'

    let DB = await fetch('/inventory/get/all')
    DB = await DB.json()
    let allTasks = []
    let page = 0
    let lastPage = false

    while (!lastPage) {
      const res = await safeFetch(
        `https://api.clickup.com/api/v2/list/${listId}/task?page=${page}`,
        { headers: { accept: 'application/json', Authorization: api } }
      )
      const data = await res.json()
      allTasks.push(...data.tasks)
      lastPage = data.last_page
      page++
      await sleep(300) // pausa entre páginas
    }
    const CU = { tasks: allTasks }

    TOAST(
      'Sincronizando equipos, no salgas de esta zona hasta acabar la sincronizacion'
    )
    for (const dbItem of DB) {
      const task = CU.tasks.find(cuItem => cuItem.name === dbItem.nombre_equipo)
      if (!task) {
        console.log(`➕ Creando nuevo Task para: ${dbItem.nombre_equipo}`)

        // Determinar status según state
        const statusDB = dbItem.state === 0 ? 'STOCK' : 'ASIGNADO'

        // Preparar custom fields usando el objeto toFind
        const customFields = Object.entries(toFind)
          .map(([dbKey, cuName]) => {
            const cuField = CU.tasks[0]?.custom_fields.find(
              field => field.name === '🖥️ ' + cuName
            )
            if (!cuField) return null

            let newValue = dbItem[dbKey]

            if (cuField.type === 'drop_down') {
              const options = cuField.type_config?.options || []
              const option = options.find(
                opt => opt.name.toLowerCase() === String(newValue).toLowerCase()
              )
              if (!option) {
                console.log(
                  `⚠️ No se encontró opción "${newValue}" para el drop_down "${cuField.name}"`
                )
                return null
              }
              newValue = option.id // 👈 UUID requerido por ClickUp
            }

            return { id: cuField.id, value: newValue }
          })
          .filter(Boolean)

        await fetch(`https://api.clickup.com/api/v2/list/${listId}/task`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Authorization: api
          },
          body: JSON.stringify({
            name: dbItem.nombre_equipo,
            status: statusDB,
            custom_fields: customFields
          })
        })
          .then(r => r.json())
          .then(r => console.log('✅ Task creado:', r))
          .catch(err => console.error('❌ Error creando task:', err))

        await sleep(300)
        continue
      }

      console.log(`✅ Coincidencia encontrada: ${task.name}`)

      // 1. Actualizar custom fields
      for (const [dbKey, cuName] of Object.entries(toFind)) {
        const value = dbItem[dbKey]

        const cf = task.custom_fields.find(
          field => field.name === '🖥️ ' + cuName
        )
        if (!cf) {
          console.log(
            `⚠️ Task ${task.id} no tiene el campo personalizado "${cuName}"`
          )
          continue
        }

        let newValue = value

        if (cf.type === 'drop_down') {
          const options = cf.type_config?.options || []

          // Buscar opción por nombre
          const option = options.find(opt => {
            const optName = opt.name

            return optName.toLowerCase() == value.toLowerCase()
          })
          console.log(option)

          if (!option) {
            console.log(
              `⚠️ No se encontró opción "${value}" en el drop_down de "${cf.name}"`
            )
            continue
          }

          newValue = option.id // 👈 usar UUID de la opción
        }

        if (cf.value != newValue) {
          console.log(
            `🔄 Actualizando Task ${task.id} → Campo "${cf.name}" de "${cf.value}" a "${value}" (interno enviado: ${newValue})`
          )

          await fetch(
            `https://api.clickup.com/api/v2/task/${task.id}/field/${cf.id}`,
            {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                Authorization: api
              },
              body: JSON.stringify({ value: newValue })
            }
          )
            .then(r => r.json())
            .then(r => console.log('✅ Campo actualizado:', r))
            .catch(err => console.error('❌ Error actualizando campo:', err))
          await sleep(300)
        }
      }
    }

    for (const task of CU.tasks) {
      const existeEnDB = rentDB.some(
        dbItem => dbItem.nombre_equipo === task.name
      )

      if (!existeEnDB && task.status.status.toUpperCase() !== 'DADO DE BAJA') {
        console.log(
          `⚠️ Task ${task.id} (${task.name}) no existe en DB → cambiando a "DADO DE BAJA"`
        )

        await fetch(`https://api.clickup.com/api/v2/task/${task.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            Authorization: api
          },
          body: JSON.stringify({ status: 'DADO DE BAJA' })
        })
          .then(r => r.json())
          .then(r => console.log('✅ Task marcado como DADO DE BAJA:', r))
          .catch(err => console.error('❌ Error actualizando status:', err))
      }
      await sleep(300)
    }
    setTimeout(() => {
      TOAST('Sincronizacion Completada')
    }, 1000)
  })
}
function bulkInventoryActions () {
  const table = document.querySelector('.table-inv-admin')
  const bar = document.querySelector('#bulk-actions-bar')
  const selectAll = document.querySelector('#bulk-select-all')

  if (!table || !bar) return

  const selected = new Set()

  function refreshBar () {
    document.querySelector('#bulk-selected-count').textContent = selected.size
    bar.hidden = selected.size === 0
    if (selected.size === 0 && selectAll) selectAll.checked = false
  }

  table.addEventListener('change', e => {
    if (!e.target.classList.contains('bulk-select-row')) return
    const id = e.target.getAttribute('cell-id')
    if (e.target.checked) selected.add(id)
    else selected.delete(id)
    refreshBar()
  })

  if (selectAll) {
    selectAll.addEventListener('change', e => {
      const rowChecks = table.querySelectorAll('.bulk-select-row')
      rowChecks.forEach(chk => {
        chk.checked = e.target.checked
        const id = chk.getAttribute('cell-id')
        if (e.target.checked) selected.add(id)
        else selected.delete(id)
      })
      refreshBar()
    })
  }

  async function runBulk (action) {
    const res = await fetch('/admin/inventario/bulk', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ ids: Array.from(selected), action })
    })
    const data = await res.json()
    if (!data.ok) {
      TOAST(data.error || 'No se pudo completar la accion en bloque')
      return
    }
    TOAST('Accion en bloque completada')
    location.reload()
  }

  document.querySelector('#bulk-stock-btn').addEventListener('click', () => {
    if (!confirm(`¿Pasar ${selected.size} equipo(s) a stock?`)) return
    runBulk('stock')
  })

  document.querySelector('#bulk-delete-btn').addEventListener('click', () => {
    if (!confirm(`¿Eliminar ${selected.size} equipo(s)? Esta accion no se puede deshacer.`)) return
    runBulk('delete')
  })
}
function tracerSync () {
  const btn = document.querySelector('#tracer-sync-btn')
  if (!btn) return

  btn.addEventListener('click', async e => {
    btn.disabled = true
    TOAST('Sincronizando con Tracer...')

    try {
      const res = await fetch('/admin/inventario/sync/tracer', { method: 'POST' })
      const data = await res.json()

      if (!data.ok) {
        TOAST(data.error || 'Error al sincronizar con Tracer')
        return
      }

      TOAST(
        `Sincronizacion completada: ${data.created} nuevos, ${data.updated} actualizados` +
          (data.errors ? `, ${data.errors} con error` : '')
      )
    } catch (err) {
      console.error('❌ Error sincronizando con Tracer:', err)
      TOAST('No se pudo contactar al servidor')
    } finally {
      btn.disabled = false
    }
  })
}
document.addEventListener('DOMContentLoaded', e => {
  inventorySync()
  tracerSync()
  bulkInventoryActions()
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

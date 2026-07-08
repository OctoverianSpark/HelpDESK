import { Information } from './Class/Information.js'
import { Element } from './Class/Element.js'
import {
  GENCONTAINER,
  RADIOCARD,
  INPUTGROUP,
  TOAST,
  cleanPers
} from './GLOBALS.js'

console.log('BackEnd.js loaded')

function select () {
  const wrappers = document.querySelectorAll('.selector-wrapper')

  wrappers.forEach(wrapper => {
    wrapper.addEventListener('click', e => {
      wrapper.classList.toggle('active')
      const search = wrapper.querySelector('.filter')

      const optionsList = wrapper.querySelector('.options')
      const options = optionsList.querySelectorAll('.option')

      let result = []
      options.forEach(option => {
        const span = option.querySelector('span')
        const input = option.querySelector('input')

        input.addEventListener('input', e => {
          search.value = span.textContent
          wrapper.classList.remove('active')
        })
      })

      search.oninput = e => {
        result = []

        options.forEach(element => {
          element.style.display = 'none'
        })

        if (e.target.value.length) {
          Array.from(options).filter(keyword => {
            const option = keyword.querySelector('span')
            const input = keyword.querySelector('input')

            if (
              option.textContent
                .toLowerCase()
                .includes(e.target.value.toLowerCase())
            ) {
              result.push(keyword)
            }
          })
        }

        result.forEach(element => {
          element.removeAttribute('style')
        })
      }
    })
  })
}

function orderUpdateAction () {
  const form = document.querySelector('.order-type-form')
  if (!form) return
  form.addEventListener('input', e => {
    location.href = '/admin/ordenes/crear?type=' + e.target.value
  })
}
function printActions () {
  const container = document.querySelector('.doc-order')

  if (!container) return

  window.addEventListener('beforeprint', e => {
    container.classList.add('printing')
  })
  window.addEventListener('afterprint', e => {
    container.classList.remove('printing')
  })
}

function blockSubmit () {
  const form = document.querySelector('form')

  if (!form) return

  form.addEventListener('submit', e => {
    const btn =
      form.querySelector('.btn-submit') ?? form.querySelector('.btn-send')

    TOAST('Estamos enviando tu informacion, por favor espere....', 'center')
    btn.disabled = true
  })
}

function inhabilitate () {
  const checkbox = document.querySelectorAll('.dsb-check')

  checkbox.forEach(check => {
    check.addEventListener('input', e => {
      const inputs =
        check.parentNode.parentNode.querySelectorAll("input[type='text']")
      inputs.forEach(input => {
        input.disabled = e.target.checked
      })
    })
  })
}

function orderRadioSelector () {
  const container = document.querySelector('.container-grid-selector')
  if (!container) return

  const selectors = container.querySelectorAll(
    ".radio-label-card input[type='radio']"
  )

  selectors.forEach(sel => {
    sel.addEventListener('input', e => {
      selectors.forEach(s => {
        if (!s.checked) {
          s.parentNode.remove()
        }
      })
    })
  })
}

function persGET () {
  const container = document.querySelector('.ord-form')

  $('#computer_id').on('select2:select', async function (e) {
    const user_id = $(this).val()
    console.log('Seleccionado:', user_id)

    const pers = await Information.postJSON('/admin/pers/find', {
      user_id
    })

    let monitors = pers.filter(e => {
      if (e.tipo == 'MONITOR') {
        return e
      }
    }).length

    pers.forEach(per => {
      console.log(per.tipo)

      if (per.tipo === 'MONITOR') {
        const check = container.querySelector(
          `#no-${per.tipo.toLowerCase()}-${monitors}`
        )
        const marca = container.querySelector(
          `#${per.tipo.toLowerCase()}-${monitors}-marca`
        )
        const modelo = container.querySelector(
          `#${per.tipo.toLowerCase()}-${monitors}-modelo`
        )
        const serial = container.querySelector(
          `#${per.tipo.toLowerCase()}-${monitors}-serial`
        )

        monitors--

        check.checked = false
        marca.value = per.marca
        modelo.value = per.modelo
        serial.value = per.serial
        marca.disabled = check.checked
        modelo.disabled = check.checked
        serial.disabled = check.checked
      } else {
        const check = container.querySelector(`#no-${per.tipo.toLowerCase()}`)
        const marca = container.querySelector(
          `#${per.tipo.toLowerCase()}-marca`
        )
        const modelo = container.querySelector(
          `#${per.tipo.toLowerCase()}-modelo`
        )
        const serial = container.querySelector(
          `#${per.tipo.toLowerCase()}-serial`
        )

        check.checked = false
        marca.value = per.marca
        modelo.value = per.modelo
        serial.value = per.serial
        marca.disabled = check.checked
        modelo.disabled = check.checked
        serial.disabled = check.checked
      }
    })
  })
}

async function ticketUpdate() {
  try {
    
  const viewMdl = document.querySelector('.tickets-view')
  if (!viewMdl) return

  const form = viewMdl.querySelector('.ticket-admin-form')

  form.addEventListener('submit', async e => {
    e.preventDefault()
    TOAST('Actualizando ticket...', 'right')
    const body = buildFormBody(form)

    const ticket = await Information.postJSON('/tickets/find', { id: body.id })

    applyStateTransitionTimestamps(body, ticket)

    const query = await Information.postJSON('/admin/tickets/update', body)

    TOAST('Recibiendo informacion...', 'right')

    updateTableRow(body.id, query.data)

    TOAST(query.message, 'right')
  })
  } catch (error) {
    console.log(error);
  }
}

function buildFormBody(form) {
  const app = document.querySelector('#app')
  const body = {}
  new FormData(form).forEach((value, key) => {
    body[key] = key === 'subcategoria' && !app.disabled
      ? `${value}(${app.value})`
      : value
  })

  body.solucion = document.querySelector('#solucion').textContent

  return body
}

function toISOLocalString(date) {
  return date.toISOString().split('.')[0].replace('T', ' ')
}

function applyStateTransitionTimestamps(body, ticket) {
  const currentState = ticket.estado.toLowerCase()
  const nextState = body.estado

  const transitions = {
    'sin asignar': {
      'en proceso': () => {
        const now = toISOLocalString(new Date())
        body.fecha_asignada = now
        body.tiempo_en_asignar = Math.floor(calculateTime(ticket.fecha, now) - 300)
      }
    },
    'en proceso': {
      'completado': () => {
        const now = toISOLocalString(new Date())
        body.fecha_completacion = now
        body.tiempo_en_completar = Math.floor(calculateTime(ticket.fecha_asignada, now))
      },
      'pendiente': () => {
        const now = toISOLocalString(new Date())
        body.fecha_pendiente = now
        body.tiempo_en_pendiente = Math.floor(calculateTime(ticket.fecha_asignada, now))
      }
    },
    'pendiente': {
      'completado': () => {
        const now = toISOLocalString(new Date())
        body.fecha_completacion = now
        body.tiempo_en_completar = Math.floor(calculateTime(ticket.fecha_pendiente, now))
      }
    }
  }

  transitions[currentState]?.[nextState]?.()
}

function updateTableRow(id, data) {
  const row = document.querySelector(`.table-row[data-id='${id}']`)
  if (!row) return

  Object.entries(data).forEach(([key, value]) => {
    if (key === 'id') return
    const cell = row.querySelector(`.cell[data-col='${key}']`)
    if (cell) cell.textContent = value.toUpperCase()
  })
}
function calculateTime (from, to) {
  /**
   * Calculates the time in minutes between two dates
   *
   *
   * @param {String} from - The date from wich the time will be calculated
   * @param {String} to - The date to wich the time will be calculated
   *
   * @return {Number} - The time in minutes between the two dates
   * If the from is mayor than the to, the function will return negative minutes, if the from is less than the to, the function will return positive minutes
   *
   */

  const fromDATE = new Date(from).getTime()
  const toDATE = new Date(to).getTime()

  let diff = toDATE - fromDATE

  console.log(diff / 60000)

  diff = diff / 60000

  console.log(diff)

  return diff
}

async function updateOrder () {
  const inputSign = document.querySelector('#sign')
  const canvas = document.querySelector('.sign-canvas-replica')
  const form = document.querySelector('.sign-form')
  if (!inputSign) return

  let dataURL = ''

  const ctx = canvas.getContext('2d')

  let fontSize = 150
  ctx.font = `${fontSize}px Imperial Script`
  ctx.fillStyle = 'black'
  ctx.textBaseline = 'top'
  ctx.textAlign = 'left'

  dataURL = canvas.toDataURL('image/png')
  canvas.toBlob(function (blob) {
    const formData = new FormData()
    formData.append('sign', blob, 'sign.png')

    fetch('/admin/ordenes/print', {
      method: 'POST',
      body: formData
    })
      .then(data => {
        console.log('Imagen guardada')
      })
      .catch(error => {
        console.error('Error al guardar imagen:', error)
      })
  }, 'image/png')

  inputSign.oninput = e => {
    ctx.clearRect(0, 0, canvas.width, canvas.height)

    ctx.fillText(e.target.value, 10 * 2, 100)

    let dataURL = canvas.toDataURL('image/png')

    canvas.toBlob(function (blob) {
      const formData = new FormData()
      formData.append('sign', blob, 'sign.png')

      fetch('/admin/ordenes/print', {
        method: 'POST',
        body: formData
      })
        .then(data => {
          console.log('Imagen guardada')
        })
        .catch(error => {
          console.error('Error al guardar imagen:', error)
        })
    }, 'image/png')
  }

  form.addEventListener('submit', async e => {
    e.preventDefault()
    const formData = new FormData(e.target)

    let body = {}

    formData.entries().forEach(([key, value]) => {
      if (key === 'sign') return
      body[key] = value
    })

    const query = await Information.postJSON('/admin/ordenes/print', body)
    console.log(query)
    location.href = ''
  })
}

function sendOrderInformation () {
  const form = document.querySelector('.ord-form')

  if (!form) return

  form.addEventListener('submit', async e => {
    e.preventDefault()
    Object.entries(localStorage).forEach(([key, value]) => {
      localStorage.removeItem(key)
    })

    const formData = new FormData(form)

    let body = {
      mouse: {
        marca: '',
        modelo: '',
        serial: ''
      },
      diademas: {
        marca: '',
        modelo: '',
        serial: ''
      },
      teclado: {
        marca: '',
        modelo: '',
        serial: ''
      },
      monitor: {
        marca: '',
        modelo: '',
        serial: ''
      },
      'monitor-2': {
        marca: '',
        modelo: '',
        serial: ''
      },
      features: formData.getAll('features')
    }

    formData.entries().forEach(([key, value]) => {
      if (key === 'order_id' || key === 'type') {
        body[key] = value
      }

      if (key.includes('mouse')) {
        let k = key.replace('mouse[', '')
        k = k.replace(']', '')
        body['mouse'][k] = value

        return
      } else if (key.includes('diademas')) {
        let k = key.replace('diademas[', '')
        k = k.replace(']', '')

        body['diademas'][k] = value

        return
      } else if (key.includes('teclado')) {
        let k = key.replace('teclado[', '')
        k = k.replace(']', '')

        body['teclado'][k] = value

        return
      } else if (key.includes('monitor') && !key.includes('-2')) {
        let k = key.replace('monitor[', '')
        k = k.replace(']', '')

        body['monitor'][k] = value

        return
      } else if (key.includes('monitor-2')) {
        let k = key.replace('monitor-2[', '')
        k = k.replace(']', '')

        body['monitor-2'][k] = value

        return
      } else if (
        key === 'user_id' ||
        key === 'computer_id' ||
        key === 'emitted_date'
      ) {
        body[key] = value
      }
    })

    if (!body['features']) body['features'] = []

    body = cleanPers(body)

    const q = await fetch(location.href, {
      method: 'POST',
      body: JSON.stringify(body)
    })
    if (formData.get('type') === 'recepcion') {
      const blob = await q.blob()
      const url = URL.createObjectURL(blob)

      const a = document.createElement('a')
      a.href = url
      a.download = 'documento.docx'
      a.click()
    } else {
      console.log(await q.json())
      TOAST(
        'Hemos enviado un correo al firmante de la orden, espera a su firma...',
        'center',
        '#'
      )
    }
  })
}

function openSignView () {
  const doc = document.querySelector('.doc-order')
  if (!doc) return
  const signButton = document.querySelector('.sign-button')

  TOAST('Click aqui para bajar a la firma', 'center', '#sign-button')

  signButton.addEventListener('click', e => {
    const signModal = document.querySelector('.data-form')

    signModal.classList.remove('hidden')
  })
}

async function setEntries () {
  const entriesContainer = document.querySelector('.entries')

  if (!entriesContainer) return

  const entries = entriesContainer.querySelectorAll('.checkbox-card')

  entries.forEach(entry => {
    const input = entry.querySelector('input')

    input.addEventListener('input', async e => {
      const value = e.target.checked ? 'si' : 'no'

      const q = await Information.postJSON('/admin/entradas/set', {
        id: e.target.value,
        mostrar: value
      })
    })
  })
}

function submitEntryForm () {
  const Mdl = document.querySelector('.entry-form')

  if (!Mdl) return

  const form = Mdl.querySelector('form')

  form.addEventListener('submit', async e => {
    e.preventDefault()
    TOAST('Actualizando Informacion....', 'center', '#')

    const formData = new FormData(e.target)

    let body = {}

    formData.entries().forEach(([key, value]) => {
      body[key] = value
    })

    const q = await Information.postJSON('/admin/entradas/save', body)

    location.reload()
  })
}

document.addEventListener('DOMContentLoaded', e => {
  select()
  inhabilitate()
  orderRadioSelector()
  printActions()
  persGET()
  ticketUpdate()
  blockSubmit()
  updateOrder()
  sendOrderInformation()
  openSignView()
  setEntries()
  submitEntryForm()
  orderUpdateAction()
})

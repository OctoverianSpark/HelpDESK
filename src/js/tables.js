import { TOAST } from './GLOBALS.js'
import {
  openDocumentationView,
  viewAdminTicket,
  ticketImgModal,
  openInventoryView
} from './views.js'

console.log('SCRIPT Tables.js LOADED')

/* Tables */
const perPage = 50

function renderPagination (actual, total, onPageChange) {
  const contenedor = document.getElementById('pagination')
  contenedor.innerHTML = ''

  const maxVisible = 5
  let start = Math.max(1, actual - Math.floor(maxVisible / 2))
  let end = start + maxVisible - 1

  if (end > total) {
    end = total
    start = Math.max(1, end - maxVisible + 1)
  }

  if (actual > 1) {
    const btnPrev = document.createElement('button')
    btnPrev.classList.add('prev-btn')
    btnPrev.onclick = () => onPageChange(actual - 1)
    btnPrev.innerHTML = `<i class="bi bi-chevron-left"></i>`
    contenedor.appendChild(btnPrev)
  }

  for (let i = start; i <= end; i++) {
    const btn = document.createElement('button')
    btn.textContent = i
    btn.classList.add('page-btn')
    if (i === actual) btn.style.fontWeight = 'bold'
    btn.onclick = () => onPageChange(i)
    contenedor.appendChild(btn)
  }

  if (actual < total) {
    const btnNext = document.createElement('button')
    btnNext.classList.add('next-btn')
    btnNext.innerHTML = `<i class="bi bi-chevron-right"></i>`
    btnNext.onclick = () => onPageChange(actual + 1)
    contenedor.appendChild(btnNext)
  }
}

function chargeData ({
  url,
  page = 1,
  perPage = 20,
  containerSelector,
  renderRow,
  query,
  onRendered = () => {}
}) {
  const params = new URLSearchParams(query).toString()

  fetch(
    `${url}?page=${page}&limit=${perPage}${params != '' ? '&' + params : ''}`
  )
    .then(res => res.json())
    .then(json => {
      const container = document.querySelector(containerSelector)
      if (!container) return
      console.log(json)

      // Limpia las filas existentes (excepto cabecera)
      container
        .querySelectorAll('.table-row:not(.table-header)')
        .forEach(row => row.remove())

      // Renderiza cada fila usando el callback
      json.data.forEach(data => {
        const row = renderRow(data)
        container.appendChild(row)
      })

      // Renderiza la paginación
      renderPagination(json.page, json.pages, newPage => {
        chargeData({
          url,
          page: newPage,
          perPage,
          containerSelector,
          renderRow,
          onRendered
        })
      })

      // Ejecuta lógica extra (eventos, modales, etc.)
      onRendered(json)
    })
}

function renderTicketRow (
  ticket,
  columns = ['categoria', 'usuario', 'estado', 'prioridad', 'tecnico']
) {
  const row = document.createElement('div')
  row.classList.add('table-row')
  row.dataset.id = ticket.id

  // --- ID con botones ---
  const cellId = document.createElement('div')
  cellId.className = 'cell'

  const actions = [
    {
      class: 'view-mdl-btn',
      title: 'Ver Ticket',
      icon: 'bi-box-arrow-up-right'
    },
    {
      class: 'documentate',
      title: 'Documentar Ticket',
      icon: 'bi-file-earmark-plus-fill'
    },
    { class: 'img-btn', title: 'Mostrar Imagen', icon: 'bi-image-fill' }
  ]

  actions.forEach(({ class: cls, title, icon }) => {
    const btn = document.createElement('button')
    btn.className = `cell-btn ${cls}`
    btn.title = title
    btn.setAttribute('cell-id', ticket.id)

    const iconElem = document.createElement('i')
    iconElem.className = `bi ${icon}`
    btn.appendChild(
      document.createTextNode(cls === 'view-mdl-btn' ? `${ticket.id} ` : '')
    )
    btn.appendChild(iconElem)

    cellId.appendChild(btn)
  })

  row.appendChild(cellId)

  // --- Fecha ---
  const cellFecha = document.createElement('div')
  cellFecha.className = 'cell'
  cellFecha.setAttribute('col', 'fecha')
  cellFecha.textContent = new Date(ticket.fecha).toLocaleString('es-CO')
  row.appendChild(cellFecha)

  // --- Columnas dinámicas ---
  columns.forEach(col => {
    const cell = document.createElement('div')
    cell.className = 'cell'
    cell.setAttribute('col', col)
    cell.dataset.col = col
    cell.textContent = ticket[col] ?? ''
    row.appendChild(cell)
  })

  return row
}

function renderInvRow (inv) {
  const row = document.createElement('div')

  row.classList.add('table-row')
  row.dataset.id = inv.id

  const cellId = document.createElement('div')
  cellId.className = 'cell'

  const actions = [
    {
      class: 'view-mdl-btn',
      title: 'Ver Equipo',
      icon: 'bi-box-arrow-up-right'
    },
    {
      class: 'cell-btn',
      title: 'Actualizar',
      icon: 'bi-pencil-fill',
      onclick: () => (location.href = '/admin/inventario/update?id=' + inv.id)
    }
  ]

  const cols = ['nombre', 'marca', 'modelo', 'color', 'serial']

  actions.forEach(({ class: cls, title, icon, onclick }) => {
    const btn = document.createElement('button')
    btn.className = `cell-btn ${cls}`
    btn.title = title
    btn.setAttribute('cell-id', inv.id)

    const iconElem = document.createElement('i')
    iconElem.className = `bi ${icon}`
    btn.appendChild(
      document.createTextNode(
        cls === 'view-mdl-btn' ? `${inv.nombre_equipo} ` : ''
      )
    )
    btn.appendChild(iconElem)
    btn.onclick = onclick

    cellId.appendChild(btn)
  })

  row.appendChild(cellId)

  cols.forEach(col => {
    const cell = document.createElement('div')
    cell.className = 'cell'
    cell.setAttribute('col', col)
    cell.dataset.col = col
    cell.textContent = inv[col] ?? ''
    row.appendChild(cell)
  })

  return row
}
function renderPerRow (per) {
  const row = document.createElement('div')

  row.classList.add('table-row')
  row.dataset.id = per.id

  // ID con enlace
  const cellId = document.createElement('div')
  cellId.className = 'cell'
  const link = document.createElement('a')
  link.href = '/admin/pers/update?id=' + per.id
  link.textContent = per.id
  cellId.appendChild(link)
  row.appendChild(cellId)

  // Columnas fijas
  const cols = [
    { key: 'mod_date', label: 'Fecha de Modificación' },
    { key: 'tipo', label: 'Tipo' },
    { key: 'name', label: 'Asignado a', fn: () => per.name },
    { key: 'marca', label: 'Marca' },
    { key: 'modelo', label: 'Modelo' },
    { key: 'color', label: 'Color' },
    { key: 'serial', label: 'Serial' }
  ]

  cols.forEach(({ key, fn }) => {
    const cell = document.createElement('div')
    cell.className = 'cell'
    cell.setAttribute('col', key)
    cell.textContent = fn ? fn() : per[key] ?? ''
    row.appendChild(cell)
  })

  // Condicional -> Fecha de asignación si state === 1
  if (per.state == 1) {
    const asignCell = document.createElement('div')
    asignCell.className = 'cell'
    asignCell.textContent = per.asign_date ?? ''
    row.appendChild(asignCell)
  }

  return row
}
function chargeInv () {
  const radioInv = document.querySelectorAll('input[name="state"]')
  const form = document.querySelector('.inv-filter-form')
  const col = document.querySelector('#col')
  if (!form) return

  let state = 1
  let colValue = col?.value || null
  let debounceTimer

  // Escucha cambios en los radios (estado)
  radioInv.forEach(radio => {
    radio.addEventListener('input', e => {
      state = e.target.value
      reloadData({ state })
    })
  })

  // Escucha cambios en el select de columnas
  col.addEventListener('input', e => {
    colValue = e.target.value
  })

  // Escucha cambios en los filtros del formulario
  form.addEventListener('input', e => {
    if (e.target.id === 'col') return

    const value = e.target.value

    clearTimeout(debounceTimer)
    debounceTimer = setTimeout(() => {
      TOAST('Realizando búsqueda...')
      reloadData({ state, col: colValue, value })
    }, 800) // espera 800ms desde la última tecla
  })

  // Inicial
  reloadData({})

  // Helper
  function reloadData (extraQuery = {}) {
    chargeData({
      url: '/inventory/get',
      perPage,
      containerSelector: '.table.table-inv-admin',
      renderRow: renderInvRow,
      onRendered: () => {
        openInventoryView()
      },
      query: extraQuery
    })
  }
}

function chargePers () {
  const radioPer = document.querySelectorAll('input[name="state"]')

  radioPer.forEach(radio => {
    radio.addEventListener('input', e => {
      chargeData({
        url: '/admin/pers/get',
        perPage: perPage,
        containerSelector: '.table.table-per-admin',
        renderRow: renderPerRow,
        query: { state: e.target.value }
      })
    })
  })
  chargeData({
    url: '/admin/pers/get',
    perPage: perPage,
    containerSelector: '.table.table-per-admin',
    renderRow: renderPerRow
  })
}

function tableSearchManager () {
  const form = document.querySelector('.search-form')
  const table = document.querySelector('.table')

  if (!(form && table)) return

  const colSelector = form.querySelector('#col')
  const valInput = form.querySelector('#val')

  let colToFilter = ''
  colSelector.addEventListener('input', e => {
    colToFilter = e.target.value
  })

  valInput.addEventListener('input', e => {
    const searchTerm = e.target.value.toLowerCase()

    // Si hay columna seleccionada → filtramos solo esa
    if (colToFilter) {
      const values = Array.from(
        table.querySelectorAll(`.cell[col='${colToFilter}']`)
      )
      values.forEach(cell => {
        const row = cell.parentNode
        row.style.display = cell.textContent.toLowerCase().includes(searchTerm)
          ? ''
          : 'none'
      })
    }
    // Si NO hay columna seleccionada → buscamos en toda la fila
    else {
      const rows = Array.from(
        table.querySelectorAll('.table-row:not(.table-header)')
      )
      rows.forEach(row => {
        const cells = Array.from(row.querySelectorAll('.cell'))
        const match = cells.some(cell =>
          cell.textContent.toLowerCase().includes(searchTerm)
        )
        row.style.display = match ? '' : 'none'
      })
    }
  })
}

chargeData({
  url: '/tickets/get',
  perPage: perPage,
  containerSelector: '.table.table-tickets-admin',
  renderRow: renderTicketRow,
  onRendered: () => {
    viewAdminTicket()
    openDocumentationView()
    ticketImgModal()
  }
})

chargeInv()
chargePers()
tableSearchManager()

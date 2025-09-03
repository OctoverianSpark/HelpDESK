import { viewAdminTicket } from './views.js'

/* Tables */
let currentPage = 1
const perPage = 50

function chargeTickets (page = 1) {
  fetch(`/tickets/get?page=${page}&limit=${perPage}`)
    .then(res => res.json())
    .then(json => {
      const tabla = document.querySelector('.table.table-tickets-admin')

      // Elimina todas las filas excepto la cabecera
      tabla
        .querySelectorAll('.table-row:not(.table-header)')
        .forEach(row => row.remove())

      json.tickets.forEach(ticket => {
        const row = document.createElement('div')
        row.classList.add('table-row')
        row.dataset.id = ticket.id

        // ----- ID -----
        const cellId = document.createElement('div')
        cellId.className = 'cell'
        cellId.setAttribute('col', 'id')

        const viewBtn = document.createElement('button')
        viewBtn.className = 'cell-btn view-mdl-btn'
        viewBtn.title = 'Ver Ticket'
        viewBtn.setAttribute('cell-id', ticket.id)
        viewBtn.textContent = ticket.id + ' '
        const iconView = document.createElement('i')
        iconView.className = 'bi bi-box-arrow-up-right'
        viewBtn.appendChild(iconView)

        const docBtn = document.createElement('button')
        docBtn.className = 'cell-btn documentate'
        docBtn.title = 'Documentar Ticket'
        docBtn.setAttribute('cell-id', ticket.id)
        const iconDoc = document.createElement('i')
        iconDoc.className = 'bi bi-file-earmark-plus-fill'
        docBtn.appendChild(iconDoc)

        const imgBtn = document.createElement('button')
        imgBtn.className = 'cell-btn img-btn'
        imgBtn.title = 'Mostrar Imagen'
        imgBtn.setAttribute('cell-id', ticket.id)
        const iconImg = document.createElement('i')
        iconImg.className = 'bi bi-image-fill'
        imgBtn.appendChild(iconImg)

        cellId.append(viewBtn, docBtn, imgBtn)
        row.appendChild(cellId)

        // ----- FECHA -----
        const cellFecha = document.createElement('div')
        cellFecha.className = 'cell'
        cellFecha.setAttribute('col', 'fecha')
        cellFecha.textContent = new Date(ticket.fecha).toLocaleString('es-CO')
        row.appendChild(cellFecha)

        // ----- CATEGORIA -----
        const cellCategoria = document.createElement('div')
        cellCategoria.className = 'cell'
        cellCategoria.setAttribute('col', 'categoria')
        cellCategoria.dataset.col = 'categoria'
        cellCategoria.textContent = ticket.categoria
        row.appendChild(cellCategoria)

        // ----- USUARIO -----
        const cellUsuario = document.createElement('div')
        cellUsuario.className = 'cell'
        cellUsuario.setAttribute('col', 'usuario')
        cellUsuario.textContent = ticket.usuario
        row.appendChild(cellUsuario)

        // ----- ESTADO -----
        const cellEstado = document.createElement('div')
        cellEstado.className = 'cell'
        cellEstado.setAttribute('col', 'estado')
        cellEstado.dataset.col = 'estado'
        cellEstado.textContent = ticket.estado
        row.appendChild(cellEstado)

        // ----- PRIORIDAD -----
        const cellPrioridad = document.createElement('div')
        cellPrioridad.className = 'cell'
        cellPrioridad.setAttribute('col', 'prioridad')
        cellPrioridad.dataset.col = 'prioridad'
        cellPrioridad.textContent = ticket.prioridad
        row.appendChild(cellPrioridad)

        // ----- TECNICO -----
        const cellTecnico = document.createElement('div')
        cellTecnico.className = 'cell'
        cellTecnico.setAttribute('col', 'tecnico')
        cellTecnico.dataset.col = 'tecnico'
        cellTecnico.textContent = ticket.tecnico
        row.appendChild(cellTecnico)

        // Agregar la fila a la tabla
        tabla.appendChild(row)
      })

      renderPagination(json.page, json.pages, chargeTickets)
      viewAdminTicket()
    })
}
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

tableSearchManager()
chargeTickets()

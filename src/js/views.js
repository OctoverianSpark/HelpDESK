import { Information } from './Class/Information.js'
import { Element } from './Class/Element.js'
import { GETCOOKIES, TOAST } from './GLOBALS.js'
async function CLIPBOARDWORK (text) {
  const clipBoard = await navigator.clipboard.writeText(text)
  TOAST('Texto copiado al portapapeles!!!', 'right')
}

const userDATA = await GETCOOKIES()

export async function viewAdminTicket (callback) {
  const table = document.querySelector('.table-tickets-admin')

  if (!table) return
  const viewBtns = document.querySelectorAll('.table-row .cell .view-mdl-btn')

  const viewMdl = document.querySelector('.ticket-detail-view')

  const MdlForm = viewMdl.querySelector('form')
  viewBtns.forEach(btn => {
    btn.addEventListener('click', async e => {
      TOAST('Cargando informacion del ticket...', 'right')
      const cellId = btn.getAttribute('cell-id')

      const ticket = await Information.postJSON('/tickets/find', {
        id: cellId
      })

      Object.entries(ticket).forEach(async ([key, value]) => {
        let entry
        if (key === 'categoria') {
          entry = document.getElementsByName(key)

          entry.forEach(radio => {
            radio.checked = radio.value.toLowerCase() === value.toLowerCase()
          })
          return
        } else {
          entry = document.getElementById(key)
        }

        if (!entry) return
        const label = document.querySelector(`[for=${entry.id}] p span`)

        if (entry.nodeName === 'H1') {
          entry.textContent = value
        } else if (entry.nodeName === 'SELECT') {
          Array.from(entry.options).forEach(option => {
            if (key === 'tecnico_id') {
              option.selected = value == option.value
              return
            }

            option.selected = option.value.toLowerCase() === value.toLowerCase()
            if (value.toLowerCase() === 'sin asignar') {
              option.disabled = ['pendiente', 'completado'].includes(
                option.value.toLowerCase()
              )
            }
          })

          // 👇 Muy importante: notificar a Select2
          $(entry).trigger('change')

          if (!label) return
          label.addEventListener('click', async e => {
            CLIPBOARDWORK(
              entry.options[entry.options.selectedIndex].textContent
            )
          })
        } else {
          entry.value = value
          if (!label) return
          label.addEventListener('click', async e => {
            CLIPBOARDWORK(entry.value)
          })
        }
      })

      viewMdl.classList.add('active')

      MdlForm.addEventListener('submit', async e => {
        e.preventDefault()
        TOAST('Cargando nueva Informacion...', 'right')
        viewMdl.classList.remove('active')

        const data = new FormData(e.target)

        const body = {
          id: cellId
        }
        data.entries().forEach(([key, value]) => {
          body[key] = value
          console.log(key)

          const cell = document.querySelector(
            `.table-row[data-id='${cellId}'] > [col=${key}]`
          )
          if (!cell) return

          cell.textContent = value.toUpperCase()
        })
        const query = await Information.postJSON(
          '/admin/tickets/update',
          body
        ).then(res => {
          TOAST('Datos actualizados correctamente', 'right')
        })

        setTimeout(() => {
          btn.click()
        }, 2500)
      })
    })
  })
}
export async function ticketImgModal () {
  const imgMdl = document.querySelector('.img-view')
  const img = imgMdl.querySelector('img')

  const imgBtns = document.querySelectorAll('.img-btn')

  imgBtns.forEach(btn => {
    btn.addEventListener('click', async e => {
      const cellId = btn.getAttribute('cell-id')
      const ticket = await Information.postJSON('/tickets/find', {
        id: cellId
      })

      if (!ticket.imagen) {
        TOAST('Este ticket no tiene imagen', 'right', '#', 'red')
        return
      }

      img.src = ticket.imagen
      imgMdl.classList.add('active')
    })
  })

  imgMdl.addEventListener('click', e => {
    if (e.target === imgMdl) {
      imgMdl.classList.remove('active')
    }
  })
}

export async function openDocumentationView () {
  const table = document.querySelector('.table-tickets-admin')

  if (!table) return

  const docBTNS = document.querySelectorAll('.documentate')
  const docMdl = document.querySelector('.documentation-view')
  const docForm = docMdl.querySelector('form')
  const commentsBOX = docForm.querySelector('.updates')

  docBTNS.forEach(btn => {
    btn.addEventListener('click', async e => {
      const rowID = btn.getAttribute('cell-id')

      const query = await Information.postJSON('/admin/documentations/find', {
        id: rowID
      })
      commentsBOX.innerHTML = ''

      query.forEach(comment => {
        const box = createCommentBox(comment)
        commentsBOX.appendChild(box.render())
      })

      docMdl.classList.add('active')
      docForm.addEventListener('submit', async e => {
        e.preventDefault()

        const data = new FormData(e.target)

        if (data.get('comentario') == '') {
          TOAST('El comentario no puede salir vacio', 'right', '#', 'red')
          return
        }

        let body = {
          comentario: data.get('comentario'),
          ticket_id: rowID
        }

        commentsBOX.appendChild(createCommentBox(body).render())
        docForm['comentario'].value = ''

        const payload = await Information.postJSON(
          '/admin/documentations/create',
          body
        ).then(res => {
          TOAST('Documentacion Registrada', 'right', '#')
        })
      })
    })
  })
}

export async function openInventoryView () {
  const table = document.querySelector('.table-inv-admin')

  if (!table) return
  const viewBtns = document.querySelectorAll('.table-row .cell .view-mdl-btn')
  const Mdl = document.querySelector('.inv-view')
  const persContainer = document.querySelector('.pers')

  viewBtns.forEach(btn => {
    btn.addEventListener('click', async e => {
      const id = btn.getAttribute('cell-id')
      const res = await fetch('/inventory/find?id=' + id)
      const data = await res.json()
      console.log(data)
      persContainer.innerHTML = ''
      Object.entries(data.computer).forEach(([key, value]) => {
        const span = document.getElementById(`computer-${key}`)
        if (!span) return
        span.textContent = value
        span.onclick = () => CLIPBOARDWORK(value)
      })
      data.pers.forEach((per, i) => {
        const tipo = new Element('H1', {}, {}, [per.tipo])
        const marca = new Element(
          'p',
          {},
          { onclick: () => CLIPBOARDWORK(per.marca) },
          [per.marca]
        )
        const modelo = new Element(
          'p',
          {},
          { onclick: () => CLIPBOARDWORK(per.modelo) },
          [per.modelo]
        )
        const color = new Element(
          'p',
          {},
          { onclick: () => CLIPBOARDWORK(per.color) },
          [per.color]
        )
        const serial = new Element(
          'p',
          {},
          { onclick: () => CLIPBOARDWORK(per.serial) },
          [per.serial]
        )

        const perCont = new Element(
          'div',
          { id: 'per-' + i, class: 'per container-grid' },
          {},
          [tipo, marca, modelo, color, serial]
        )
        persContainer.appendChild(perCont.render())
      })
      Mdl.classList.add('active')
    })
  })
}

function createCommentBox (comment) {
  const date = new Element('SPAN', {}, {}, [
    comment.fecha ??
      new Date().toISOString().replace('T', ' ').replace('Z', '').split('.')[0]
  ])
  const comentText = new Element('SPAN', { class: 'comment-text' }, {}, [
    comment.comentario
  ])
  const author = new Element('SPAN', {}, {}, [
    comment.cargado_por ?? userDATA.name
  ])

  const box = new Element('DIV', { class: 'comment' }, {}, [
    date,
    comentText,
    author
  ])

  return box
}

function openCreateAgentModal () {
  const btn = document.getElementById('open-agent-creator')
  const updateBTN = document.querySelectorAll('.update-agent-btn')

  if (!btn) return

  const Mdl = document.querySelector('.agent-modal')

  const form = Mdl.querySelector('form')

  btn.addEventListener('click', e => {
    Mdl.classList.add('active')
  })

  updateBTN.forEach(btn => {
    btn.addEventListener('click', async e => {
      const input = document.querySelector('input[name="action"]')
      input.value = 'update'

      const inputID = document.createElement('input')
      inputID.type = 'hidden'
      inputID.setAttribute('name', 'id')
      inputID.value = btn.getAttribute('cell-id')

      const name = document.querySelector('input[name="name"]')

      const agent = await fetch(
        '/admin/agents/find?id=' + btn.getAttribute('cell-id')
      ).then(res => res.json())

      name.value = agent.name

      form.appendChild(inputID)

      Mdl.classList.add('active')
    })
  })

  Mdl.addEventListener('click', e => {
    if (e.target === Mdl) Mdl.classList.remove('active')
  })
}
openCreateAgentModal()

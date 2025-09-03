import { Information } from './Class/Information.js'
import { TOAST } from './GLOBALS.js'

function CLIPBOARDWORK () {
  const clipBoardBTNS = document.querySelectorAll('.clipboard-btn')
  clipBoardBTNS.forEach(btn => {
    btn.addEventListener('click', async e => {
      const clipBoard = await navigator.clipboard.writeText(
        btn.getAttribute('clipboardtxt')
      )

      TOAST('Texto copiado al portapapeles!!!', 'center')
    })
  })
}

export async function viewAdminTicket () {
  const table = document.querySelector('.table-tickets-admin')

  if (!table) return
  const viewBtns = document.querySelectorAll('.table-row .cell .view-mdl-btn')

  const viewMdl = document.querySelector('.ticket-detail-view')

  const MdlForm = viewMdl.querySelector('.ticket-details')
  viewBtns.forEach(btn => {
    btn.addEventListener('click', async e => {
      TOAST('Cargando informacion del ticket...', 'center')
      const cellId = btn.getAttribute('cell-id')

      const ticket = await Information.postJSON('/tickets/find', {
        id: cellId
      })

      viewMdl.classList.add('active')

      MdlForm.onsubmit = () => {
        TOAST('Cargando nueva Informacion...', 'right')

        setTimeout(() => {
          btn.click()
        }, 2500)
      }

      CLIPBOARDWORK()
    })
  })
}

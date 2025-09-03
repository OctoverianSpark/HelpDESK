import './app.js'
import './backEnd.js'
import './frontEnd.js'
import './tables.js'
import './dashboard.js'

function initSelect2 () {
  $('select:not(#col)').each(function () {
    if (!$(this).data('select2')) {
      $(this).select2({
        placeholder: '--Selecciona--',
        allowClear: true,
        width: '100%'
      })
    }
  })
}

initSelect2()

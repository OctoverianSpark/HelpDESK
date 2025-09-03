import './app.js'
import './backEnd.js'
import './frontEnd.js'
import './tables.js'
import './dashboard.js'

function initSelect2 () {
  $('select:not(#col,[name="export"])').each(function () {
    if (!$(this).data('select2')) {
      $(this).select2({})
    }
  })
}

initSelect2()

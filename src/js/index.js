import './app.js'
import './backEnd.js'
import './frontEnd.js'
import './tables.js'
import './dashboard.js'
function initSelect2 () {
  $('select').not('.select2-hidden-accessible').select2()
}
$(document).ready(function () {
  initSelect2()
})

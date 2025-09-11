import { Element } from './Class/Element.js'
import { Information } from './Class/Information.js'

function RADIOCARD (name, id, text, icon, value = '') {
  const INPUT = new Element('INPUT', {
    name: name,
    id: id,
    type: 'radio',
    value: value
  })

  const I = new Element('I', { class: icon })

  const SPAN = new Element('SPAN', {}, { textContent: text })

  const LABEL = new Element(
    'LABEL',
    { for: id, class: 'radio-label-card --smaller' },
    {},
    [INPUT, I, SPAN]
  )

  return LABEL
}

function INPUTGROUP (name, id, text, placeholder, type = 'text') {
  const SPAN = new Element('SPAN', {}, { textContent: text }, [])
  const INPUT = new Element(
    'INPUT',
    { id: id, type: type, placeholder: placeholder, name: name },
    []
  )
  const LABEL = new Element('LABEL', { for: id, class: 'input-group' }, {}, [
    SPAN,
    INPUT
  ])

  return LABEL
}

function GENCONTAINER (tag, className, childs = []) {
  const CONTAINER = new Element(tag, { class: className }, {}, childs)

  return CONTAINER
}

/**
 * Create a Toast Notificaction
 *
 * @param {String} text The text displayed in the Toast
 * @param {String} pos The position ("left","center","right") where the Toast is displayed
 * @param {String} dest The destination page for the toast
 *
 *
 */
function TOAST (text, pos, dest = '', bg = 'var(--primary-600)') {
  Toastify({
    text: text,
    duration: 1500,
    close: true,
    gravity: 'top',
    margin: '10',
    position: pos,
    background: bg,
    destination: dest,
    width: 1200
  }).showToast()
}
function sleep (ms) {
  return new Promise(resolve => setTimeout(resolve, ms))
}

async function GETCOOKIES () {
  const cookies = await Information.postJSON('/admin/cookies/get')

  return cookies
}

function randomColor () {
  const letters = '0123456789ABCDEF'
  let color = '#'
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)]
  }
  return color
}

function cleanPers (obj) {
  let res = {}

  Object.entries(obj).forEach(([key, value]) => {
    let ev = Object.values(value).every(
      val => val === '' || val === undefined || val === null
    )

    if (ev) return
    res[key] = value
  })

  return res
}

const fetchTicketsData = async (query = {}) => {
  try {
    let response
    if (Object.keys(query).length > 0) {
      const params = new URLSearchParams(query).toString()
      console.log(params)

      response = await fetch(`/tickets/graph?${params}`)
    } else {
      response = await fetch(`/tickets/graph`)
    }

    if (!response.ok) {
      throw new Error('Network response was not ok')
    }
    const data = await response.json()
    return data
  } catch (error) {
    console.error('Error fetching graph data:', error)
    return null
  }
}
async function safeFetch (url, options) {
  let res = await fetch(url, options)

  if (res.status === 429) {
    const retryAfter = res.headers.get('Retry-After') || 5
    console.warn(`⏳ Rate limit alcanzado. Esperando ${retryAfter} seg...`)
    await sleep(retryAfter * 1000)
    return safeFetch(url, options) // reintento
  }

  return res
}
export {
  GENCONTAINER,
  RADIOCARD,
  INPUTGROUP,
  TOAST,
  GETCOOKIES,
  randomColor,
  cleanPers,
  fetchTicketsData,
  sleep,
  safeFetch
}

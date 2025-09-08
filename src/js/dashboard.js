console.log('Dashboard JS loaded')

import { Chart, registerables } from 'chart.js'
import { fetchTicketsData } from './GLOBALS.js'
import zoomPlugin from 'chartjs-plugin-zoom'
import { Information } from './Class/Information.js'
import ChartDataLabels from 'chartjs-plugin-datalabels'
Chart.register(...registerables, zoomPlugin, ChartDataLabels)

async function setUpTicketsDashboard () {
  const info = await fetchTicketsData()

  const from = document.getElementById('from')
  const to = document.getElementById('to')
  const techRadios = document.querySelectorAll('input[name="tech"]')

  if (from && to && techRadios) {
    let query = {}

    from.addEventListener('change', async e => {
      query['from'] = from.value
      console.log(to.value)

      const newInfo = await fetchTicketsData(query)
      if (newInfo) TicketsDashboardGraphicate(newInfo)
    })

    to.addEventListener('change', async e => {
      query['to'] = to.value
      console.log(to.value)

      const newInfo = await fetchTicketsData(query)
      if (newInfo) TicketsDashboardGraphicate(newInfo)
    })

    techRadios.forEach(radio => {
      radio.addEventListener('input', async e => {
        const selectedTech = document.querySelector(
          'input[name="tech"]:checked'
        ).value
        query['tech'] = selectedTech
        const newInfo = await fetchTicketsData(query)
        if (newInfo) TicketsDashboardGraphicate(newInfo)
      })
    })
  }

  TicketsDashboardGraphicate(info)
}

const TicketsDashboardGraphicate = info => {
  const priorityCnvs = document.getElementById('priority-chart')
  const statusCnvs = document.getElementById('status-chart')
  const categoryCnvs = document.getElementById('category-chart')
  const ticketsByDateCnvs = document.getElementById('ticketsByDate')
  const avgResolutionDateCnvs = document.getElementById('avgResolutionByDate')
  const avgResolutionTechCnvs = document.getElementById('avgResolutionByTech')

  if (
    !priorityCnvs ||
    !statusCnvs ||
    !categoryCnvs ||
    !ticketsByDateCnvs ||
    !avgResolutionDateCnvs ||
    !avgResolutionTechCnvs
  )
    return

  const {
    byPriority,
    byStatus,
    byCategory,
    ticketsByDate,
    avgResolutionByDate,
    avgResolutionByTech,
    briefData
  } = info

  const textColor = 'white'

  Object.entries(briefData).forEach(([key, value]) => {
    const span = document.querySelector(`.brief-data.${key}`)
    if (span) span.textContent = value
  })

  const commonOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'top',
        labels: {
          color: textColor,
          font: { size: 16, weight: 'bold' },
          usePointStyle: true,
          pointStyle: 'circle'
        }
      },
      tooltip: {
        callbacks: {
          label: ctx => `${ctx.label}: ${ctx.raw}`
        }
      },
      zoom: {
        zoom: {
          wheel: { enabled: true },
          pinch: { enabled: true },
          mode: 'x'
        },
        pan: { enabled: true, mode: 'x' }
      }
    },
    onClick: (e, elements, chart) => {
      if (e.native && e.native.detail === 2) {
        // doble clic
        chart.resetZoom()
      }
    }
  }

  Object.entries(Chart.instances).forEach(([key, chart]) => {
    console.log(chart)

    chart.destroy()
  })

  // --- PIE: Tickets por Prioridad ---
  new Chart(priorityCnvs, {
    type: 'doughnut',
    data: {
      labels: Object.keys(byPriority),
      datasets: [
        { label: 'Tickets por Prioridad', data: Object.values(byPriority) }
      ]
    },
    options: commonOptions
  })

  // --- PIE: Tickets por Estado ---
  new Chart(statusCnvs, {
    type: 'doughnut',
    data: {
      labels: Object.keys(byStatus),
      datasets: [{ label: 'Tickets por Estado', data: Object.values(byStatus) }]
    },
    options: commonOptions
  })

  // --- BARRAS: Tickets por Categoría ---
  new Chart(categoryCnvs, {
    type: 'bar',
    data: {
      labels: Object.keys(byCategory),
      datasets: [
        { label: 'Tickets por Categoría', data: Object.values(byCategory) }
      ]
    },
    options: {
      ...commonOptions,
      plugins: { ...commonOptions.plugins, legend: { display: false } },
      scales: {
        x: {
          ticks: { color: textColor, font: { weight: 'bold' } },
          grid: { color: 'rgba(255,255,255,0.1)' }
        },
        y: {
          ticks: { color: textColor },
          grid: { color: 'rgba(255,255,255,0.1)' }
        }
      }
    }
  })

  // --- LÍNEA: Tickets creados por Fecha ---
  new Chart(ticketsByDateCnvs, {
    type: 'line',
    data: {
      labels: Object.keys(ticketsByDate),
      datasets: [
        {
          label: 'Tickets creados',
          data: Object.values(ticketsByDate),
          borderColor: '#36A2EB',
          fill: false,
          tension: 0.3
        }
      ]
    },
    options: {
      ...commonOptions,
      scales: {
        x: {
          ticks: { color: textColor, font: { weight: 'bold' } },
          grid: { color: 'rgba(255,255,255,0.1)' }
        },
        y: {
          ticks: { color: textColor },
          grid: { color: 'rgba(255,255,255,0.1)' }
        }
      }
    }
  })

  // --- LÍNEA: Tiempo promedio de resolución ---
  new Chart(avgResolutionDateCnvs, {
    type: 'line',
    data: {
      labels: Object.keys(avgResolutionByDate),
      datasets: [
        {
          label: 'Tiempo promedio (horas)',
          data: Object.values(avgResolutionByDate),
          borderColor: '#FF6384',
          fill: false,
          tension: 0.3
        }
      ]
    },
    options: {
      ...commonOptions,
      scales: {
        x: {
          ticks: { color: textColor, font: { weight: 'bold' } },
          grid: { color: 'rgba(255,255,255,0.1)' }
        },
        y: {
          ticks: { color: textColor },
          grid: { color: 'rgba(255,255,255,0.1)' }
        }
      }
    }
  })

  // --- BARRA HORIZONTAL: Tiempo Promedio por Técnico ---
  new Chart(avgResolutionTechCnvs, {
    type: 'bar',
    data: {
      labels: Object.keys(avgResolutionByTech),
      datasets: [
        {
          label: 'Tiempo Promedio (horas)',
          data: Object.values(avgResolutionByTech),
          backgroundColor: '#36A2EB'
        }
      ]
    },
    options: {
      ...commonOptions,
      plugins: {
        ...commonOptions.plugins,
        title: {
          display: true,
          text: 'Tiempo Promedio de Resolución por Técnico',
          color: textColor
        },
        legend: { display: false }
      },
      indexAxis: 'y',
      scales: {
        x: {
          ticks: { color: textColor },
          grid: { color: 'rgba(255,255,255,0.1)' }
        },
        y: {
          ticks: { color: textColor, font: { weight: 'bold' } },
          grid: { color: 'rgba(255,255,255,0.1)' }
        }
      }
    }
  })
}

async function setUpInvDashboard () {
  const dashboard = document.querySelector('.inv-dashboard')
  if (!dashboard) return

  // Traer inventario desde el backend
  const res = await fetch('/inventory/get/all')

  const inventory = await res.json()
  console.log(inventory)

  // -------------------
  // Inventario por Tipo
  // -------------------
  const typeData = inventory.reduce((acc, item) => {
    const tipo = item.tipo || 'Desconocido'
    acc[tipo] = (acc[tipo] || 0) + 1
    return acc
  }, {})

  const typeChartData = {
    labels: Object.keys(typeData),
    datasets: [
      {
        label: 'Tipo',
        data: Object.values(typeData),
        borderWidth: 1
      }
    ]
  }

  const typeChartConfig = {
    type: 'pie',
    data: typeChartData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Inventario por Tipo',
          color: 'white',
          font: { size: 18 }
        },
        legend: {
          position: 'top',
          labels: { color: 'white' }
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ': ' + tooltipItem.raw
            }
          }
        }
      }
    },
    layout: { padding: 10 }
  }

  const typeCTX = document.querySelector('#inv-type-chart').getContext('2d')
  new Chart(typeCTX, typeChartConfig)

  // ------------------------
  // Inventario por Propietario
  // ------------------------
  const propertyData = inventory.reduce((acc, item) => {
    const propietario = item.propietario || 'Desconocido'
    acc[propietario] = (acc[propietario] || 0) + 1
    return acc
  }, {})

  const propertyChartData = {
    labels: Object.keys(propertyData),
    datasets: [
      {
        label: 'Propietario',
        data: Object.values(propertyData),
        borderWidth: 1
      }
    ]
  }

  const propertyChartConfig = {
    type: 'pie',
    data: propertyChartData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Inventario por Propietario',
          color: 'white',
          font: { size: 18 }
        },
        legend: {
          position: 'top',
          labels: { color: 'white' }
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ': ' + tooltipItem.raw
            }
          }
        }
      }
    },
    layout: { padding: 10 }
  }

  const propertyCTX = document
    .querySelector('#inv-property-chart')
    .getContext('2d')
  new Chart(propertyCTX, propertyChartConfig)

  // -------------------
  // Inventario por Área
  // -------------------
  const areaData = inventory.reduce((acc, item) => {
    const area = item.area || 'Sin asignar' // fallback si no tiene área
    acc[area] = (acc[area] || 0) + 1
    return acc
  }, {})

  const areaChartData = {
    labels: Object.keys(areaData),
    datasets: [
      {
        label: 'Inventario por Área',
        data: Object.values(areaData),
        backgroundColor: ['#FF6384'], // paleta de colores más diferenciable
        borderWidth: 1
      }
    ]
  }

  const areaChartConfig = {
    type: 'bar',
    data: areaChartData,
    options: {
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        datalabels: {
          color: 'white',
          anchor: 'center',
          align: 'right',
          font: {
            weight: 'bold'
          },
          formatter: value => value // muestra el número tal cual
        },
        title: {
          display: true,
          text: 'Inventario por Área',
          color: 'white',
          font: { size: 18 }
        },
        legend: { display: false },
        tooltip: {
          callbacks: {
            title: function (tooltipItems) {
              return tooltipItems[0].label // muestra el área completa
            },
            label: function (tooltipItem) {
              const value = tooltipItem.raw
              const total = tooltipItem.chart.data.datasets[0].data.reduce(
                (a, b) => a + b,
                0
              )
              const porcentaje = ((value / total) * 100).toFixed(1) + '%'
              return `${value} (${porcentaje})`
            }
          }
        }
      },
      scales: {
        x: {
          type: 'linear', // ← más natural si los valores no varían tanto
          ticks: { color: 'white' },
          grid: { color: 'rgba(255,255,255,0.1)' }
        },
        y: {
          ticks: { color: 'white', autoSkip: false },
          grid: { color: 'rgba(255,255,255,0.1)' }
        }
      }
    },
    layout: { padding: 10 },
    plugins: [ChartDataLabels]
  }

  const areaCTX = document.querySelector('#inv-area-chart').getContext('2d')
  new Chart(areaCTX, areaChartConfig)

  const locationCTX = document
    .querySelector('#inv-location-chart')
    .getContext('2d')
  new Chart(locationCTX, locationChartConfig)
}

async function setUpAdminDashboard () {
  const dashboard = document.querySelector('.admin-dashboard')
  if (!dashboard) return

  // ----------------------
  // Tickets Chart
  // ----------------------
  const TicketCtx = document.querySelector('#tickets-chart').getContext('2d')
  const tickets = await Information.postJSON('/tickets/actuals')

  const ticketCounts = tickets.reduce((acc, ticket) => {
    acc[ticket.categoria] = (acc[ticket.categoria] || 0) + 1
    return acc
  }, {})

  const ticketData = {
    labels: Object.keys(ticketCounts),
    datasets: [
      {
        label: 'Tickets',
        data: Object.values(ticketCounts),
        borderWidth: 1
      }
    ]
  }

  const ticketConfig = {
    type: 'pie',
    data: ticketData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Resumen de tickets de este mes',
          color: 'white',
          font: { size: 18 }
        },
        legend: {
          position: 'top',
          labels: { color: 'white' }
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ': ' + tooltipItem.raw + ' tickets'
            }
          }
        }
      }
    },
    layout: { padding: 10 }
  }

  new Chart(TicketCtx, ticketConfig)

  // ----------------------
  // Inventario Chart
  // ----------------------
  const invCTX = document.querySelector('#inv-chart').getContext('2d')
  const inventoryres = await fetch('/inventory/get/all')
  const inventory = await inventoryres.json()
  const invTypeCounts = inventory.reduce((acc, item) => {
    const tipo = item.tipo || 'Desconocido'
    acc[tipo] = (acc[tipo] || 0) + 1
    return acc
  }, {})

  const invData = {
    labels: Object.keys(invTypeCounts),
    datasets: [
      {
        label: 'Inventario',
        data: Object.values(invTypeCounts),
        borderWidth: 1
      }
    ]
  }

  const invConfig = {
    type: 'pie',
    data: invData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Inventario por Tipo',
          color: 'white',
          font: { size: 18 }
        },
        legend: {
          position: 'top',
          labels: { color: 'white' }
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.label + ': ' + tooltipItem.raw
            }
          }
        }
      }
    },
    layout: { padding: 10 }
  }

  new Chart(invCTX, invConfig)

  // ----------------------
  // Orders Chart
  // ----------------------
  const orders = await Information.postJSON('/admin/orders/actuals')

  const orderTypeData = {
    labels: Object.keys(orders).map(x => x.toUpperCase()),
    datasets: [
      {
        label: 'Tipo',
        data: Object.values(orders),
        borderWidth: 1
      }
    ]
  }

  const orderTypeConfig = {
    type: 'pie',
    data: orderTypeData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Resumen de Órdenes',
          color: 'white',
          font: { size: 18 }
        },
        legend: {
          position: 'top',
          labels: { color: 'white' }
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.raw
            }
          }
        },
        datalabels: {
          color: 'white',
          formatter: value => value
        }
      }
    },
    layout: { padding: 10 }
  }

  const orderTypeCTX = document
    .getElementById('orders-type-chart')
    .getContext('2d')

  new Chart(orderTypeCTX, orderTypeConfig)

  // ----------------------
  // Brief cards (KPIs)
  // ----------------------
  const briefCards = document.querySelector('.container-brief-cards')

  const briefTickets = briefCards.querySelector('.month-total-tickets')
  const briefINV = briefCards.querySelector('.total-inventory')
  const briefOrders = briefCards.querySelector('.month-total-orders')

  let monthTickets = 0
  let totalinv = inventory.length
  let totalOrders = 0

  Object.values(ticketCounts).forEach(value => {
    monthTickets += value
  })
  Object.values(orders).forEach(value => {
    totalOrders += value
  })

  briefTickets.textContent = monthTickets
  briefINV.textContent = totalinv
  briefOrders.textContent = totalOrders
}

setUpTicketsDashboard()
setUpInvDashboard()
setUpAdminDashboard()

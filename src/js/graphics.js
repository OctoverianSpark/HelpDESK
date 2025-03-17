import { Information } from "./Class/Information.js";
import {
  RADIOCARD,
  INPUTGROUP,
  GENCONTAINER,
  TOAST,
  GETCOOKIES,
  randomColor,
} from "./GLOBALS.js";

import { Chart, registerables } from "chart.js";


Chart.register(...registerables);

Chart.defaults.color = "#000";

export async function PerTypeGraphic(query) {
  const ctx = document.querySelector(".chart-per-type").getContext("2d");

  let payload = {
    labels: query.reduce((acc, ticket) => {
      if (!acc.includes(ticket.categoria)) {
        acc.push(ticket.categoria);
      }
      return acc;
    }, []),
    datasets: [],
  };

  payload.datasets = [
    {
      data: payload.labels.map(
        (label) => query.filter((ticket) => ticket.categoria === label).length
      ),
      backgroundColor: ["#0e1d62", "#fff554", "#00e67e"],
      borderWidth: 0,
    },
  ];

  circleChart("doughnut", ctx, payload);
}

export function TechnicalPodium(query) {
  const ctx = document.querySelector(".chart-per-asign").getContext("2d");

  const labels = query.reduce((acc, ticket) => {
    if (!acc.includes(ticket.tecnico)) {
      acc.push(ticket.tecnico);
    }
    return acc;
  }, []);

  const asignationsDataSet = {
    data: labels.map(
      (label) => query.filter((ticket) => ticket.tecnico === label).length
    ),
    backgroundColor: "#0e1d62",
    label: "Tickets asignados",
  };

  let payload = {
    labels: labels,
    datasets: [asignationsDataSet],
  };

  barChart("y", ctx, payload);
}

export function metricTime(query) {
  const ctx = document.querySelector(".chart-per-time").getContext("2d");

  const labels = query.reduce((acc, ticket) => {
    if (!acc.includes(ticket.tecnico)) {
      acc.push(ticket.tecnico);
    }
    return acc;
  }, []);

  const avgCompletedTime = labels.map((label) => {
    const value =
      query.reduce(
        (acc, ticket) => acc + (Number(ticket.tiempo_en_completar) || 0),
        0
      ) /
      query.filter(
        (ticket) => label.toLowerCase() === ticket.tecnico.toLowerCase()
      ).length;

    return value;
  });

  const avgPendingTime = labels.map((label) => {
    const value =
      query.reduce(
        (acc, ticket) => acc + (Number(ticket.tiempo_en_pendiente) || 0),
        0
      ) /
      query.filter(
        (ticket) => label.toLowerCase() === ticket.tecnico.toLowerCase()
      ).length;

    return value;
  });

  const avgAsignTime = labels.map((label) => {
    const value =
      query.reduce(
        (acc, ticket) => acc + (Number(ticket.tiempo_en_pendiente) || 0),
        0
      ) /
      query.filter(
        (ticket) => label.toLowerCase() === ticket.tecnico.toLowerCase()
      ).length;

    return value;
  });

  let avgGeneralTime = [];
  for (let i = 0; i < labels.length; i++) {
    avgGeneralTime.push(
      (avgAsignTime[i] + avgCompletedTime[i] + avgPendingTime[i]) / 3
    );
  }

  const asignedTimeDataSet = {
    data: avgAsignTime,
    label: "Tiempo en asignar",
    color: "#fff554",
    borderColor: "#fff554",
    order: 1,
    type: "line",
    tension: 0.5,
  };
  const pendingTimeDataSet = {
    data: avgPendingTime,
    label: "Tiempo en pendiente",
    color: "#ff8938",
    borderColor: "#ff8938",
    order: 1,
    type: "line",
    tension: 0.5,
  };
  const completedTimeDataSet = {
    data: avgCompletedTime,
    label: "Tiempo en completar",
    color: "#00ff8b",
    borderColor: "#00ff8b",
    order: 1,
    type: "line",
    tension: 0.5,
  };

  const generalMediaDataSet = {
    data: avgGeneralTime,
    label: "Linea General de Tiempo",
    color: "#9700ff",
    borderColor: "#9700ff",
    order: 1,
    type: "line",
    tension: 0.5,
  };

  let payload = {
    labels: labels,
    datasets: [
      asignedTimeDataSet,
      pendingTimeDataSet,
      completedTimeDataSet,
      generalMediaDataSet,
    ],
  };

  lineChart(ctx, payload);
}

export function updateChart(chart, data) {
  chart.data.labels = data.labels;
  chart.data.datasets = data.datasets;
  chart.update();
}

export async function setInvTypeChart(invCTX) {
  const inventory = await Information.postJSON("/admin/inventory/get");

  const invCount = inventory.reduce((acc, data) => {

    if (data.user_id == 0) {
      acc["stock"] = (acc["stock"] || 0) + 1;
    } else {
      acc["asignados"] = (acc["asignados"] || 0) + 1;
    }
    return acc;
  }, {});



  const invDATA = {
    labels: Object.keys(invCount).map(x => x.toUpperCase()),
    datasets: [{
      label: 'Tipo',
      data: Object.values(invCount),
      borderWidth: 1,

    }]
  };


  const invCONFIG = {
    type: 'pie',
    data: invDATA,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Resumen de inventario',
          color: 'white',
          font: {
            size: 18
          }
        },
        legend: {
          position: 'top',
          labels: {
            color: 'white'
          }
        },
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
              return tooltipItem.raw;
            }
          }
        },
        datalabels: {
          color: 'white',
          formatter: (value, context) => {
            return value;
          }
        }
      }
    },
    layout: {
      padding: {
        left: 10,
        right: 10,
        top: 10,
        bottom: 10
      }
    }
  };


  const invChart = new Chart(invCTX, invCONFIG)

  return invChart;
}


/**
 * Creates a circle chart (doughnut or pie) using Chart.js.
 *
 * @param {String} type - The type of chart (e.g., 'doughnut', 'pie').
 * @param {CanvasRenderingContext2D} ctx - The 2D context of the canvas element where the chart will be rendered.
 * @param {Array} labels - The labels for the chart's data points.
 * @param {Array} data - The data values for the chart.
 */
export function circleChart(type, ctx, data) {
  let labels = data.labels;

  let datasets = data.datasets;

  const config = {
    type: type,
    data: {
      labels: labels,

      datasets: datasets.map((x) => x),
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: "top",
          color: "black",
          font: {
            size: 16,
          },
        },
        title: {
          display: false,
          text: "Donut Chart Example",
        },
      },
    },
  };

  if (window.myChart) {
    window.myChart.destroy();
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
  }
  window.myChart = new Chart(ctx, config);
}

/**
 * Creates a bar chart using Chart.js with customizable orientation.
 *
 * @param {String} orientation - The orientation of the bar chart ('vertical' or 'horizontal').
 * @param {CanvasRenderingContext2D} ctx - The 2D context of the canvas element where the chart will be rendered.
 * @param {Array} labels - The labels for the chart's data points.
 * @param {Array} data - The data values for the chart.
 */
export function barChart(orientation, ctx, data) {
  let labels = data.labels;
  let datasets = data.datasets;

  const config = {
    type: "bar",
    data: {
      labels: labels,
      datasets: datasets.map((x) => x),
    },
    options: {
      indexAxis: orientation,
      responsive: true,
      plugins: {
        legend: {
          position: "top",
          color: "black",
          font: {
            size: 16,
          },
        },
        title: {
          display: false,
          text: "Bar Chart Example",
        },
      },
    },
  };

  if (window.myBarChart) {
    window.myBarChart.destroy();
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
  }
  window.myBarChart = new Chart(ctx, config);
}

/**
 * Creates a line chart using Chart.js.
 *
 * @param {CanvasRenderingContext2D} ctx - The 2D context of the canvas element where the chart will be rendered.
 * @param {Array} data - The data values for the chart.
 */
export function lineChart(ctx, data) {
  let labels = data.labels;
  let datasets = data.datasets;

  const config = {
    type: "line",
    data: {
      labels: labels,
      datasets: datasets.map((x) => x),
    },
    options: {
      transitions: {
        show: {
          animations: {
            x: {
              from: 0,
            },
            y: {
              from: 0,
            },
          },
        },
      },
      responsive: true,
      plugins: {
        legend: {
          position: "top",
          color: "black",
          font: {
            size: 16,
          },
        },
        title: {
          display: false,
          text: "Line Chart Example",
        },
      },
      scales: {
        x: {
          display: true,
          title: {
            display: false,
            text: "X Axis Title",
          },
        },
        y: {
          display: true,
          title: {
            display: false,
            text: "Y Axis Title",
          },
        },
      },
    },
  };

  if (window.myLineChart) {
    window.myLineChart.destroy();
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
  }
  window.myLineChart = new Chart(ctx, config);
}



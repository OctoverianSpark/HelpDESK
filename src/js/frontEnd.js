import {
  RADIOCARD,
  INPUTGROUP,
  GENCONTAINER,
  TOAST,
  GETCOOKIES,
} from "./GLOBALS.min.js";
import { Element } from "./Class/Element.min.js";
import { Information } from "./Class/Information.min.js";

//NOTE: Libraries Imports
import {
  Chart,
  registerables,
} from "https://cdn.jsdelivr.net/npm/chart.js/dist/chart.mjs";
import * as helpers from "https://cdn.jsdelivr.net/npm/chart.js/dist/helpers.mjs";

Chart.register(...registerables);

Chart.defaults.color = "#000";

console.log("FrontEnd.js loaded");

function addPer() {
  const container = document.querySelector(".container-peripherals");

  if (!container) return;

  const addBtn = document.querySelector(".add-btn");
  const rmBtn = document.querySelector(".remove-btn");

  const instances = container.querySelectorAll(".peripheral");

  let count = instances.length;

  addBtn.addEventListener("click", (e) => {
    count++;

    const MOUSECARD = RADIOCARD(
      `perifericos[${count - 1}][tipo]`,
      `mouse-${count}`,
      "Mouse",
      "bi bi-mouse-fill",
      "mouse"
    );

    const HEADPHONECARD = RADIOCARD(
      `perifericos[${count - 1}][tipo]`,
      `audifono-${count}`,
      "Audifonos",
      "bi bi-headphones",
      "diademas"
    );

    const MONITORCARD = RADIOCARD(
      `perifericos[${count - 1}][tipo]`,
      `monitor-${count}`,
      "Monitor",
      "bi bi-display",
      "monitor"
    );

    const KEYBOARDCARD = RADIOCARD(
      `perifericos[${count - 1}][tipo]`,
      `teclado-${count}`,
      "Teclado",
      "bi bi-keyboard-fill",
      "teclado"
    );

    const CARDSCONTAINER = GENCONTAINER("DIV", "container-input-flex", [
      MOUSECARD,
      KEYBOARDCARD,
      HEADPHONECARD,
      MONITORCARD,
    ]);

    const BRANDINPUT = INPUTGROUP(
      `perifericos[${count - 1}][marca]`,
      `marca-${count - 1}`,
      "Marca",
      "GENIUS,LENOVO, SAMSUNG...."
    );

    const MODELINPUT = INPUTGROUP(
      `perifericos[${count - 1}][modelo]`,
      `modelo-${count - 1}`,
      "Modelo",
      "SMU, DX-120, S2412..."
    );

    const COLORINPUT = INPUTGROUP(
      `perifericos[${count - 1}][color]`,
      `color-${count - 1}`,
      "Color",
      "NEGRO,ROJO , AZUL ,etc..."
    );

    const SERIALINPUT = INPUTGROUP(
      `perifericos[${count - 1}][serial]`,
      `serial-${count - 1}`,
      "Serial",
      "EJ: BK2SD994KJS..."
    );

    const CONTAINERINPUTS = GENCONTAINER("DIV", "container-input", [
      BRANDINPUT,
      MODELINPUT,
      COLORINPUT,
      SERIALINPUT,
    ]);

    const LEGEND = new Element(
      "LEGEND",
      {},
      { textContent: `Periferico #${count}` },
      []
    );

    const FIELDSET = GENCONTAINER("FIELDSET", "peripheral", [
      LEGEND,
      CARDSCONTAINER,
      CONTAINERINPUTS,
    ]);

    FIELDSET._attributes["id"] = `per-${count}`;

    container.appendChild(FIELDSET.render());
  });

  rmBtn.addEventListener("click", (e) => {
    if (!count >= 1) return;

    const fieldset = document.querySelector(`#per-${count}`);
    fieldset.remove();
    count--;
  });
}

function sign() {
  const canvas = document.querySelector(".sign-canvas");

  if (!canvas) return;

  const context = canvas.getContext("2d");

  const pencilColor = "black";

  let xBefore = 0,
    yBefore = 0,
    xActual = 0,
    yActual = 0;

  let drawing = false;

  const getRealX = (clientX) => clientX - canvas.getBoundingClientRect().left;

  const getRealY = (clientY) => clientY - canvas.getBoundingClientRect().top;

  const limpiarCanvas = () => {
    // Colocar color blanco en fondo de canvas
    context.fillStyle = "white";
    context.fillRect(0, 0, canvas.width, canvas.height);
  };

  limpiarCanvas();

  canvas.addEventListener("mousedown", (e) => {
    xBefore = xActual;
    yBefore = yActual;
    xActual = getRealX(e.clientX);
    yActual = getRealY(e.clientY);
    context.beginPath();
    context.fillStyle = pencilColor;
    context.fillRect(xActual, yActual, 2, 2);
    context.closePath();
    // Y establecemos la bandera
    drawing = true;
  });

  canvas.addEventListener("mousemove", (e) => {
    if (!drawing) {
      return;
    }

    xBefore = xActual;
    yBefore = yActual;
    xActual = getRealX(e.clientX);
    yActual = getRealY(e.clientY);
    context.beginPath();
    context.moveTo(xBefore, yBefore);
    context.lineTo(xActual, yActual);
    context.strokeStyle = pencilColor;
    context.lineWidth = 3;

    context.stroke();
    context.closePath();
  });

  canvas.addEventListener("mouseout", (e) => {
    drawing = false;
  });
  canvas.addEventListener("mouseup", (e) => {
    drawing = false;
  });
}

function dragNdrop() {
  const dragable = document.querySelector(".dragable");

  let startX = 0;
  let startY = 0;
  let newX = 0;
  let newY = 0;

  if (dragable) {
    dragable.addEventListener("mousedown", mouseDown);
  }

  function mouseDown(e) {
    startX = e.clientX;
    startY = e.clientY;

    document.addEventListener("mousemove", mouseMove);
    document.addEventListener("mouseup", mouseUp);
  }

  function mouseMove(e) {
    newX = startX - e.clientX;
    newY = startY - e.clientY;

    startX = e.clientX;
    startY = e.clientY;

    dragable.style.top = dragable.offsetTop - newY + "px";
    dragable.style.left = dragable.offsetLeft - newX + "px";
  }

  function mouseUp(e) {
    document.removeEventListener("mousemove", mouseMove);
  }
}

function CLIPBOARDWORK() {
  const clipBoardBTNS = document.querySelectorAll(".clipboard-btn");
  clipBoardBTNS.forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      console.log("A");
      const clipBoard = await navigator.clipboard.writeText(
        btn.getAttribute("clipboardtxt")
      );

      TOAST("Texto copiado al portapapeles!!!", "center");
    });
  });
}
function tableSearchManager() {
  const form = document.querySelector(".search-form");
  const table = document.querySelector(".table");

  if (!(form && table)) return;

  const colSelector = form.querySelector("#col");
  const valInput = form.querySelector("#val");

  let colToFilter = "order_id";
  colSelector.addEventListener("input", (e) => {
    colToFilter = e.target.value;
  });

  valInput.addEventListener("input", (e) => {
    const values = Array.from(
      table.querySelectorAll(`.cell[col='${colToFilter}']`)
    );
    const searchTerm = e.target.value.toLowerCase();
    values.forEach((cell) => {
      const row = cell.parentNode;
      if (cell.textContent.toLowerCase().includes(searchTerm)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
}

async function viewAdminInv() {
  const table = document.querySelector(".table-inv-admin");
  if (!table) return;

  const viewBtns = table.querySelectorAll(".view-btn");
  const viewMdl = document.querySelector(".modal-view");
  const closeMdlBtn = viewMdl.querySelector(".modal-close-btn");

  const stockBTN = viewMdl.querySelector(".stock-btn");
  const deleteBTN = viewMdl.querySelector(".delete-btn");
  const updateBTN = viewMdl.querySelector(".update-btn");

  viewBtns.forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      const row = btn.parentNode.parentNode;
      const rowID = row.getAttribute("cell-id");

      updateBTN.href = "/admin/inventario/actualizar?id=";

      stockBTN.setAttribute("cellId", rowID);
      deleteBTN.setAttribute("cellId", rowID);
      updateBTN.href += rowID;

      const invData = await Information.postJSON("/admin/inventory/find", {
        id: rowID,
      });

      console.log(invData);

      const inv = invData.inv;
      const pers = invData.pers;

      Array.from(document.querySelectorAll(".container-info")).map((x) =>
        x.remove()
      );

      const PERSONALINFO = {
        nombre: `${inv.nombre} ${inv.apellido ?? ""}`,
        documento: `${inv.tipo_documento} ${inv.documento}`,
        telefono: `${inv.telefono}`,
        correo: inv.correo_dominio,
      };

      const COMPUTERINFO = {
        tipo: `${inv.tipo}`,
        marca: `${inv.marca}`,
        modelo: `${inv.modelo}`,
        serial: `${inv.serial}`,
        color: inv.color,
        "nombre de equipo": inv.nombre_equipo,
        anydesk: inv.anydesk,
      };

      const ELEMENTS = [];

      const PERSONAL_INFO_ELEMENTS = [];

      Object.entries(PERSONALINFO).forEach(([key, value]) => {
        const I = new Element("I", { class: "bi bi-clipboard-fill" });
        const BUTTON = new Element(
          "BUTTON",
          { type: "button", class: "clipboard-btn", clipBoardTxt: `${value}` },
          {},
          [I]
        );
        const P = new Element(
          "P",
          {},
          { textContent: `${key.toUpperCase()} : ${value.toUpperCase()}` },
          [BUTTON]
        );
        PERSONAL_INFO_ELEMENTS.push(P);
      });
      ELEMENTS.push(PERSONAL_INFO_ELEMENTS);

      const COMPUTER_INFO_ELEMENTS = [];
      Object.entries(COMPUTERINFO).forEach(([key, value]) => {
        const I = new Element("I", { class: "bi bi-clipboard-fill" });
        const BUTTON = new Element(
          "BUTTON",
          { type: "button", class: "clipboard-btn", clipBoardTxt: `${value}` },
          {},
          [I]
        );
        const P = new Element(
          "P",
          {},
          { textContent: `${key.toUpperCase()} : ${value.toUpperCase()}` },
          [BUTTON]
        );
        COMPUTER_INFO_ELEMENTS.push(P);
      });

      ELEMENTS.push(COMPUTER_INFO_ELEMENTS);

      if (pers.length > 0) {
        pers.forEach((per) => {
          const PERINFO = {
            tipo: `${per.tipo}`,
            marca: `${per.marca}`,
            modelo: `${per.modelo}`,
            serial: `${per.serial}`,
            color: per.color,
          };

          let PERS_INFO_ELEMENTS = [];

          Object.entries(PERINFO).forEach(([key, value]) => {
            console.log(key, value);

            const I = new Element("I", { class: "bi bi-clipboard-fill" });
            const BUTTON = new Element(
              "BUTTON",
              {
                type: "button",
                class: "clipboard-btn",
                clipBoardTxt: `${value}`,
              },
              {},
              [I]
            );
            const P = new Element(
              "P",
              {},
              { textContent: `${key.toUpperCase()} : ${value.toUpperCase()}` },
              [BUTTON]
            );
            PERS_INFO_ELEMENTS.push(P);
          });

          ELEMENTS.push(Array.from(PERS_INFO_ELEMENTS));
        });
      }

      ELEMENTS.forEach((ELEMENT) => {
        const CONTAINER_INFO = new Element(
          "DIV",
          { class: "container-info" },
          {},
          ELEMENT
        );

        viewMdl.appendChild(CONTAINER_INFO.render());
      });

      CLIPBOARDWORK();

      viewMdl.classList.remove("hidden");
    });
  });

  closeMdlBtn.addEventListener("click", (e) => {
    viewMdl.classList.add("hidden");
    Array.from(document.querySelectorAll(".container-info")).map((x) =>
      x.remove()
    );
  });
}

async function viewAdminTicket() {
  const table = document.querySelector(".table-tickets-admin");
  if (!table) return;

  const viewBtns = table.querySelectorAll(".view-btn");
  const viewMdl = document.querySelector(".tickets-view");

  const MdlForm = viewMdl.querySelector(".ticket-admin-form");
  const closeMdlBtn = viewMdl.querySelector(".modal-close-btn");

  viewBtns.forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      TOAST("Cargando informacion del ticket...", "center");
      const info = viewMdl.querySelector(".container-info");
      const p = info.querySelectorAll("p");
      p.forEach((p) => p.remove());

      const cellId = btn.getAttribute("cell-id");

      const ticket = await Information.postJSON("/tickets/find", {
        id: cellId,
      });

      const ContainerInfo = viewMdl.querySelector(".container-info");

      let INFO = {
        ID: ticket.id,
        Fecha: ticket.fecha,
        Usuario: ticket.usuario,
        Descripcion: ticket.descripcion,
        Anydesk: ticket.anydesk,
      };

      let INPUT_INFO = {
        category: ticket.categoria,
        subcat: ticket.subcategoria,
        status: ticket.estado,
        asigned: ticket.tecnico_id,
        priority: ticket.prioridad,
      };

      Object.entries(INFO).forEach(([key, value]) => {
        const I = new Element("I", { class: "bi bi-clipboard-fill" });
        const BUTTON = new Element(
          "BUTTON",
          { type: "button", class: "clipboard-btn", clipBoardTxt: `${value}` },
          {},
          [I]
        );
        const P = new Element(
          "P",
          {},
          {
            textContent: `${key} : ${
              value.charAt(0).toUpperCase() + value.slice(1).toLowerCase()
            }`,
          },
          [BUTTON]
        );

        ContainerInfo.appendChild(P.render());
      });

      Object.entries(INPUT_INFO).forEach(([key, value]) => {
        const select = MdlForm.querySelector(`#${key}`);
        const options = select.querySelectorAll("option");

        select.addEventListener("input",e=>{

          MdlForm.querySelectorAll("select").forEach(element=>element.disabled = false)

        })

        options.forEach((option) => {
          if (option.value.toLowerCase() == value.toLowerCase()) {
            option.selected = true;
          }
        });

        if (key === "status") {
          const solution = document.querySelector("#solution");

          const completedOption = select.querySelector(
            "option[value='completado']"
          );
          const pendingOption = select.querySelector(
            "option[value='pendiente']"
          );

          if (value.toLowerCase() == "sin asignar") {
            pendingOption.classList.add("hidden");
            completedOption.classList.add("hidden");
          } else {
            pendingOption.classList.remove("hidden");
            completedOption.classList.remove("hidden");
          }

          let solValid = value.toLowerCase() === "completado"
          
          select.addEventListener("input", (e) => {

            solValid = e.target.value.toLowerCase() === "completado"

            solution.required = solValid
            solution.disabled = !solValid

          });
          

          solution.required = solValid;
          solution.disabled = !solValid

        }

        if (key === "subcat") {
          
          const app = document.querySelector("#app");
          const other = document.querySelector("label[for='other']")
          select.addEventListener("input", (e) => {
            let valid =
              e.target.value.toLowerCase() === "instalar" ||
              e.target.value.toLowerCase() === "revisar";
            app.disabled = !valid;
            app.required = valid;


            let otherVal = e.target.value.toLowerCase() === "otro"
            if (!otherVal) other.classList.add("hidden") 
            if (otherVal) other.classList.remove("hidden") 

            const OTHERINPUT = other.querySelector("input")

            OTHERINPUT.disabled = !otherVal
            OTHERINPUT.required = otherVal;

            e.target.disabled = otherVal
  
              

          });

          let valid =
            value.toLowerCase() === "revisar" ||
            value.toLowerCase() === "instalar";
          app.disabled = !valid;
          app.required = valid;
          

        }

      });

      const HIDDEN = new Element(
        "INPUT",
        { type: "hidden", name: "id" },
        { value: cellId },
        []
      );
      MdlForm.appendChild(HIDDEN.render());

      viewMdl.classList.remove("hidden");

      CLIPBOARDWORK();
    });
  });

  closeMdlBtn.addEventListener("click", (e) => {
    const info = viewMdl.querySelector(".container-info");
    const p = info.querySelectorAll("p");
    p.forEach((p) => p.remove());
    viewMdl.classList.add("hidden");
  });

  const categorySelector = MdlForm.querySelector("#category");

  categorySelector.addEventListener("input", async (e) => {
    const subcatsSelector = MdlForm.querySelector("#subcat");
    const subcats = await Information.postJSON("/admin/subcats/get", {
      cat: e.target.value,
    });
    const subsOptions = subcatsSelector.querySelectorAll(".subs");
    subsOptions.forEach((subOption) => subOption.remove());

    subcats.forEach((subcat) => {
      let sub = subcat.subcategoria.toString();

      sub = sub.charAt(0).toUpperCase() + sub.slice(1).toLowerCase();

      const option = new Element(
        "OPTION",
        { value: sub, class: "subs" },
        { textContent: sub },
        []
      );

      subcatsSelector.appendChild(option.render());
    });
  });
}

function invActions() {
  const ViewMdl = document.querySelector(".modal-inv-view");

  if (!ViewMdl) return;

  const stockBTN = ViewMdl.querySelector(".stock-btn");
  const deleteBTN = ViewMdl.querySelector(".delete-btn");
  const updateBTN = ViewMdl.querySelector(".update-btn");

  stockBTN.addEventListener("click", (e) => {
    const id = stockBTN.getAttribute("cellId");
    MOVETOSTOCK(id);
  });
  deleteBTN.addEventListener("click", (e) => {
    const id = deleteBTN.getAttribute("cellId");
    DELETECELL(id);
  });
}

async function MOVETOSTOCK(cellId) {
  const response = await fetch("/admin/inventario/actions", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: cellId,
      action: "stock",
    }),
  })
    .then((response) => response.json())
    .catch((err) => console.error(err));

  if (response.msg === "1") {
    location.reload();
  }
}

async function DELETECELL(cellId) {
  const response = await fetch("/admin/inventario/actions", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: cellId,
      action: "delete",
    }),
  })
    .then((response) => response.json())
    .catch((err) => console.error(err));

  if (response.msg === "1") {
    location.reload();
  }
}

async function viewAdminDocumentation() {
  const table = document.querySelector(".table-tickets-admin");
  if (!table) return;

  const viewBtns = table.querySelectorAll(".documentate");

  const viewMdl = document.querySelector(".documentation-view");

  const containerComments = viewMdl.querySelector(".container-documentations");
  const closeMdlBtn = viewMdl.querySelector(".modal-close-btn");

  viewBtns.forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      viewMdl.classList.toggle("hidden");

      const rowID = btn.getAttribute("cell-id");

      const query = await Information.postJSON("/admin/documentations/find", {
        id: rowID,
      });

      const comments = viewMdl.querySelectorAll(".comment");

      comments.forEach((comment) => comment.remove());
      query.forEach((body) => {
        const DATESPAN = new Element(
          "SPAN",
          {},
          { textContent: body.fecha },
          []
        );
        const DATELEGEND = new Element(
          "LEGEND",
          {},
          { textContent: "Fecha: " },
          [DATESPAN]
        );

        const AUTHORSPAN = new Element(
          "SPAN",
          {},
          { textContent: body.cargado_por },
          []
        );
        const AUTHORLEGEND = new Element(
          "LEGEND",
          {},
          { textContent: "Generado por:" },
          [AUTHORSPAN]
        );

        const COMMENTP = new Element(
          "P",
          {},
          { textContent: body.comentario },
          []
        );

        const CONTAINER = new Element("FIELDSET", { class: "comment" }, {}, [
          DATELEGEND,
          AUTHORLEGEND,
          COMMENTP,
        ]);

        containerComments.appendChild(CONTAINER.render());
      });

      const form = viewMdl.querySelector(".comment-form");

      form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        const body = {};

        formData.entries().forEach(([key, value]) => {
          body[key] = value;
        });

        body["ticket_id"] = rowID;
        body["fecha"] = new Date().toISOString();

        body["fecha"] = body["fecha"]
          .replace(/T/, " ")
          .replace(/\..+/, "")
          .replace(/Z/, "");

        const payload = await Information.postJSON(
          "/admin/documentations/create",
          body
        );

        const DATESPAN = new Element(
          "SPAN",
          {},
          { textContent: body.fecha },
          []
        );
        const DATELEGEND = new Element(
          "LEGEND",
          {},
          { textContent: "Fecha: " },
          [DATESPAN]
        );

        const AUTHORSPAN = new Element(
          "SPAN",
          {},
          { textContent: payload.data.cargado_por },
          []
        );
        const AUTHORLEGEND = new Element(
          "LEGEND",
          {},
          { textContent: "Generado por:" },
          [AUTHORSPAN]
        );

        const COMMENTP = new Element(
          "P",
          {},
          { textContent: body.comentario },
          []
        );

        const CONTAINER = new Element("FIELDSET", { class: "comment" }, {}, [
          DATELEGEND,
          AUTHORLEGEND,
          COMMENTP,
        ]);

        containerComments.appendChild(CONTAINER.render());
      });
    });
  });

  closeMdlBtn.addEventListener("click", (e) => {
    viewMdl.classList.add("hidden");
  });
}

function imageViewer() {
  const ImgMdl = document.querySelector(".img-view");

  if (!ImgMdl) return;

  const btns = document.querySelectorAll(".img-btn");

  btns.forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      const cellId = btn.getAttribute("cell-id");

      const ticket = await Information.postJSON("/tickets/find", {
        id: cellId,
      });

      if (!ticket.imagen) {
        TOAST("La imagen no fue cargada o no se pudo encontrar...", "center");
      } else {
        ImgMdl.classList.remove("hidden");
        const img = ImgMdl.querySelector("img");
        img.src = "/referencias/" + ticket.imagen;
      }
    });
  });

  ImgMdl.addEventListener("click", (e) => {
    ImgMdl.classList.add("hidden");
  });
}

async function TicketGraphicCards(query) {
  const container = document.querySelector(".tickets-admin-dashboard");

  if (!container) return;

  const totalCard = document.querySelector(".quantificate-total");

  totalCard.textContent = query.length;

  const totalUnassignedTime = query.reduce(
    (acc, ticket) => acc + (Number(ticket.tiempo_en_asignar) || 0),
    0
  );
  const averageUnassignedTime = totalUnassignedTime / query.length;

  const avgUnassignedTimeCard = document.querySelector(
    ".quantificate-asign-time"
  );
  avgUnassignedTimeCard.textContent = averageUnassignedTime.toFixed(2);

  const totalPendingTime = query.reduce(
    (acc, ticket) => acc + (Number(ticket.tiempo_en_pendiente) || 0),
    0
  );
  const avgPendingTime = totalPendingTime / query.length;

  const pendingCard = document.querySelector(".quantificate-pending-time");
  pendingCard.textContent = avgPendingTime.toFixed(2) ?? 0;

  const totalCompletionTime = query.reduce(
    (acc, ticket) => acc + (Number(ticket.tiempo_en_completar) || 0),
    0
  );
  const avgCompletionTime = totalCompletionTime / query.length;

  const completionCard = document.querySelector(".quantificate-complete-time");

  completionCard.textContent = avgCompletionTime.toFixed(2);
}

async function TicketGraphicsControllers() {
  const DASHBOARD = document.querySelector(".tickets-admin-dashboard");

  if (!DASHBOARD) return;

  const form = DASHBOARD.querySelector(".graphics-filter-form");

  let query = await Information.postJSON("/admin/tickets/indexer", {});
  TicketGraphicCards(query);

  const perTypeChartCTX = document
    .querySelector(".chart-per-type")
    .getContext("2d");

  let perTypePayload = {
    labels: query.reduce((acc, ticket) => {
      if (!acc.includes(ticket.categoria)) {
        acc.push(ticket.categoria);
      }
      return acc;
    }, []),
    datasets: [],
  };

  perTypePayload.datasets = [
    {
      data: perTypePayload.labels.map(
        (label) => query.filter((ticket) => ticket.categoria === label).length
      ),
      backgroundColor: perTypePayload.labels.map((x) => randomColor()),
    },
  ];

  circleChart("doughnut", perTypeChartCTX, perTypePayload);

  form.addEventListener("input", async (e) => {
    const formData = new FormData(form);

    const body = {};
    formData.forEach((value, key) => {
      body[key] = value;
    });

    query = await Information.postJSON("/admin/tickets/indexer", body);

    perTypePayload = {
      labels: query.reduce((acc, ticket) => {
        if (!acc.includes(ticket.categoria)) {
          acc.push(ticket.categoria);
        }
        return acc;
      }, []),
      datasets: [],
    };

    perTypePayload.datasets = [
      {
        data: perTypePayload.labels.map(
          (label) => query.filter((ticket) => ticket.categoria === label).length
        ),
        backgroundColor: perTypePayload.labels.map((x) => randomColor()),
      },
    ];

    circleChart("pie", perTypeChartCTX, perTypePayload);

    TicketGraphicCards(query);
    console.log("Graphic Controllers", query);
  });
}

function randomColor() {
  const letters = "0123456789ABCDEF";
  let color = "#";
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

/**
 * Creates a circle chart (doughnut or pie) using Chart.js.
 *
 * @param {String} type - The type of chart (e.g., 'doughnut', 'pie').
 * @param {CanvasRenderingContext2D} ctx - The 2D context of the canvas element where the chart will be rendered.
 * @param {Array} labels - The labels for the chart's data points.
 * @param {Array} data - The data values for the chart.
 */
function circleChart(type, ctx, data) {
  const labels = data.labels;

  const datasets = data.datasets;

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

document.addEventListener("DOMContentLoaded", (e) => {
  addPer();
  sign();
  tableSearchManager();
  dragNdrop();
  viewAdminInv();
  viewAdminTicket();
  invActions();
  viewAdminDocumentation();
  TicketGraphicsControllers();
  imageViewer();
});

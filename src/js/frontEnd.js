import {
  RADIOCARD,
  INPUTGROUP,
  GENCONTAINER,
  TOAST,
  GETCOOKIES,
  randomColor,
} from "./GLOBALS.js";

import {
  setInvTypeChart,
  PerTypeGraphic,
  TechnicalPodium,
  metricTime,
  circleChart,
  barChart,


} from "./graphics.js";

//NOTE:CLASS FOLDER IMPORTATIONS
import { Element } from "./Class/Element.js";
import { Information } from "./Class/Information.js";
import { Chart } from "chart.js";


Chart.defaults.font.family = "Pangram";
Chart.defaults.backgroundColor = [
  'rgba(255, 99, 132, 1)',
  'rgb(93, 95, 226)',
  'rgba(255, 206, 86, 1)',
  'rgba(75, 192, 192, 1)',
  'rgba(153, 102, 255,1)',
  'rgba(255, 159, 64, 1)'
]

Chart.defaults.borderColor = [
  'rgba(255, 99, 132, 1)',
  'rgb(36, 81, 110)',
  'rgba(255, 206, 86, 1)',
  'rgb(39, 88, 88)',
  'rgba(153, 102, 255, 1)',
  'rgba(255, 159, 64, 1)'
]

console.log("FrontEnd.js loaded");


let pers = document.querySelectorAll(".peripheral");

function updatePersCont() {
  let pers = document.querySelectorAll(".peripheral");
  pers.forEach((per, idx) => {


    const id = per.getAttribute("id").split("-")[1];


    const newId = idx + 1

    per.setAttribute("id", `per-${newId}`)

    const legend = per.querySelector("legend");

    legend.textContent = `Periferico #${newId}`;

    const inputs = per.querySelectorAll("input");

    inputs.forEach(input => {

      const name = input.getAttribute("name").replace(`[${id}]`, `[${newId - 1}]`);


      input.setAttribute("name", `${name}`)

    })

    const btn = per.querySelector(".cell-btn")

    btn.addEventListener("click", e => {

      

      btn.parentNode.remove();

    })






  })

  return pers;

}


const observer = new MutationObserver(() => {

  console.log("Mutacion realizada!!!");

  setTimeout(() => {

    pers = updatePersCont()
    

  }, 0);

})
const persCont = document.querySelector(".container-peripherals");
if(persCont){
  observer.observe(persCont, { childList: true,attributes:true })

}

function addPer() {
  const container = document.querySelector(".container-peripherals");

  if (!container) return;

  const addBtn = document.querySelector(".add-btn");
  const rmBtn = document.querySelector(".remove-btn");


  addBtn.addEventListener("click", (e) => {
    let count = pers.length
    count++

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
    const ADAPTERCARD = RADIOCARD(
      `perifericos[${count - 1}][tipo]`,
      `adaptador-${count}`,
      "Adaptador",
      "bi bi-usb-symbol",
      "adaptador"
    );
    const CAMERACARD = RADIOCARD(
      `perifericos[${count - 1}][tipo]`,
      `camara-${count}`,
      "Camara",
      "bi bi-webcam-fill",
      "camara"
    );

    const DELETE_BTN = new Element(
      "BUTTON",
      { type: "button", class: "btn cell-btn" },
      {},
      [
        new Element("I", { class: "bi bi-x" }, {}, [])
      ]
    )

    const CARDSCONTAINER = GENCONTAINER("DIV", "container-input-flex", [
      MOUSECARD,
      KEYBOARDCARD,
      HEADPHONECARD,
      MONITORCARD,
      ADAPTERCARD,
      CAMERACARD
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
      DELETE_BTN,
      CARDSCONTAINER,
      CONTAINERINPUTS,
    ]);

    FIELDSET._attributes["id"] = `per-${count}`;

    container.appendChild(FIELDSET.render());

  });

  rmBtn.addEventListener("click", (e) => {
    let count = pers.length;

    if (!count >= 1) return;

    const fieldset = document.querySelector(`#per-${count}`);
    fieldset.remove();
    count--;
  });
}


function delPer() {





  pers.forEach(per => {


    const btn = per.querySelector(".cell-btn")

    btn.addEventListener("click", e => {

      

      btn.parentNode.remove();

    })


  })










}

function noReturn() {


  const NORETURNCHECK = document.querySelector("#no-return");


  const returnDate = document.querySelector("#return")

  if (!NORETURNCHECK) return



  NORETURNCHECK.addEventListener("input", e => {

    returnDate.disabled = e.target.checked

  })

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

  let colToFilter = "";
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
            textContent: `${key} : ${value.charAt(0).toUpperCase() + value.slice(1).toLowerCase()
              }`,
          },
          [BUTTON]
        );

        ContainerInfo.appendChild(P.render());
      });

      Object.entries(INPUT_INFO).forEach(async ([key, value]) => {
        const select = MdlForm.querySelector(`#${key}`);
        const options = select.querySelectorAll("option");

        select.addEventListener("input", (e) => {
          MdlForm.querySelectorAll("select").forEach(
            (element) => (element.disabled = false)
          );
        });

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

          let solValid = value.toLowerCase() === "completado";

          select.addEventListener("input", (e) => {
            solValid = e.target.value.toLowerCase() === "completado";

            solution.required = solValid;
            solution.disabled = !solValid;
          });

          solution.required = solValid;
          solution.disabled = !solValid;
        }

        if (key === "subcat") {
          const app = document.querySelector("#app");
          const other = document.querySelector("label[for='other']");
          select.addEventListener("input", (e) => {
            let valid =
              e.target.value.toLowerCase() === "instalar" ||
              e.target.value.toLowerCase() === "revisar";
            app.disabled = !valid;
            app.required = valid;

            let otherVal = e.target.value.toLowerCase() === "otro";
            if (!otherVal) other.classList.add("hidden");
            if (otherVal) other.classList.remove("hidden");

            const OTHERINPUT = other.querySelector("input");

            OTHERINPUT.disabled = !otherVal;
            OTHERINPUT.required = otherVal;

            e.target.disabled = otherVal;
          });

          let valid =
            value.toLowerCase() === "revisar" ||
            value.toLowerCase() === "instalar";
          app.disabled = !valid;
          app.required = valid;
        }

        if (key === "category") {
          const subcats = await Information.postJSON("/admin/subcats/get", {
            cat: value.toLowerCase(),
          });

          const subcatsSelector = MdlForm.querySelector("#subcat");

          const subs = subcatsSelector.querySelectorAll(".subs");

          subs.forEach((sub) => sub.remove());

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

      MdlForm.onsubmit = () => {
        viewMdl.classList.add("hidden");
        TOAST("Cargando nueva Informacion...", "right");

        setTimeout(() => {
          btn.click();
        }, 2500);
      };

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

  const subcatsSelector = MdlForm.querySelector("#subcat");

  const subcats = await Information.postJSON("/admin/subcats/get", {
    cat: categorySelector.options[categorySelector.options.selectedIndex].value,
  });

  console.log(subcats);

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

  categorySelector.addEventListener("input", async (e) => {
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
  const ViewMdl = document.querySelector(".inv-view");

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

  form.addEventListener("input", async (e) => {
    const formData = new FormData(form);
    const body = {};
    formData.forEach((value, key) => {
      body[key] = value;
    });
    query = await Information.postJSON("/admin/tickets/indexer", body);

    TechnicalPodium(query);
    PerTypeGraphic(query);
    TicketGraphicCards(query);
    metricTime(query)
  });

  TechnicalPodium(query);
  PerTypeGraphic(query);
  TicketGraphicCards(query);
  metricTime(query);
}

function usrsCreationForm() {
  const table = document.querySelector(".usrs-table");

  if (!table) return;

  const viewMdl = document.querySelector(".form-usrs-view");
  const MdlForm = viewMdl.querySelector("form");
  const close = viewMdl.querySelector(".modal-close-btn");

  const btns = document.querySelectorAll(".view-btn");

  let cellID = null;
  let formData = null;
  btns.forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      cellID = btn.getAttribute("cell-id");

      const delButton = MdlForm.querySelector(".btn-red");

      viewMdl.classList.remove("hidden");

      if (cellID) {
        const HIDDEN = new Element(
          "INPUT",
          { type: "hidden", value: null, name: "id" },
          {},
          []
        );

        MdlForm.appendChild(HIDDEN.render());

        const query = await Information.postJSON("/admin/usrs/find", {
          id: cellID,
        });

        Object.entries(query).forEach(([key, value]) => {
          if (MdlForm[key].length) {
            MdlForm[key].forEach((radio) => {
              radio.checked = radio.value.toLowerCase() === value.toLowerCase();
            });
          } else {
            MdlForm[key].value = value;
          }
        });

        delButton.classList.remove("hidden");
        delButton.addEventListener("click", async (e) => {
          const deleter = await Information.postJSON("/admin/usrs/delete", {
            id: cellID,
          });

          location.reload();
        });
      } else {
        delButton.classList.add("hidden");
        formData = new FormData(MdlForm);

        formData.entries().forEach(([key, value]) => {
          if (MdlForm[key].length) {
            MdlForm[key].forEach((radio) => (radio.checked = false));
            return;
          }

          MdlForm[key].value = null;
        });
      }

      MdlForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        formData = new FormData(e.target);

        const body = {};

        let rows = [];
        formData.entries().forEach(([key, value]) => {
          body[key] = value;
        });
        const payload = await Information.postJSON("/admin/usrs/save", body);

        TOAST("Informacion de Usuarios actualizada correctamente!!!", "center");

        location.reload();
      });

      close.addEventListener("click", (e) => {
        viewMdl.classList.add("hidden");
      });
    });
  });
}


function entriesFormFront() {


  const containerEntries = document.querySelector(".entries");

  if (!containerEntries) return;

  const addEntriesBTN = document.querySelector(".add-entry-btn");
  const updateEntryBTN = document.querySelectorAll(".update-entry-btn")
  const deleteEntryBTN = document.querySelectorAll(".delete-entry-btn")

  const Mdl = document.querySelector(".entry-form");
  const MdlForm = Mdl.querySelector("form");

  addEntriesBTN.addEventListener("click", e => {

    Mdl.classList.remove("hidden")


    const inputs = MdlForm.querySelectorAll("input");
    const textarea = MdlForm.querySelector("textarea")

    inputs.forEach(input => {
      if (input.type === 'radio') input.checked = false;
      if (input.type === 'text' || input.type === 'hidden') input.value = "";

    })
    textarea.value = "";


  })



  updateEntryBTN.forEach(btn => {

    btn.addEventListener("click", async e => {

      const id = btn.getAttribute("data-id");


      Mdl.classList.remove("hidden");

      const query = await Information.postJSON("/admin/entradas/find", {

        id: id

      })


      Object.entries(query).forEach(([key, value]) => {

        if (!MdlForm[key]) return;

        const actual = MdlForm[key];

        if (actual.length > 0) {

          actual.forEach(radio => {

            radio.checked = radio.value === value.toLowerCase();

          })

          return;

        }
        MdlForm[key].value = value;


      })






    })



  })
  deleteEntryBTN.forEach(btn => {

    btn.addEventListener("click", async e => {

      const id = btn.getAttribute("data-id");



      const query = await Information.postJSON("/admin/entradas/delete", {

        id: id

      })



      btn.parentNode.parentNode.remove();





    })



  })






}


function results() {


  const params = new URLSearchParams(window.location.search);


  const result = params.get("result");


  if (result === "1") TOAST("Solicitud realizada correctamente!!!", "center", "/");




}


function ServerForm() {


  const Mdl = document.querySelector(".create-server-modal");
  if (!Mdl) return;

  const form = Mdl.querySelector(".srvr-form");
  const updateBTN = document.querySelectorAll(".update-srv-btn");
  const deleteBTN = document.querySelectorAll(".delete-srv-btn");

  const createBTN = document.querySelector(".create-srvr-btn")

  updateBTN.forEach(btn => {

    btn.addEventListener("click", async e => {

      const id = btn.getAttribute("data-id");

      const query = await Information.postJSON("/admin/servers/find", { id })

      Object.entries(query).forEach(([key, value]) => {


        if (key === "maintenance") {

          Array.from(form[key].options).forEach(option => {
            if (option.value === value) option.selected = true;
            else option.selected = false;
          })
        } else {
          form[key].value = value
        }



      })

      Mdl.classList.remove("hidden")


    })


  })

  createBTN.addEventListener("click", e => {


    Mdl.classList.remove("hidden")


    Object.entries(form).forEach(([key, value]) => {

      if (key === "maintenance") return
      form[key].value = "";


    })


  })

  deleteBTN.forEach(btn => {
    btn.addEventListener("click", async e => {


      const id = btn.getAttribute("data-id");


      const query = await Information.postJSON("/admin/servers/delete", { id });


      location.reload();

    })
  })


  form.addEventListener("submit", async e => {

    e.preventDefault();

    const data = new FormData(e.target);


    let body = {}

    data.entries().forEach(([key, value]) => {


      body[key] = value;


    })




    const query = await Information.postJSON("/admin/servers/save", body);


    setTimeout(() => {

      form.querySelector(".btn-submit").disabled = false;
    }, 1500);


    Mdl.classList.add("hidden")

    location.reload();


  })




}



function UserForm() {


  const Mdl = document.querySelector(".create-user-modal");

  if (!Mdl) return;

  const form = Mdl.querySelector(".usr-form");
  const addUserBTN = document.querySelector(".create-srvr-usr-btn")
  const updateBTN = document.querySelector(".update-usr-btn");
  const deleteBTN = document.querySelector(".delete-usr-btn");


  updateBTN.addEventListener("click", async e => {


    const id = updateBTN.getAttribute("data-id")

    Mdl.classList.remove("hidden");

    const query = await Information.postJSON("/admin/server_users/find", { id });

    Object.entries(query.user).forEach(([key, value]) => {

      if (["created_at", "updated_at"].includes(key)) return;

      if (key === "server_id") {

        Array.from(form[key].options).forEach(option => {

          if (option.value === value) option.selected = true;
          else option.selected = false;

        })
        return;
      }


      form[key].value = value;


    })



  })

  deleteBTN.addEventListener("click", async e => {


    const id = updateBTN.getAttribute("data-id")

    await Information.postJSON("/admin/server_users/delete", { id });

    location.reload();



  })

  addUserBTN.addEventListener("click", e => {

    Object.entries(form).forEach(([key, value]) => {


      form[key].value = "";


    })

    Mdl.classList.remove("hidden");

  })


  form.addEventListener("submit", async e => {

    e.preventDefault();
    const data = new FormData(e.target);
    let body = {};

    data.entries().forEach(([key, value]) => {

      body[key] = value;

    })

    await Information.postJSON("/admin/server_users/save", body);

    Mdl.classList.add("hidden");

    location.reload();

  })


}

async function AdminDashBoard() {


  const dashboard = document.querySelector(".admin-dashboard");
  if (!dashboard) return;

  const TicketCtx = document.querySelector('#tickets-chart').getContext('2d');


  const tickets = await Information.postJSON("/tickets/get");


  //NOTE: TICKETS POR MES
  //TODO: PASAR TODA LA RESPONSABILIDAD DE LAS GRAFICAS A UNA FUNCION APARTE QUE SE LLAME MAS FACIL (UNA FUNCION POR GRAFICA PARA SIMPLIFICACION DE LOGICA Y REDUCCION DE CODIGO)



  const currentMonth = new Date().getMonth();
  const currentYear = new Date().getFullYear();

  const ticketCounts = tickets.reduce((acc, ticket) => {
    const ticketMonth = new Date(ticket.fecha).getMonth();
    const ticketYear = new Date(ticket.fecha).getFullYear();

    if (ticketMonth === currentMonth && ticketYear === currentYear) {
      acc[ticket.categoria] = (acc[ticket.categoria] || 0) + 1;
    }
    return acc;
  }, {});


  const data = {
    labels: Object.keys(ticketCounts),
    datasets: [{
      label: 'Tickets',
      data: Object.values(ticketCounts),
      borderWidth: 1,

    }]
  };

  const config = {
    type: 'pie',
    data: data,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {

          display: true,
          text: 'Resumen de tickets de este mes',
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
              return tooltipItem.label + ': ' + tooltipItem.raw + ' tickets';
            }
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

  const TChart = new Chart(TicketCtx, config);
  const invCTX = document.querySelector("#inv-chart").getContext("2d");

  setInvTypeChart(invCTX);

  const orders = await Information.postJSON("/admin/orders/get",)


  let orderTypes = {

    entrega: [],
    salida: [],
    recepcion: []
  }

  orders.forEach(order => {
    let type = "";

    if (order.order_id.includes("ODE")) type = "entrega";
    if (order.order_id.includes("ODS")) type = "salida";
    if (order.order_id.includes("ODR")) type = "recepcion";


    const orderMonth = new Date(order.emitted_date).getMonth();
    const orderYear = new Date(order.emitted_date).getFullYear();




    if (orderMonth === currentMonth && currentYear === orderYear) orderTypes[type].push(order);





  })







  const orderTypeData = {
    labels: Object.keys(orderTypes).map(x => x.toUpperCase()),
    datasets: [{
      label: 'Tipo',
      data: Object.values(orderTypes).map(x => x.length),
      borderWidth: 1,

    }]
  };


  const orderTypeConfig = {
    type: 'pie',
    data: orderTypeData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Resumen de Ordenes',
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


  const orderTypeCTX = document.getElementById("orders-type-chart").getContext("2d");

  const orderTypeChart = new Chart(orderTypeCTX, orderTypeConfig)


  const briefCards = document.querySelector(".container-brief-cards");



  const briefTickets = briefCards.querySelector(".month-total-tickets");
  const briefINV = briefCards.querySelector(".total-inventory");
  const briefOrders = briefCards.querySelector(".month-total-orders");

  const inventory = await Information.postJSON("/admin/inventory/get");

  let monthTickets = 0
  let totalinv = inventory.length
  let totalOrders = 0



  Object.values(ticketCounts).forEach(value => {


    monthTickets += value;





  });

  Object.values(orderTypes).forEach(value => {


    totalOrders += value.length;





  });








  briefTickets.textContent = monthTickets
  briefINV.textContent = totalinv
  briefOrders.textContent = totalOrders




}

async function InvDashboard() {
  const dashboard = document.querySelector(".inv-dashboard");
  const inventory = await Information.postJSON("/admin/inventory/get");

  if (!dashboard) return;
  


  const typeCTX = document.querySelector("#inv-type-chart").getContext("2d");

  setInvTypeChart(typeCTX);

  const propertyCTX = document.querySelector("#inv-property-chart").getContext("2d");


  const propertyData = inventory.reduce((acc, item) => {
    const propietario = item.propietario || "Desconocido";
    acc[propietario] = (acc[propietario] || 0) + 1;
    return acc;
  }, {});

  const areaData = inventory.reduce((acc, item) => {
    const area = item.area || "Stock";
    acc[area] = (acc[area] || 0) + 1;
    return acc;
  }, {});

  const areaChartData = {
    labels: Object.keys(areaData),
    datasets: [{
      label: 'Área',
      data: Object.values(areaData),
      borderWidth: 1,
    }]
  };

  const areaChartConfig = {
    type: 'pie',
    data: areaChartData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Inventario por Área',
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
              return tooltipItem.label + ': ' + tooltipItem.raw;
            }
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

  const areaCTX = document.querySelector("#inv-area-chart").getContext("2d");
  const areaChart = new Chart(areaCTX, areaChartConfig);

  const propertyChartData = {
    labels: Object.keys(propertyData),
    datasets: [{
      label: 'Propietario',
      data: Object.values(propertyData),
      borderWidth: 1,
    }]
  };

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
              return tooltipItem.label + ': ' + tooltipItem.raw;
            }
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

  const propertyChart = new Chart(propertyCTX, propertyChartConfig);



  const locationData = inventory.reduce((acc, item) => {
    const sede = item.sede || "Desconocido";
    acc[sede] = (acc[sede] || 0) + 1;
    return acc;
  }, {});

  const locationChartData = {
    labels: Object.keys(locationData),
    datasets: [{
      label: 'Sede',
      data: Object.values(locationData),
      borderWidth: 1,
    }]
  };

  const locationChartConfig = {
    type: 'pie',
    data: locationChartData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'Inventario por Sede',
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
              return tooltipItem.label + ': ' + tooltipItem.raw;
            }
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


  const locationCTX = document.querySelector("#inv-location-chart").getContext("2d");
  const locationChart = new Chart(locationCTX, locationChartConfig);


}


async function PollDashboard() {


  const polls = await Information.postJSON("/admin/encuestas");


  let body = {}


  polls.forEach(poll => {


    Object.entries(poll.individual_test).forEach(([key, value]) => {




      if (!body[key]) body[key] = {
        amability: 0,
        quality: 0,
        response: 0,
        name: "",
        polls: 0
      };


      Object.entries(value).forEach(([key1, value1]) => {

        if (body[key][key1] === "") body[key][key1] = value1;


        if (typeof body[key][key1] === "number") body[key][key1] += Number(value[key1]);





      });

      body[key]["polls"] += 1;


    })


  })


  Object.entries(body).forEach(([key, value]) => {

    Object.entries(value).forEach(([category, val]) => {

      if (category === "polls" || category === "name") return;

      body[key][category] = val / body[key]["polls"];


    })


  })



  const polLCtx = document.querySelector("#chart-by-point").getContext("2d");


  const labels = Object.values(body).map((poll) => poll.name);

  const pollData = {
    labels: labels,
    datasets: [
      {
        label: "Amabilidad y Profesionalismo",
        data: Object.values(body).map((poll) => poll.amability),
        backgroundColor: "rgb(255, 99, 133)",
        borderColor: "rgba(255, 99, 132, 1)",
        borderWidth: 1,
      },
      {
        label: "Calidad de Servicio",
        data: Object.values(body).map((poll) => poll.quality),
        backgroundColor: "rgb(54, 163, 235)",
        borderColor: "rgba(54, 162, 235, 1)",
        borderWidth: 1,
      },
      {
        label: "Tiempo de Respuesta",
        data: Object.values(body).map((poll) => poll.response),
        backgroundColor: "rgb(75, 192, 192)",
        borderColor: "rgba(75, 192, 192, 1)",
        borderWidth: 1,
      },
    ],
  };

  const pollConfig = {
    type: "bar",
    data: pollData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: "Resultados de Encuestas",
          color: "white",
          font: {
            size: 18,
          },
        },
        legend: {
          position: "top",
          labels: {
            color: "white",
          },
        },
      },
      scales: {
        x: {
          ticks: {
            color: "white",
          },
        },
        y: {
          ticks: {
            color: "white",
          },
          beginAtZero: true,
        },
      },
    },
  };

  const pollChart = new Chart(polLCtx, pollConfig);











}

document.addEventListener("DOMContentLoaded", (e) => {
  addPer();
  delPer();
  sign();
  tableSearchManager();
  dragNdrop();
  viewAdminInv();
  viewAdminTicket();
  invActions();
  viewAdminDocumentation();
  TicketGraphicsControllers();
  imageViewer();
  usrsCreationForm();
  noReturn();
  entriesFormFront();
  results();
  ServerForm();
  UserForm();
  AdminDashBoard();
  InvDashboard();
  PollDashboard();

});

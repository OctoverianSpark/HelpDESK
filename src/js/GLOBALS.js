import { Element } from "./Class/Element.min.js";
import { Information } from "./Class/Information.min.js"

function RADIOCARD(name, id, text, icon,value = "") {
  const INPUT = new Element("INPUT", { name: name, id: id, type: "radio",value:value });

  const I = new Element("I", { class: icon });

  const SPAN = new Element("SPAN", {}, { textContent: text });

  const LABEL = new Element(
    "LABEL",
    { for: id, class: "radio-label-card" },
    {},
    [INPUT, I, SPAN]
  );

  return LABEL;
}

function INPUTGROUP(name, id, text, placeholder, type = "text") {
  const SPAN = new Element("SPAN", {}, { textContent: text }, []);
  const INPUT = new Element(
    "INPUT",
    { id: id, type: type, placeholder: placeholder, name: name },
    []
  );
  const LABEL = new Element("LABEL", { for: id, class: "input-group" }, {}, [
    SPAN,
    INPUT,
  ]);

  return LABEL;
}

function GENCONTAINER(tag, className, childs = []) {
  const CONTAINER = new Element(tag, { class: className }, {}, childs);

  return CONTAINER;
}

function TOAST(text,pos,dest=""){
  
  Toastify({
    text: text,
    duration: 1500,
    close: true,
    gravity: "top",
    margin:"10",
    position: pos,
    backgroundColor: "linear-gradient(to right,rgb(89, 74, 177),rgb(47, 66, 107))",
    destination: dest,
  }).showToast();
}

async function GETCOOKIES(){
  const cookies = await Information.postJSON("/admin/cookies/get")
  
  return cookies;
}


function randomColor() {
  const letters = "0123456789ABCDEF";
  let color = "#";
  for (let i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}




export { GENCONTAINER, RADIOCARD, INPUTGROUP,TOAST, GETCOOKIES,randomColor };

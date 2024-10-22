
Notification.requestPermission()

function EventListeners() {
    if (location.href.match("/admin/inventario/crear") || location.href.match("/admin/inventario/actualizar")) {
        añadirPeriferico();
    }else if (location.href.match("/encuesta")) {
        tickChange()
    }else if(location.href.match("/admin/entradas")){
        checkSubmit()
    }else if(location.href.match("/admin/inventario/ordenes")){
        orderMode()
    }
    
    llamarOtro();
    cancelForm();
    notifications();
    openDrop();
    notificarClickup();
    clipBoard()
    openModal()
    dragNdrop()
    sign()

}

function sign() {
    const canvas = document.getElementById("canvas");
    const containerActions = document.querySelector(".container-actions")



    if (canvas) {
        canvas.style.display="none"
        containerActions.style.display="none"
        const check = document.querySelector("#accept")

        check.addEventListener("input",e=>{

            if(e.target.checked){

                canvas.removeAttribute("style")
                containerActions.removeAttribute("style")

                const context = canvas.getContext("2d")

                const pencilColor = "black"
    
                let xBefore=0,
                    yBefore=0,
                    xActual=0,
                    yActual=0
    
    
                let drawing= false
    
                const btnLimpiar = document.querySelector("#clean-canvas")
    
                const getRealX = (clientX)=>clientX - canvas.getBoundingClientRect().left;
                
                const getRealY = (clientY)=>clientY - canvas.getBoundingClientRect().top;
    
                const limpiarCanvas = () => {
                    // Colocar color blanco en fondo de canvas
                    context.fillStyle = "white";
                    context.fillRect(0, 0, canvas.width, canvas.height);
                };
                limpiarCanvas();
                btnLimpiar.onclick = limpiarCanvas;
    
                canvas.addEventListener("mousedown",e=>{
    
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

                    
    
                })
    
    
                canvas.addEventListener("mousemove",e=>{
    
                    if(!drawing){
                        return;
                    }
                    xBefore = xActual;
                    yBefore = yActual;
                    xActual = getRealX(e.clientX)
                    yActual = getRealY(e.clientY)
                    context.beginPath()
                    context.moveTo(xBefore,yBefore)
                    context.lineTo(xActual,yActual)
                    context.strokeStyle = pencilColor;
                    context.lineWidth = 3
    
                    context.stroke();
                    context.closePath();
    
    
                })
    
                canvas.addEventListener("mouseout",e=>{
                    drawing = false;
                })
                canvas.addEventListener("mouseup",e=>{
                    drawing = false;
                })

                                
                window.obtenerImagen = () =>{                        
                    

                    return canvas.toDataURL()
                }

                document.querySelector("form").addEventListener("submit",e=>{
                    
                    e.preventDefault()
                    const imprimible = window.open("/orden/print" + window.location.search)

                    imprimible.addEventListener("DOMContentLoaded",e=>{
                        imprimible.print()
                    })

                })

            }else{
                

                canvas.style.display="none"
                containerActions.style.display="none"
            }

           
    
            
            

        })
    
    }
        


}



function cancelForm(){


    const submitForm = document.querySelector("input[type='submit']")
    const form = document.querySelector("form")


    if(form){


        form.addEventListener("submit",e=>{
            

            submitForm.disabled = true

            
        })


        

    }



}


function clipBoard(){

    const clipBoardButton = document.querySelector(".clipboard-button")

    if(clipBoardButton){

        clipBoardButton,addEventListener("click",e=>{
    
    
            navigator.clipboard.writeText(clipBoardButton.textContent)
        })

    }

}



async function notifications(){
   
        const botonNotis = document.querySelector(".boton-notificaciones")
        const bell = document.querySelector("#bell")
        const quantity = document.querySelector("#quantity")

        const data = await fetch("/notificaciones")
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.text();
        })
        .then(data => {
            if (data) {
                return JSON.parse(data);
            } else {
                throw new Error('Empty response');
            }
        })
        .then(jsonData => {
            bell.classList.add("bx-tada")
            quantity.classList.add(`bi-${jsonData.length}-circle-fill`)
                
            if (Notification.permission === "granted") {
                
                jsonData.forEach(
                    info=>{
                        let push = new Notification(
                            info.titulo,
                            {
                                body:info.contenido
                            }
                        )
    
                        push.addEventListener("click",e=>{
                            location.href = info.url
                        })
                    }
                )
        
            }
        })
        .catch(error => console.error('Error:', error));

    
    




}


function openDrop(){
    const drop = document.querySelector(".drop-notificaciones")
    const notificaciones = document.querySelector(".boton-notificaciones")
    let down = true
    notificaciones.addEventListener("click",e=>{
        
        if(down){
            drop.style.display = "block"
            drop.classList.add("in")
            down=false
        }else{
            drop.style.display = "none"
            drop.classList.add("out")
            down=true
        }


    })





    

    
}

function orderMode(){

    const form = document.querySelector(".form-order")



    if(form){

        const type = form.querySelector("#type")


        const salida = form.querySelector("#salida")
        const retorno = form.querySelector("#retorno")

        const asignee = form.querySelector("#nombre")

        const otherNameContainer = form.querySelector("#container-othername")
        const otherName = otherNameContainer.querySelector("#otroNombre")

        type.addEventListener("input",e=>{
            let nameFirstLetter = e.target.value.charAt(0).toUpperCase()
            let nameRemains = e.target.value.substring(1)

            document.querySelector("#order-name").textContent = nameFirstLetter + nameRemains
            
            salida.style.display = "none"
            salida.disabled = true

            retorno.style.display = "none"
            retorno.disabled = true

            if (e.target.value == "salida") {
                
                salida.removeAttribute("style")
                retorno.removeAttribute("style")
                salida.disabled = false
                retorno.disabled = false
    

            }


        })

        asignee.addEventListener("input",e=>{

            
            otherNameContainer.style.display = "none"
            otherName.disabled = true

            if (e.target.value == "other") {
                otherNameContainer.removeAttribute("style")
                otherName.disabled = false

            }


        })
    }



}

function checkSubmit(){
    const inputs = document.querySelectorAll("#type")
    const forms = document.querySelectorAll(".show-form")


    inputs.forEach(input=>{
        input.addEventListener("input",e=>{
            
            forms.forEach(form=>{
                form.submit()
            })
        })
    })

    
}


function tickChange(){


    const inputs = document.querySelectorAll("input[type='range']")
    const promedial = document.querySelector(".promedial")
    const promedialInput = document.querySelector("#promedial")
    let promedioSum = 0

    inputs.forEach(input=>{
        const value = document.querySelector(`.${input.id}-value`)
        value.textContent = input.value

        input.addEventListener("input", e=>{
            value.textContent = e.target.value
            promedioSum = parseInt(inputs[0].value) + parseInt(inputs[1].value) +parseInt(inputs[2].value) +parseInt(inputs[3].value) 
            
            let promedioFinal = promedioSum / inputs.length;
            
            promedial.textContent = promedioFinal
            promedialInput.value = promedioFinal


        } )


    })



    

}

function llamarOtro() {
    
    const otroContainer = document.querySelector("#otro-container")
    if (otroContainer) {
        const otroText = otroContainer.querySelector("input#otro")
        const otroLbl = otroContainer.querySelector("label[for='otro']")
    
        const apps = document.querySelector("#apps")
        const subcat = document.querySelector("#subcategoria")
    
        if(subcat){
            subcat.addEventListener("change", e=>{
                if (e.target.value == "Otro...") {
                    otroContainer.removeAttribute("style")
                    otroLbl.textContent = "Nombre de la subcategoria"
                    otroText.setAttribute("name","tickets[subcategoria]")
                }else{
    
    
                    otroContainer.style.display="none"
                    
    
                }
            })
    
        }
    
        if (apps) {
            apps.addEventListener("change",e=>{
                if (e.target.value == "Otro...") {
                    otroContainer.removeAttribute("style")
                    otroLbl.textContent = "Nombre de la aplicacion"
                    otroText.setAttribute("name","tickets[selected_app]")
                }else{
    
    
                    otroContainer.style.display = "none"
                    
    
                }
            })
            
        }
        
    }
    

}

function añadirPeriferico(){
    const addButton = document.querySelector("#addButton")
    const removeButton = document.querySelector("#removeButton")
    const fieldSet = document.querySelectorAll("#fieldset-periferico")
    const tmplate = document.querySelector("#fieldset-tmplate")
    const containerP = document.querySelector(".container-periferals")
    let clicks = 0
    let fieldSets = fieldSet.length

    if (fieldSet.length >1) {
        removeButton.disabled = false
    }
    addButton.addEventListener("click",e=>{
        
        clicks++
        if (fieldSets >0) {
            nextFieldset = parseInt(clicks) + (fieldSet.length-1)
            
        }else{
            nextFieldset = clicks - 1
        }
        removeButton.disabled = false
        fieldSetClone = tmplate.cloneNode(deep = true)
        fieldSetClone.style.display = "block"
        fieldSetClone.disabled = false
        fieldSetClone.id = "fieldset-periferico"
        fieldSetClone.querySelector("#tipo_periferico").setAttribute("name",`perifericos[${nextFieldset}][tipo]`)
        fieldSetClone.querySelector("#marca_periferico").setAttribute("name",`perifericos[${nextFieldset}][marca]`)
        fieldSetClone.querySelector("#modelo_periferico").setAttribute("name",`perifericos[${nextFieldset}][modelo]`)
        fieldSetClone.querySelector("#color_periferico").setAttribute("name",`perifericos[${nextFieldset}][color]`)
        fieldSetClone.querySelector("#serial_periferico").setAttribute("name",`perifericos[${nextFieldset}][serial]`)

        containerP.appendChild(fieldSetClone)
        
            


        
        
    })

    
    removeButton.addEventListener("click", e=>{
        
        const fieldSet = document.querySelectorAll("#fieldset-periferico")
        const removeButton = document.querySelector("#removeButton")
        if (fieldSet.length-1 < 0) {
            removeButton.disabled = true
        }else{
            fieldSet[fieldSet.length - 1].remove()

        }




        




    }
    )

}


function openModal(){

    const modalButton = document.querySelector(".modal-button")
        const modal = document.querySelector(".modal")

    if(modalButton){



        modalButton.addEventListener("click",e=>{

            console.log("A")
            modal.removeAttribute("style")
            modal.classList.add("appear")
        
            
            
    
        })


    }
    const modalClose = document.querySelector(".close-modal")

    if (modalClose) {
        modalClose.addEventListener("click",e=>{

            modal.style.display="none"


        })
        
    }

}



function notificarClickup(){
    
    const form = document.querySelector("#tik-form")
    if(form){
        form.addEventListener("submit",e=>{
            const api = "pk_82319104_47GHX06YGVUDO4QUAIYXJAET4U5B4ZLW"
            
            const listId = '901405411492';
        
        
        
            const resp = fetch(
                `https://api.clickup.com/api/v2/list/${listId}/task`,
                {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    Authorization: api
                  },
                  body: JSON.stringify({
                    name: 'Ticket Creado',
                    description: 'Revisar aplicacion de tickets',
                  })
                }
              )
        
    
    
    
    
    
    
        })

    }


}

function dragNdrop(){

    const dragable = document.querySelector(".dragable")

    let startX = 0
    let startY = 0
    let newX = 0
    let newY = 0

    if(dragable){
        dragable.addEventListener("mousedown",mouseDown)

    }


    function mouseDown(e){
        startX = e.clientX
        startY = e.clientY
    
        
        document.addEventListener("mousemove",mouseMove)
        document.addEventListener("mouseup",mouseUp)
    
    }
    
    
    function mouseMove(e){
        
        newX = startX - e.clientX
        newY = startY - e.clientY
    
    
        startX = e.clientX
        startY = e.clientY
    
        dragable.style.top = (dragable.offsetTop - newY) + "px"
        dragable.style.left = (dragable.offsetLeft - newX) + "px"
    
    }


    function mouseUp(e){
        document.removeEventListener("mousemove",mouseMove)
    }

}

document.addEventListener("DOMContentLoaded",e=>{
    EventListeners();
})








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
    }else if (location.href.match("/orden")) {
        check();

    }
    llamarOtro();
    cancelForm();
    notifications();
    openDrop();
    notificarClickup();
    
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

    const orderTypeSelector = document.querySelector("#orders-type")

    const manualForm = document.querySelector("#order-manual")
    const requestForm = document.querySelector("#order-requested")

    manualForm.style.display = "block"

    orderTypeSelector.addEventListener("input",e =>{



        if(e.target.value === "manual"){
            manualForm.style.display = "block"
            requestForm.style.display = "none"
        }else if(e.target.value==="request"){
            requestForm.style.display = "block"
            manualForm.style.display = "none"

        }


    })
    


}

function check(){
    const check = document.querySelector("#accept")

    check.addEventListener("change",e=>{
        const text = document.querySelector("#nameSign")

        if(e.target.checked){
            text.disabled = false
        }else{
            text.disabled = true
        }

    })
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
    
    const otroText = document.querySelector("#otro")
    const otroLbl = document.querySelector("label[for='otro']")

    const apps = document.querySelector("#apps")
    const subcat = document.querySelector("#subcategoria")



    if(subcat){
        subcat.addEventListener("change", e=>{
            if (e.target.value === "Otro...") {
                otroText.style.display="block";
                otroLbl.style.display="block";
                otroLbl.textContent = "Define lo que presenta tu computador"
                otroText.setAttribute("name","tickets[subcategoria]")
            }else{
                e.preventDefault()
            }
        })

    }

    if (apps) {
        apps.addEventListener("change",e=>{
            if (e.target.value === "Otro...") {
                otroText.style.display="block";
                otroLbl.style.display="block";
                otroLbl.textContent = "Nombre de la aplicacion"
                otroText.setAttribute("name","tickets[selected_app]")
            }else{
                e.preventDefault()
            }
        })
        
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


document.addEventListener("DOMContentLoaded",e=>{
    EventListeners();
})







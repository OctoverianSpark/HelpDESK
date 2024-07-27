function checkPermission(){
    if(!"serviceWorker" in navigator){
        throw Error("serviceWorker is not allowed")
    }
}


const registerSW = async ()=>{

    const registration = await navigator.serviceWorker.register("/sw.js")
      
    return registration
}
  
const requestNofitications = async () =>{
    const permit = await Notification.requestPermission()
    if(permit !== "granted"){
        throw new Error("Not allowed")
    }else{
        new Notification("Hello World")
    }
}




const main = async () =>{
    checkPermission()


    const title = document.querySelector("#not-titulo")
    const content = document.querySelector("#not-content")

    const reg = await registerSW()

    if(title && content){
        reg.showNotification(title.value,{
            "body":content.value
        })

    }

}



function EventListeners() {
    main()

    if (location.href.match("/tickets/crear")) {
        llamarOtro();
    }else if (location.href.match("/admin/inventario/crear") || location.href.match("/admin/inventario/actualizar")) {
        añadirPeriferico();
    }else if (location.href.match("/orden")) {
        check();
    }else if (location.href.match("/encuesta")) {
        tickChange()
    }else if(location.href.match("/admin/entradas")){
        checkSubmit()
    }
    
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



document.addEventListener("DOMContentLoaded",e=>{
    EventListeners();
})







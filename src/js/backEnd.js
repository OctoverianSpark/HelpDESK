import {Information} from "./Class/Information.min.js"
import {GENCONTAINER, RADIOCARD, INPUTGROUP,TOAST} from "./GLOBALS.min.js"


console.log("BackEnd.js loaded");


function select(){


    const wrappers = document.querySelectorAll(".selector-wrapper")
    if(!wrappers.length>0) return;


    wrappers.forEach(wrapper=>{

        const search = wrapper.querySelector(".filter")

        const optionsList = wrapper.querySelector(".options")
        const options = Array.from(optionsList.querySelectorAll(".option"))
    
    
    
        let result = []
    
        wrapper.addEventListener("click",e=>{
            wrapper.classList.toggle("active")
        })
    
    
        options.forEach(option=>{
            
            const span = option.querySelector("span")
            const input = option.querySelector("input")
            input.addEventListener("input",e=>{
                search.value = span.textContent
                wrapper.classList.remove("active")
    
            })
    
        })
    
    
        search.oninput = (e) =>{
            result = [];
    
            options.forEach(element=>{
                element.classList.add("hidden")
            })
    
            if (e.target.value.length) {
    
                options.filter((keyword)=>{
                    
                    const option = keyword.querySelector("span")
                    const input = keyword.querySelector("input")
    
                    if(option.textContent.toLowerCase().includes(e.target.value.toLowerCase())){
                        
                        result.push(keyword)
    
                    }
    
    
    
                
                })
    
    
    
            }
    
    
    
            
            result.forEach(element=>{
                element.classList.remove("hidden")
            })
    
    
    
    
        }
    })





}

function printActions(){


    const container = document.querySelector(".doc-order")


    if(!container)return



    window.addEventListener("beforeprint",e=>{
        
        container.classList.add("printing")
    })
    window.addEventListener("afterprint",e=>{
        
        container.classList.remove("printing")
    })
    
}


function autoFilter(){
    const form = document.querySelector(".selection-form");


    if(!form) return;


    const inputs = form.querySelectorAll("input[type='radio']")


    inputs.forEach(input=>{

        input.addEventListener("input",e=>{

            Information.formGET(form);

        })


    })


}



function inhabilitate(){

    const checkbox = document.querySelectorAll(".dsb-check")

    checkbox.forEach(check=>{

        check.addEventListener("input",e=>{


            const inputs = check.parentNode.parentNode.querySelectorAll("input[type='text']")
            inputs.forEach(input=>{
                input.disabled = e.target.checked
            })
        })


    })



}


function orderRadioSelector(){
    
    const container = document.querySelector(".container-grid-selector")
    if(!container) return;


    const selectors = container.querySelectorAll(".radio-label-card input[type='radio']");

    selectors.forEach(sel=>{

        sel.addEventListener("input",e=>{
            
            selectors.forEach(s=>{

                if (!s.checked) {
                    s.parentNode.remove();
                }
                    

            })

        })



    })

    
}



function persGET(){

    const container  = document.querySelector(".ord-form")
    const radios = document.querySelectorAll("input[type='radio'][computer-id]")

    radios.forEach(radio=>{
        radio.addEventListener("input",async e=>{
            
            const computer_id = radio.getAttribute("computer-id")
            
            const pers = await Information.postJSON("/admin/pers/find",{
                "computer_id":computer_id
            });
            let monitors = pers.filter(e=>{
                if (e.tipo == "MONITOR") {
                    return e
                }
            }).length

            pers.forEach(per=>{
                console.log(per.tipo)

                if(per.tipo==="MONITOR"){

                    const check = container.querySelector(`#no-${per.tipo.toLowerCase()}-${monitors}`)
                    const marca = container.querySelector(`#${per.tipo.toLowerCase()}-${monitors}-marca`)
                    const modelo = container.querySelector(`#${per.tipo.toLowerCase()}-${monitors}-modelo`)
                    const serial = container.querySelector(`#${per.tipo.toLowerCase()}-${monitors}-serial`)

                    monitors--

                    check.checked = false
                    marca.value = per.marca
                    modelo.value = per.modelo
                    serial.value = per.serial
                    marca.disabled = check.checked
                    modelo.disabled = check.checked
                    serial.disabled = check.checked
    
                }else{
                    
                    const check = container.querySelector(`#no-${per.tipo.toLowerCase()}`)
                    const marca = container.querySelector(`#${per.tipo.toLowerCase()}-marca`)
                    const modelo = container.querySelector(`#${per.tipo.toLowerCase()}-modelo`)
                    const serial = container.querySelector(`#${per.tipo.toLowerCase()}-serial`)
                    
                    check.checked = false
                    marca.value = per.marca
                    modelo.value = per.modelo
                    serial.value = per.serial
                    marca.disabled = check.checked
                    modelo.disabled = check.checked
                    serial.disabled = check.checked

                }


                


            })

            

        })
    })

}



async function ticketUpdate(){
    
    const viewMdl = document.querySelector(".tickets-view");
    if(!viewMdl)return
    const form = viewMdl.querySelector(".ticket-admin-form")


    form.addEventListener("submit",async e=>{
        TOAST("Actualizando ticket...","right")
        e.preventDefault()
        const formData = new FormData(form)

        const body = {}

        formData.entries().forEach(([key,value])=>{

            body[key] = value

        })

        const ticket = await Information.postJSON("/tickets/find",{
            "id":body.id
        })

        
        if(ticket.estado.toLowerCase() == "sin asignar"){

            if(body.estado=="en proceso"){

                
                body.fecha_asignada = new Date()

                body.fecha_asignada = body.fecha_asignada.toISOString().split('.')[0].replace('T', ' ')

                body.tiempo_en_asignar = Math.floor(calculateTime(ticket.fecha, body.fecha_asignada))

            }

        }

        if(ticket.estado.toLowerCase() == "en proceso"){
        
        
            if(body.estado=="completado"){
                body.fecha_completacion = new Date()
                body.fecha_completacion = body.fecha_completacion.toISOString().split('.')[0].replace('T', ' ')

                body.tiempo_en_completar = Math.floor(calculateTime(ticket.fecha_asignada,body.fecha_completacion))
            }

            if(body.estado=="pendiente"){
                body.fecha_pendiente = new Date()
                body.fecha_pendiente = body.fecha_pendiente.toISOString().split('.')[0].replace('T', ' ')


                body.tiempo_en_pendiente = Math.floor(calculateTime(ticket.fecha_asignada,body.fecha_pendiente))
            }
        
        }
        if(ticket.estado.toLowerCase() == "pendiente"){
        
        
            if(body.estado=="completado"){
                body.fecha_completacion = new Date()
                body.fecha_completacion = body.fecha_completacion.toISOString().split('.')[0].replace('T', ' ')

                body.tiempo_en_completar = Math.floor(calculateTime(ticket.fecha_pendiente,body.fecha_completacion))
            }
        
        }

        
        console.log(body);


        
        const query = await Information.postJSON("/admin/tickets/update",body)

        TOAST("Recibiendo informacion...","right")

        viewMdl.classList.add("hidden")


        const row = document.querySelector(".table-row[data-id='"+body.id+"']")

        Object.entries(query.data).forEach(([key,value])=>{
            if(key==="id")return

            const cell = row.querySelector(".cell[data-col='"+key+"']")

            if(cell){
                cell.textContent = value.toUpperCase()
            }
        })

        TOAST(query.message,"right")



    })

}


function calculateTime(from,to){

    /**
     * Calculates the time in minutes between two dates
     * 
     * 
     * @param {String} from - The date from wich the time will be calculated 
     * @param {String} to - The date to wich the time will be calculated
     * 
     * @return {Number} - The time in minutes between the two dates
     * If the from is mayor than the to, the function will return negative minutes, if the from is less than the to, the function will return positive minutes
     * 
     */


    const fromDATE = new Date(from)
    const toDATE = new Date(to)

    let diff = toDATE - fromDATE

    diff = diff / 60000

    return diff

}



document.addEventListener("DOMContentLoaded",e=>{
    select()
    autoFilter()
    inhabilitate()
    orderRadioSelector()
    printActions()
    persGET()
    ticketUpdate()

})
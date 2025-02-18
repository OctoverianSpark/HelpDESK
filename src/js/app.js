import  Particle  from "./Class/Particle.js";


console.log("App.js loaded");


function loginBackground(){
    const canvas = document.querySelector(".loginCanvas")

    if (!canvas) return;
        
    
    const ctx = canvas.getContext("2d")    
    
    
    canvas.width = innerWidth
    canvas.height = innerHeight
    
    
    
    let bolas = []
    for (let i = 0; i < 30; i++) {
        bolas.push(new Particle(canvas,canvas.width/2, canvas.height /2))
        
    }
    
    
    function animar(){
    
    
        ctx.clearRect(0,0,canvas.width,canvas.height)
    
        bolas.forEach(Particle=>{
    
            bolas.forEach(target=>{
    
                let dx = target.x - Particle.x
                let dy = target.y - Particle.y
                let dist = Math.sqrt(dx**2 + dy**2)
    
                if (dist < 100) {
                    ctx.beginPath()
                    ctx.moveTo(Particle.x,Particle.y)
                    ctx.lineTo(target.x,target.y)
                    ctx.stroke()
                    ctx.strokeStyle = "#2b0c7e";
                    ctx.closePath()
        
                    
                }
    
    
            })
             
            Particle.draw()
            Particle.move()
        })
    
        requestAnimationFrame(animar)
    
    }
    
    animar()

}




function showPswrd(){
    const psswrd = document.querySelector("#psswrd")
    const showPsswrdBtn = document.querySelector(".pswrd-btn")
    if (!showPsswrdBtn) return;
    console.log(showPsswrdBtn)
        
    const icon = showPsswrdBtn.querySelector("i")
    showPsswrdBtn.addEventListener("click",e=>{

        if (psswrd.type == "password") {
            psswrd.type = "text"
            icon.classList.remove("bi-eye-fill")
            icon.classList.add("bi-eye-slash-fill")
        }else{
            psswrd.type = "password"
            icon.classList.remove("bi-eye-slash-fill")
            icon.classList.add("bi-eye-fill")
        }

    })

    
}
function notificarClickup(){
    
    const form = document.querySelector(".tickets-user-form")

    if (!form) return

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

function modalKEY(){


    document.addEventListener("keydown",e=>{

        const modal = document.querySelectorAll(".modal")
        if (e.key.toLowerCase() === "escape") {
            modal.forEach(modalElement => {

                if (!modalElement.classList.contains("hidden")) {
                    modalElement.classList.add("hidden")
                }
            });
        }


    })

}









document.addEventListener("DOMContentLoaded",e=>{


            

        loginBackground();
        showPswrd();
        notificarClickup();
        modalKEY();
        
}
);
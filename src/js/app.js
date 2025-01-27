import "./backEnd.min.js"
import "./frontEnd.min.js"
import  Particle  from "./Class/Particle.min.js";

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


document.addEventListener("DOMContentLoaded",e=>{


            

        loginBackground();
        showPswrd();

}
);
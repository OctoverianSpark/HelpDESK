export default class Particle{


   constructor(canvas,x,y,speed){

       this.canvas = canvas
       this.ctx = this.canvas.getContext("2d")
       this.x = x
       this.y = y
       this.radio = 5
       this.color ="#0E1D62"
       this.dirX =( Math.random() * 2) -1 
       this.dirY =( Math.random() * 2) -1 
       this.velocidad = speed??9
   }

   draw(){

       this.ctx.beginPath()
       this.ctx.arc(this.x,this.y,this.radio,0,Math.PI*2)
       

       this.ctx.fill();
       this.ctx.fillStyle = this.color

       this.ctx.closePath()


   }

   move(){

       this.x  += this.dirX * this.velocidad;
       this.y += this.dirY  * this.velocidad;

       if (this.x + this.radio > this.canvas.width|| this.x<0) {
           this.dirX *= -1
       }
       if (this.y + this.radio > this.canvas.height|| this.y<0) {
           this.dirY *= -1
       }

   }
}
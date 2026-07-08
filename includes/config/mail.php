<?php 

use PHPMailer\PHPMailer\PHPMailer;
function conectarCorreo(){

    
    $user ="helperbot@asistentevirtualsas.com";
    $password =  "cumf tlnk hbcy ropn";

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $user;
    $mail->Password = $password;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;


    $mail->setFrom($user,"Equipo de GoXpert");

    return $mail;

}


function asignado($tecnico,$tickets){
    
    $mail = conectarCorreo();
    $mail->addAddress($tecnico->correo,$tecnico->nombre . " " . $tecnico->apellido);
    
    $mail->isHTML(true);
    $mail->Subject = "Tienes un ticket asignado!!!";
    $mail->Body.= "<body style='background-color:#73b0f2'>";
    $mail->Body = "<h1>Te han asignado un ticket</h1>";
    $mail->Body .= "<h2>ID del ticket: $tickets->id</h2>";
    $mail->Body .= "<h2>Generado Por: $tickets->usuario</h2>";
    $mail->Body .= "<a href='http://". $_SERVER["HTTP_ORIGIN"] ."/ticket?id=$tickets->id' style='background-color:#4600ff;border:none;border-radius:2rem;color:#fff;display:inline-block;font-weight:600;margin-top:2.5rem;padding:1rem 3rem;text-align:center;text-decoration:none'>Ir al ticket</a>";
    $mail->Body .= "<br>";
    $mail->Body .= "</body>";

    $mail->send();


}

function notificacion($tickets=null,$tecnico=null,$usuario=null,$comentarios=null){
    $mail = conectarCorreo();


    if($tickets["id"] === null){


        $mail->setFrom("helperbot@asistentevirtualsas.com","HELPER BOT");
        $mail->addAddress("ati@asistentevirtualsas.com");


        $mail->isHTML();

        $mail->Subject = "Ticket por " . $_POST["categoria"] . " Generado";

        $mail->Body = "<h1>Ticket Generado por " . $_POST["usuario"] ."</h1>";
        $mail->Body .= "<h2> " . "Solicitud: " . $_POST["subcategoria"] . "</h2>";
        $mail->Body .= "<h2> " . "Descripcion: " . $_POST["descripcion"] . "</h2>";

        $mail->Body .= "<a href='http://". $_SERVER["HTTP_HOST"] ."/admin/tickets' style='background-color:#4600ff;border:none;border-radius:2rem;color:#fff;display:inline-block;font-weight:600;margin-top:2.5rem;padding:1rem 3rem;text-align:center;text-decoration:none'>Ir a los tickets</a>";

        $mail->send();



    }else{



        if($tickets["estado"] == "en proceso"){
                    
                $mail->setFrom("helperbot@asistentevirtualsas.com","HELPER BOT");
                $mail->addAddress($usuario->correo);


                $mail->isHTML();

                $mail->Subject = "Tu Ticket esta en Proceso ";

                $mail->Body = "<h2 style='color:#4600ff'>El tecnico asignado a tu ticket es ". $tecnico->nombre." ".$tecnico->apellido  ."</h2>";

                $mail->Body .= "<a href='http://". $_SERVER["HTTP_HOST"] ."/ticket?id=" .$_POST["id"]."' style='background-color:#4600ff;border:none;border-radius:2rem;color:#fff;display:inline-block;font-weight:600;margin:.5rem 0;padding:1rem 3rem;text-align:center;text-decoration:none;'>Ir al ticket</a>";

                $mail->send();
        }else if($tickets["estado"] == "completado"){
                    
            $mail->setFrom("helperbot@asistentevirtualsas.com","HELPER BOT");
            $mail->addAddress($usuario->correo);


            $mail->isHTML();

            $mail->Subject = "Tu Ticket ha sido completado!!!";

            $mail->Body = "<h2 style='color:#4600ff'>El tecnico ". $tecnico->nombre." ".$tecnico->apellido  ." ha  completado tu ticket y ha colocado los comentarios informativos al respecto </h2>";

            $mail->Body .= "<p style='color:#4600ff'>Puedes verificar la informacion sobre el ticket presionando el boton bajo este mensaje</p>";



            $mail->Body .= "<a href='http://". $_SERVER["HTTP_HOST"] ."/ticket?id=" .$_POST["tickets"]["id"]."' style='background-color:#4600ff;border:none;border-radius:2rem;color:#fff;display:inline-block;font-weight:600;margin:.5rem 0;padding:1rem 3rem;text-align:center;text-decoration:none;'>Ir al ticket</a>";

            $mail->send();
    }



    }





}

function enviarCorreo($body,$subject,$mailTo = []){
    /**
     * Sends an email with PHPMailer
     *
     * This function sends an email using the PHPMailer library.
     *
     * @param string $body The body of the email (Can be HTML Code)
     * @param string $subject The subject of the email
     * @param array $mailTo The recipients of the email
     */

    $mail = conectarCorreo();




    foreach($mailTo as $to){

        $mail->addAddress($to);


    }

    $mail->isHTML( true );
    $mail->Subject = $subject;
    $mail->Body = $body;
    
    $mail->send();

    return $mail->ErrorInfo;
}







?>
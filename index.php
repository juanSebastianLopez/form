<?php

require("mail.php");

function validate($name, $email, $cedula, $cel, $date, $subject, $message, $form)
{
    return !empty($name) && !empty($email) && !empty($cedula) && !empty($cel) && !empty($date) && !empty($subject) && !empty($message);
}

$status = "";

$name = htmlentities($_POST["name"]);
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$cedula = filter_var($_POST["cedula"], FILTER_SANITIZE_NUMBER_INT);
$cel = filter_var($_POST["cel"],FILTER_SANITIZE_NUMBER_INT);
$date = $_POST["date"];
$subject = htmlentities($_POST["subject"]);
$message = htmlentities($_POST["message"]);
$celLength = strlen($cel);


if (isset($_POST["form"])) {
    
    if (validate($name, $email, $cedula, $cel, $date, $subject, $message, $form)) {
        
        $body = "$name <$email> te envia el siguiente mensaje: <br><br>
        $message";
        
        // Mandar el correo
        sendMail($subject, $body, $email, $name, true);
        
        $status = "success";
    } else {
        $status = "danger";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section>
        <div class="container">

            <div class="alert">
                <?php if ($status === "success") : ?>
                    <div class="alert-sucess">
                        <span>¡Mensaje enviado con éxito!</span>
                    </div>
                <?php endif; ?>
                <?php if ($status === "danger") : ?>
                    <div class="alert-danger">
                        <span>!Oh¡ No has llenado el formulario</span>
                    </div>
                <?php endif; ?>
            </div>

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="formulario" method="post">
                <h1 class="titulo">¡Solicitar contización!</h1>
                <div class="name input">
                    <label for="name" class="name_title">Nombre:<input type="text" name="name" id="name"></label>
                </div>
                <div class="email input">
                    <label for="email" class="name_title">Correo Electronico:<input type="email" name="email" id="email"></label>
                </div>
                <div class="cedula input">
                    <label for="cedula" class="name_title">Cédula:<input type="number" maxlength="10" name="cedula" id="cedula"></label>
                </div>
                <div class="cel input">
                    <label for="cel" class="name_title">Numero Celular:<input type="number" maxlength="10" name="cel" id="cel"></label>
                </div>
                <div class="month input">
                    <label for="month" class="name_title">Fecha de nacimiento:<input type="date" name="date" id="month"></label>
                </div>
                <div class="subject input">
                    <label for="subject" class="name_title">Asunto:<input type="text" name="subject" id="subject"></label>
                </div>
                <div class="mesage input">
                    <label for="message" class="name_title">Mensaje:<textarea name="message" id="message"></textarea></label>
                </div>
                <div class="autorizacion ">
                    <span><input type="checkbox" value="ok" id="roundeOne" name="autorizo">
                    Autorizo a la compañia XXXXX para el uso y <a href="#">tratamiendo de mis datos personales.</a>
                    </span>
                </div>

                <div class="btn">
                    <button class="btn_submit" type="submit" name="form">¡Solicitar Cotización¡</button>
                </div>
            </form>
        </div>
    </section>

</body>

</html>
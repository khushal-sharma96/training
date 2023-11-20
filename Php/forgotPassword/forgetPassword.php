<?php
session_start();

include 'connect.php';

$_SESSION['msg'] = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './Mailer/Exception.php';
require './Mailer/PHPMailer.php';
require './Mailer/SMTP.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $sql = "select * from data where email='$email'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_array($result);
        $fname = $result['fname'];
        $token = $result['token'];
        $_SESSION['msg'] = "Visit your Gmail to reset Password.";
        //mailing
        //Import PHPMailer classes into the global namespace
        //These must be at the top of your script, not inside a function


        //Load Composer's autoloader
        require 'phpMailer/Exception.php';
        require 'phpMailer/PHPMailer.php';
        require 'phpMailer/SMTP.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings

            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'khushal.brahman321@gmail.com';                     //SMTP username
            $mail->Password   = 'zajgqiblptiahosv';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('khushal.sharma12121@gmail.com', 'Reset Password');
            $mail->addAddress("$email", "$fname");     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Random e-mail';
            $mail->Body    = "Hey $fname<br>You forgot password. Don't Worry,<br>To reset your password <a href='https://bookmart-ks.000webhostapp.com/loginKS/resetPass.php?token=$token'>Click Here</a>";

            // <a href='https://bookmart-ks.000webhostapp.com/loginKS/resetPass.php?token=$token'>
            $mail->send();
        } catch (Exception $e) {
?><script>
                alert('Server Error !!');
            </script>
<?php
        }
    } else {
        $_SESSION['msg'] = "Account not Found !!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="forgotStyle.css">
</head>

<body>
    <form validate method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>">
        <h2 class="heading">Recover Password</h2>
        <hr>

        <div class="inpField">
            <label for="email" class="form-label">Email ID:</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="abc@xy.in" required autocomplete="off">
        </div>
        <div class="inpField msg"> <?php if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        session_destroy();;
                                    } ?></div>



        <div class="inpField">
            <button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>
        </div>


    </form>
    </form>
</body>

</html>
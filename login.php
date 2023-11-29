<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login>>Style Design</title>
    <link rel="stylesheet" type="text/css" href="styleLoginPage.css"/>
    <link rel="icon" type="image/x-icon" href="icon.jpg">
    <style>
    span.psw {
     display: block;
     float: none;
  }
   </style>
</head>
<body>
<img src="bli.jpg" alt="background" style="width: 100%;">
<div class="container">
    <?php
    if(isset($_POST["login"])){
        $email= $_POST["email"];
        $password=$_POST["password"];
        require "database.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result= mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($user){
            if(password_verify($password,$user["password"])){
                header("Location: homePagelogIn.php");
                die();
            } else {
                $parolaIncorecta = '<div style="color:red; font-size:20px;text-align:center;">Parola incorecta.</div>';
                echo $parolaIncorecta;
            }
        } else {
            echo "E-mail-ul nu exista.";
        }
    }
    ?>
    <form action="login.php" method="post">    
    <div class="box">
        <p style="font-size: 50px;text-align: center;"><b>Log in</b></p>
        <p style="font-family: Georgia, 'Times New Roman', Times, serif; ; margin-top: -20px;text-align: center;">Bine ai revenit! Înscrie-te în 
            contul tău și fă cumpărături mai ușor!
        </p>
    <div class="form-group">
        <input type="email" placeholder= "E-mail" name="email" class="form-control">
    </div>
    <div class="form-group">
        <input type="password" placeholder= "Parolă" name="password" class="form-control">
    </div>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Reține contul
    </label>
    <div class="form-btn">
     <input style="width: 100%; background-color: #04AA6D; color: white; margin-top:10px" type="submit" value="Înregistrează-te!" name="login" class="btn btn-primary">
    </div>
    <span class="psw">Ai uitat<a href="#"> parola?</a></span>
    </div>
    </form>
</div>
</body>
</html>
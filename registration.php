<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inregistreaza-te>>Style Design</title>
    <link rel="icon" type="image/x-icon" href="icon.jpg">
    <link rel="stylesheet" type="text/css" href="styleContNou.css"/>
</head>
<body>
<img src="icon.jpg" alt="Icon Image">
    <h1 style="margin-left: 80px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Client nou?</h1>
    <p style="font-size: 30px; margin-left: 50px; margin-top: 5px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Creează-ți un cont pe pagina Style Design <br>și devin-o membru!</p>
    <img style="margin-left: 20px; width:500px; margin-top: -40px;" src="welcome.jpg" alt="welcome image">
    <p style="font-size: 20px;margin-left: 250px;margin-top: -10px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Ai deja cont? <a href="log_inPage.html">Înregistrează-te!</a></p>
    <div class="container">
        <?php
        if(isset($_POST["submit"])){
            $nume= $_POST["nume"];
            $prenume= $_POST["prenume"];
            $email= $_POST["email"];
            $telefon= $_POST["telefon"];
            $dataNastere= $_POST["dataNastere"];
            $password= $_POST["password"];
            $passwordRepeat= $_POST["repeat_password"];

            $passwordHash=password_hash($password, PASSWORD_DEFAULT);

            $errors=array();

            if(empty($nume) OR empty($prenume) OR empty($email) OR empty($telefon) OR empty($dataNastere) OR empty($password) OR empty($passwordRepeat)){
                array_push($errors, "Toate campurile sunt obligatorii!");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors,"E-mail-ul utilizat nu este valid!");
            }
            if(strlen($password)<8){
                array_push($errors,"Parola trebuie sa aiba cel putin 8 caractere.");
            }
            if(strlen($telefon)<10 || strlen($telefon)>10){
                array_push($errors,"Numarul de telefon nu este valid.");
            }
            if($password!==$passwordRepeat){
                array_push($errors,"Parolele nu se potrivesc.");
            }

            require_once "database.php";
            $sql= "SELECT * from users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowsCount= mysqli_num_rows($result);
            if($rowsCount>0){
                array_push($errors,"Un cont a fost deja creat cu acest e-mail.");
            }
            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else{
                $sql= "INSERT INTO users(nume, prenume,email,telefon,dataNastere,password) VALUES(?, ?,?, ?, ?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"sssids", $nume, $prenume, $email, $telefon, $dataNastere, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert success'>V-ati inregistrat cu succes!</div>";
                } else{
                    die("Ceva nu a mers bine!");
                }

            }
        }
        ?>
    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" name="nume" placeholder="Nume">
        </div>
        <div class="form-group">
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="text" name="prenume" placeholder="Prenume">
        </div>
        <div class="form-group">
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="email" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="number" name="telefon" placeholder="Numar de telefon">
        </div>   
        <div class="form-group">
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="date" name="dataNastere" placeholder="Data nasterii">
        </div> 
        <div class="form-group">
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="password" name="password" placeholder="Parola">
        </div>
        <div class="form-group">
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="password" name="repeat_password" placeholder="Repeta parola">
        </div>
        <label>
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="checkbox" checked="checked" name="newsletter"> Aș dori să primesc noutăți, sfaturi și oferte de marketing de la Style Design
          </label>
          <br>
          <label>
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="checkbox" checked="checked" name="termeniSiCond"> Am citit și accept <a href="">Termeni și condiții.</a>
          </label>
        <div class="form-group">
            <input style="font-family: Georgia, 'Times New Roman', Times, serif;" type="submit" class="log" value="Inregistreaza-te!" name="submit">
        </div>
    </form>
    </div>
</body>
</html>
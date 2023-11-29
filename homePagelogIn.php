<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <ul class="bar1">
        <a href=""><li>Despre noi</li></a>
        <li>Buna, <?php
         require_once "database.php";
         $sql= "SELECT * from users WHERE prenume = 'prenume'";
         echo $sql;
          ?> </li>
        <a href="contact.html"><li>Contact</li></a>
    </ul>
</div>
</body>
</html>
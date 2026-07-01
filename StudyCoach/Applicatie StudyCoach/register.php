<?php
include "config.php";

if(isset($_POST['register'])){

    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO gebruiker (naam,email,wachtwoord)
            VALUES ('$naam','$email','$wachtwoord')";

    if($conn->query($sql)){
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>StudyCoach - Registreren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="auth-box">

    <h1>📚 StudyCoach</h1>
    <p class="subtitle">Maak jouw account aan</p>

    <form method="POST">

        <input
            type="text"
            name="naam"
            placeholder="👤 Naam"
            required
        >

        <input
            type="email"
            name="email"
            placeholder=" E-mailadres"
            required
        >

        <input
            type="password"
            name="wachtwoord"
            placeholder=" Wachtwoord"
            required
        >

        <button type="submit" name="register">
            Account maken
        </button>

    </form>

    <p class="switch">
        Heb je al een account?
        <a href="login.php">Inloggen</a>
    </p>

    <style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(135deg,#141e30,#243b55);
    color:white;
}

header{
    text-align:center;
    padding:30px;
}

.container{
    width:80%;
    margin:auto;
}

.kaart{
    background:rgba(255,255,255,0.1);
    padding:25px;
    margin-bottom:20px;
    border-radius:20px;
    backdrop-filter:blur(10px);
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:none;
    border-radius:10px;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:10px;
    background:linear-gradient(90deg,#ff512f,#dd2476);
    color:white;
}

.melding{
    background:linear-gradient(90deg,#ff9966,#ff5e62);
    padding:20px;
    border-radius:15px;
    margin-top:20px;
}
</style>


</div>

</body>
</html>
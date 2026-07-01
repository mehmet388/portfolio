<?php
session_start();
include "config.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    $sql = "SELECT * FROM gebruiker WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($wachtwoord, $user['wachtwoord'])){

            $_SESSION['naam'] = $user['naam'];

            header("Location: dashboard.php");
            exit();
        }
        else{
            $fout = "Verkeerd wachtwoord.";
        }
    }
    else{
        $fout = "Account niet gevonden.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>StudyCoach - Inloggen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="auth-box">

    <h1>📚 StudyCoach</h1>
    <p class="subtitle">Welkom terug!</p>

    <?php
    if(isset($fout)){
        echo "<div class='error'>$fout</div>";
    }
    ?>

    <form method="POST">

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

        <button type="submit" name="login">
            Inloggen
        </button>

    </form>

    <p class="switch">
        Nog geen account?
        <a href="register.php">Registreren</a>
    </p>

    <style>
body{
    margin:0;
    font-family:Arial,sans-serif;
    background: linear-gradient(135deg,#6a11cb,#fc466b);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-box{
    width:400px;
    padding:40px;
    background:white;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    text-align:center;
}

.login-box h1{
    color:#fc466b;
    font-size:40px;
}

input{
    width:100%;
    padding:15px;
    margin:10px 0;
    border:2px solid #fc466b;
    border-radius:12px;
    box-sizing:border-box;
}

button{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background:linear-gradient(90deg,#fc466b,#6a11cb);
    color:white;
    font-size:18px;
    cursor:pointer;
}

button:hover{
    opacity:0.9;
}

a{
    color:#6a11cb;
    text-decoration:none;
}
</style>


</div>

</body>
</html>
<?php
session_start();

if(!isset($_SESSION['naam'])){
    header("Location: login.php");
    exit();
}

$motivaties = [
    " Goed bezig, blijf zo doorgaan!",
    " Elke dag een beetje leren helpt enorm!",
    " Jij gaat deze toets halen!",
    " Nog even knallen en je bent klaar!",
    " Succes met leren vandaag!"
];

$randomMelding = $motivaties[array_rand($motivaties)];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>StudyCoach Dashboard</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;
    background:linear-gradient(135deg,#2d033b,#810ca8,#c147e9);
    color:white;
    min-height:100vh;
}

header{
    text-align:center;
    padding:40px;
}

header h1{
    font-size:55px;
    color:#ffd369;
}

header p{
    font-size:22px;
}

.container{
    width:90%;
    max-width:1000px;
    margin:auto;
}

.kaart{
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(10px);

    padding:30px;
    border-radius:25px;

    margin-bottom:25px;

    box-shadow:0 8px 25px rgba(0,0,0,0.3);
}

.kaart h2{
    color:#ffd369;
    margin-bottom:15px;
}

.stats{
    display:flex;
    gap:20px;
    margin-bottom:25px;
}

.stat-box{
    flex:1;
    padding:25px;
    text-align:center;

    background:rgba(255,255,255,0.15);

    border-radius:20px;
}

.stat-box h2{
    font-size:35px;
    color:#ffd369;
}

input{
    width:100%;
    padding:15px;
    margin-bottom:20px;

    border:none;
    border-radius:15px;

    font-size:16px;
}

button{
    width:100%;
    padding:15px;

    border:none;
    border-radius:15px;

    background:linear-gradient(90deg,#ff4d6d,#ff9e00);

    color:white;
    font-size:18px;
    cursor:pointer;
}

button:hover{
    opacity:0.9;
}

.melding{
    background:linear-gradient(90deg,#ff758c,#ff7eb3);
}

.tutorial-knop{
    display:inline-block;
    margin-top:20px;
    padding:15px 25px;

    background:red;
    color:white;

    text-decoration:none;
    border-radius:15px;
}

.logout{
    display:inline-block;
    margin-bottom:30px;

    padding:15px 25px;

    background:#222;
    color:white;

    text-decoration:none;
    border-radius:15px;
}

#timer{
    font-size:50px;
    text-align:center;
    margin:20px 0;
}

</style>

</head>
<body>

<header>
    <h1>📚 StudyCoach</h1>
    <p>Welkom terug, <?php echo $_SESSION['naam']; ?> tijd om aan de slag te gaan</p>
</header>

<div class="container">

<div class="kaart">
    <h2> Motivatie van vandaag</h2>
    <p><?php echo $randomMelding; ?></p>
</div>

<div class="stats">

    <div class="stat-box">
        <h2> </h2>
        <p>Dagen streak</p>
    </div>

    <div class="stat-box">
        <h2> </h2>
        <p>Toets deze week</p>
    </div>

    <div class="stat-box">
        <h2>30 min</h2>
        <p>Vandaag leren</p>
    </div>

</div>

<div class="kaart">

    <h2> Voeg een toets toe</h2>

    <form method="POST">

        <input
            type="text"
            name="vak"
            placeholder="Bijvoorbeeld: Wiskunde"
            required
        >

        <input
            type="date"
            name="datum"
            required
        >

        <button type="submit" name="opslaan">
            Toets toevoegen
        </button>

    </form>

</div>

<?php

if(isset($_POST['opslaan'])){

    $vak = $_POST['vak'];
    $datum = $_POST['datum'];

    $morgen = date('Y-m-d', strtotime('+1 day'));

    if($datum == $morgen){

        echo "
        <div class='kaart melding'>
            <h2> Morgen toets!</h2>

            <p>
                Morgen heb je je <strong>$vak</strong> toets.
            </p>

            <p>
                Neem vandaag nog even alles door!
            </p>
        </div>
        ";
    }

    echo "

    <div class='kaart melding'>

        <h2> Jouw volgende toets</h2>

        <p>
            Je hebt een <strong>$vak</strong> toets op
            <strong>$datum</strong>.
        </p>

        <br>

        <p>
            Vergeet niet vandaag minimaal
            <strong>30 minuten</strong> te leren.
        </p>

        <br>

        <a class='tutorial-knop'
        href='https://www.youtube.com/results?search_query=$vak uitleg'
        target='_blank'>

        ▶ Bekijk tutorial voor $vak

        </a>

    </div>

    ";
}

?>

<div class="kaart">

    <h2> Studie Timer</h2>

    <div id="timer">30:00</div>

    <button onclick="startTimer()">
        Start 30 minuten leren
    </button>

</div>

<a class="logout" href="logout.php">
    Uitloggen
</a>

</div>

<script>

let tijd = 1800;

function startTimer(){

    let interval = setInterval(function(){

        let minuten = Math.floor(tijd / 60);
        let seconden = tijd % 60;

        document.getElementById("timer").innerHTML =
            minuten + ":" + (seconden < 10 ? "0" : "") + seconden;

        tijd--;

        if(tijd < 0){
            clearInterval(interval);

            alert(" Goed gedaan! Je hebt 30 minuten geleerd!");
        }

    },1000);

}

</script>

</body>
</html>
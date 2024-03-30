<?php
// Start the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["username"]) || empty($_SESSION["username"])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            
            background-image: url('backgroundImg.jpg');
background-size: cover; 
background-attachment: fixed;
background-position: center; 
background-repeat: no-repeat; 
margin: 0;
padding: 0;
        }
        .header {
            background-color: #1e1f31;
            color: #fff;
            padding: 0px 0;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color:
#0e0c11;
            border: 2px solid #ccc;
            border-radius: 10px;
            text-align: center;
        }
        .game1,.game2,.game3 {
            display: inline-block;
            width: 200px;
            height: 150px;
            margin: 20px;
            padding: 10px;
            background:transparent;
            
            border-radius: 5px;
            cursor: pointer;
        }
        .game2{
            background-image: url('RockPaperScissors/rpsImg.png');
            background-size: cover;
        background-position: center;
        }
        .game1{
            background-image: url('TicTacToe/tttImg.webp');
            background-size: cover;
        background-position: center;
        }
        .game3{
            background-image: url('flappyBird/flappyImg.jpg');
            background-size: cover;
        background-position: center;
        }
        .game1:hover, .game2:hover, .game3:hover {
    transform: scale(1.1);
    transition: all 0.3s ease;
}
        h1 {
            color: white;
        }
        .header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 10vh;
}
nav ul li{
    display: inline-block;
    margin: 0 20px;
}
nav ul li a{
    text-decoration: none;
    font-size: 20px;
    padding: 5px 0;
    border: 2px solid transparent;
    filter: drop-shadow(2px 2px 4px transparent);
    color: white;
}
nav ul li a:hover{
    border-bottom: 2px solid white;
    filter: drop-shadow(2px 2px 4px white);
    transition: 0.5s;
}
    </style>
</head>
<body>
    <div class="header">
        <nav>
            <ul>
       <li> <a href="profile.php">My Profile</a> | </li>
       <li> <a href="logout.php">Logout</a> </li>
        </ul>
        </nav>
    </div>
    <div class="container">
        <h1>Choose a Game</h1>
        <div class="game1" onclick="location.href='TicTacToe/index.html';">
           
        </div>
        <div class="game2" onclick="location.href='RockPaperScissors/rpsgame.html';">
            
        </div>
        <div class="game3" onclick="location.href='flappyBird/index.html';">
           
        </div>
    </div>
</body>
</html>

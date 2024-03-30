<?php

session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["username"]) || empty($_SESSION["username"])){
    header("Location: login.php");
    exit;
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'userinfo');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM registration WHERE userName = ?");
$stmt->bind_param("s", $_SESSION["username"]);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the user data
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profileStyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            background: url('backgroundImg.jpg');
        background-size: cover;
        background-position: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #0e0c11;
            border: 2px solid #ccc;
            border-radius: 10px;
            text-align: center;
        }

        .profile {
            margin-bottom: 30px;
        }

        .profile h2 {
            margin-bottom: 20px;
        }

        .profile-pictures {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .profile-pictures img {
            width: 100px;
            height: 100px; 
            border-radius: 50%; 
            cursor: pointer; 
            transition: transform 0.3s ease; 
            
        }

        .profile-pictures img:hover {
            transform: scale(1.1); 
        }

        .user-info {
            text-align: left;
            margin-bottom: 30px;
        }

        .user-info h2 {
            margin-bottom: 10px;
        }

        

        .scores h2 {
            margin-bottom: 10px;
        }

        .scores ul {
            list-style-type: none;
            padding: 0;
        }

        .scores ul li {
            margin-bottom: 5px;
        }
        h2{
            color: white;
        }
        p{
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile">
            <h2>Select Profile Picture</h2>
            <div class="profile-pictures">
                <img src="img/1.jpg" alt="Profile 1" onclick="selectProfile('profile1.gif')">
                <img src="img/2.jfif" alt="Profile 2" onclick="selectProfile('profile2.gif')">
                <img src="img/3.jfif" alt="Profile 3" onclick="selectProfile('profile3.gif')">
                
            </div>
        </div>
        <div class="user-info">
            <h2>User Information</h2><br>
            <p><strong>Username: <?php echo $user['userName']; ?></strong> </p><br>
            <p><strong>Email: <?php echo $user['email']; ?> </strong> </p>
          
        </div>
        
    </div>

    <script>
        function selectProfile(profileImage) {
           
            alert("Profile picture selected: " + profileImage);
           
        }
    </script>
</body>
</html>

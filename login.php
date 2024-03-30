<!DOCTYPE html>
<html lang="en">
<head>
    <title>login</title>
    <link rel="stylesheet" href="loginStyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <section>
    <div class="container">
    <div class="wrapper">
        <form action="login.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name = "username" placeholder=""required>
                
                <i class='bx bxs-user'></i>
                <label>username</label>
                <span id="userError" class="userError"></span>
                
            </div>
            <div class="input-box">
                <input type="password" name = "pass" placeholder="" required>
                <i class='bx bxs-lock-alt' ></i>
                <label>password</label>
                <span style="color: red;" id="passError" class="passError"></span>
                
            </div>
            <div class="remember-fogot">
                <label><a href="forgotPass.php">Forgot password?</a></label> 
              
            </div>
            <button type="submit"class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </div>
        </form> 
    </div>
    

    
</div>
<div class="navbar">
            <nav>
                <ul>
                    <li><a href="index.php">home</a></li>
                    <li><a href="signup.php">sign up</a></li>
                    <li><a href="about.html">about</a></li>
                </ul>
            </nav>
        </div>
</section>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["pass"]) ? $_POST["pass"] : "";
   
    $conn = new mysqli('localhost', 'root', '', 'userinfo');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM registration WHERE userName = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, fetch user data
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Password is correct, start a session
            session_start();
            $_SESSION['username'] = $userName;
            header("Location: games.php");
            exit(); // Ensure that script stops execution after redirection
        } else {
            // Password is incorrect
            $passwordIncorrect = "Wrong password.";
        }
    } else {
        // No user found with the given username
        $userIncorrect = "No user found with the given username.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>



<?php if (isset($passwordIncorrect)): ?>
    <script>
        document.getElementById("passError").textContent = "<?php echo $passwordIncorrect; ?>";
    </script>
<?php endif; ?>
<?php if (isset($userIncorrect)): ?>
    <script>
       document.getElementById("userError").textContent = "<?php echo $userIncorrect;?>";
    </script>
<?php endif; ?>
  




</body>
</html>
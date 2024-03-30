<!DOCTYPE html>
<html lang="en">
<head>
    <title>sign up</title>
    <link rel="stylesheet" href="signupStyle.css">
</head>
<body> 
        <section>
            <div class="wrapper">
                <form action="signup.php" method="post">
                    <h1>Sign up</h1>
                    
                    <div class="input-box">
                        <input type="text" name = "username" placeholder="Username"required>
                    </div>
                    <div class="input-box">
                        <input type="email" name = "email" placeholder="Email"required> 
                    </div>
                     <div class="input-box">
                        <input type="password" name = "pass" placeholder="password"required>
                    </div>
                    <div class="input-box">
                        <input type="password" name = "cpass" placeholder="Confirm password" required>
                        <span id="password-error" class="error-message"></span>
                    </div>
                    <span style="color: red;" id="user-error" class="exist-message"></span>
                    <button type="submit" name="submit" class="btn">Submit</button>
                    
                    <div class="register-link">
                       <p>already have an account ? <a href="login.php">Login</a></p>
                </form> 
            </div>  
                  
        </section> 
        <div class="navbar">
        <nav>
                <ul>
                    <li><a href="index.php">home</a></li>
                    <li><a href="login.php">login</a></li>
                    <li><a href="about.html">about</a></li>
                </ul>
            </nav>
        </div>  
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    $userName = isset($_POST["username"]) ? $_POST["username"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["pass"]) ? $_POST["pass"] : "";
    $confirmPassword = isset($_POST["cpass"]) ? $_POST["cpass"] : "";
    
    $passHash = password_hash($password, PASSWORD_DEFAULT);

   

    
    if ($password != $confirmPassword) {
        $passwordError = "Passwords do not match";
    }else{

    

    $conn = new mysqli('localhost','root','','userInfo');
    if($conn ->connect_error){
        die('Connection Failed :' .$conn->connect_error);
    } else {

        $stmt = $conn->prepare("SELECT * FROM registration WHERE userName = ? OR email = ?");
        $stmt->bind_param("ss", $userName, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            // Username or email already exists
            $userExistsError = "Username or email already exists";
        } else {
        
        

        $stmt = $conn->prepare("insert into registration(userName, email, password) values(?, ?, ?)");
        $stmt->bind_param("sss", $userName, $email, $passHash);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        
        
        header("Location: login.php");
        exit(); 
    }}}
}
?>
<?php if (isset($passwordError)): ?>
    <script>
        document.getElementById("password-error").textContent = "<?php echo $passwordError; ?>";
    </script>
<?php endif; ?>
<?php if (isset($userExistsError)): ?>
    <script>
       document.getElementById("user-error").textContent = "<?php echo $userExistsError;?>";
    </script>
<?php endif; ?>

        
</body>
</html>
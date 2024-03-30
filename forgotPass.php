<!DOCTYPE html>
<html lang="en">
<head>
    <title>forgot password</title>
    <link rel="stylesheet" href="forgotPassstyle.css">
</head>
<body>
     <section>
            <div class="container">
                <form action="forgotPass.php" method="post">
                    <h1>Forgot Password?</h1>
                    <div class="input-box">
                        <input type="text"placeholder="Username" name ="username" required> 
                    </div>
                    <div class="input-box">
                        <input type="password"placeholder="New password" name ="newPassword"required>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Confirm password" required>
                    </div>
                    <button type="submit"class="btn">Submit</button>
                    <div class="register-link">
                       <p>already have an account ? <a href="login.php">Login</a></p>
                </form> 
            </div>          
        </section> 

        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $newPassword = isset($_POST["newPassword"]) ? $_POST["newPassword"] : "";

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'userInfo');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE registration SET password = ? WHERE userName = ?");
    $stmt->bind_param("ss", $hashedPassword, $username);

    // Execute the statement
    $stmt->execute();

    echo "Password updated successfully";

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>
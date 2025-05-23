<?php
    $pagetitle = "Register";
    include("database.php");
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestPHP | <?php echo $pagetitle ?></title>
</head>
<body>
    <div class="login">
        Welcome to TestPHP! <br>
        Please register your credentials. <br>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <label for="username">Username</label> <br>
            <input type="text" name="username" id="username"> <br>
            <label for="email">Email</label> <br>
            <input type="text" name="email" id="email"> <br>            
            <label for="password">Password</label> <br>
            <input type="password" name="password" id="password"> <br>
            <input type="submit" name="submit" id="submit" value="Login">
        </form>
    </div>
</body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);            
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);     
        if (!empty($username) & !empty($email) & !empty($password)) {
            $hash_pw = password_hash($password, PASSWORD_DEFAULT);   
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash_pw')";

            try {
                mysqli_query($conn, $sql);
                echo "User is now registered.";
            } catch (mysqli_sql_exception) {
                echo "Could not register user.";
            }
        }
    }

    mysqli_close($conn);
?>
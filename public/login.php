<html>
<head>
    <title>Login page</title>
    <link rel="stylesheet" href="../style/login.scss">
</head>
<body>

<div class="container">
    <div class="login-container">
        <h1>Login</h1>
        <form action="../controller/maincontroller.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Login">
            </div>

            <div class="form-group">
                <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</div>
</body>

</html>
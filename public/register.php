<html>
<head>
    <title>Register page</title>
    <link rel="stylesheet" href="../style/register.scss">
</head>
<body>

<div class="container">
    <div class="registration-container">
        <h1>Register</h1>
        <form action="../controller/maincontroller.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="register" value="Register">
            </div>
            <div class="form-group">
                <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>
</div>

</body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    
 <link rel="stylesheet" href="view/assets/login.css">
    
</head>
<body>

    <div class="login-container">
        <form action="sistem.php?op=in" method="post"> <h2>Login Page</h2>
            
            <div class="input-group">
                <span class="icon">&#128100;</span> <input type="text" name="usr" placeholder="Username" required>
            </div>
            
            <div class="input-group">
                <span class="icon icon-pass">*</span> <input type="password" name="psw" placeholder="Password" required>
            </div>
            
            <div class="remember-me">
                <input type="checkbox" id="remember">
                <label for="remember">Remember me</label>
            </div>
            
            <button type="submit" class="login-button">Log In</button>
        </form>
    </div>

</body>
</html>
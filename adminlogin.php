<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header>
        <h1>Student Management System</h1>
        <nav class="button-container"> 
            <a href="index.php">Home</a>
            <a href="login.php">Student Login</a>
            <a href="signup.php">Sign Up</a>
            <a href="adminlogin.php">Admin Login</a>
            <a href="teacherlogin.php">Teacher Login</a>
        </nav>
    </header>
    
  
      
   
    <div class="container">
        <h2>Admin Login</h2>
       
     
        
  

        <form action="adminlogindb.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>

<style>
    body {
        
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: #f4f4f4;
    }
    .login-container {
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input {
        display: block;
        width: 100%;
        padding: 10px;
        margin: 10px 0;
    }
    .error {
        color: red;
    }
</style>
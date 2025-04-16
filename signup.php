<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <header >

        
        
        <h1>Student Management System</h1>
      
        <nav class="button-container"> 
            <a href="index.php">Home</a>
            <a href="login.php">Student Login</a>
            <a href="signup.php">Sign Up</a>
            <a href="adminlogin.php">Admin Login</a>
            <a href="teacherlogin.php">Teacher Login</a>
        </nav>
        
    </header>
    <div class="register-container" style="margin-top: 200px;" >
        <form action="signupdb.php" method="post">  
            
            <h2>Register</h2>
            <label>Student ID:</label>
            <input type="text" name="studentid" required>

            <label>Course ID:</label>
            <input type="text" name="courseid" required>

            
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
  
</body>
</html>


<!-- settings.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: black;
            
            
            color : #5ce1e6
        }

        .box {
            margin-top: 200px
        }

        a {
            text-decoration: none;
            color : black;
            
        }

        .SO{
            margin-top:20px

        }

        
    </style>
</head>
<body >
<center>
        <div class="box">
        <h1>User Settings</h1>
    <form action="update_settings.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="profile_image">Profile Image:</label>
        <input type="file" id="profile_image" name="profile_image"><br><br>
        
        <input type="submit" value="Save Changes">
    </form>
    <button class="SO"><a href="adminlogin.php" >Sign Out</a></button>

      </div>
      
    </center>


</body>
</html>

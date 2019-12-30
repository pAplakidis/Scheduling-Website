<?php
include('../classes/DB.php');

if(isset($_POST['register']))
{
    $username =  $_POST['username'];
    $password = $_POST['password'];

    if(!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username)))
    {
        if(strlen($username) >= 3 && strlen($username) <= 32)
        {
            if(preg_match('/[a-zA-Z0-9_]+/', $username))
            {
                if(strlen($password) >= 6 && strlen($password) <= 60)
                {
                  DB::query('INSERT INTO users VALUES (\'\', :username, :password)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT)));

                    echo "Registered Successfully!";
                    // redirect to menu
                    header("Location: menu.html");
                }
                else
                {
                    echo "Invalid Password Length (must be 6 to 60 chars long)";
                }
            }
            else
            {
                echo "Invalid Username Characters (must be a-z, A-z, 0-9 and can contain _)";
            }
        }
        else
        {
            echo "Invalid Username Length (must be 3 to 32 characters long)"; }
    }
    else
    {
        echo "User Already Exists!";
        header("Location: menu.html");
    }
}

?>

<h1>Register</h1>
<form class="register.php" method="post">
    <input type="text" name="username" placeholder="Username"><p />
    <input type="password" name="password" placeholder="Password"><p />
    <input type="submit" name="register" value="Register">
</form>

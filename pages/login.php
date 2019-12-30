<?php
include('../classes/DB.php');

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username)))
    {
        if(password_verify($password, DB::query('SELECT password from users WHERE username=:username', array(':username'=>$username))[0]['password']))
        {
            echo 'Login Successfull!';
            // redirect to menu page
            header("Location: menu.html");
        }
        else
        {
            echo "Incorrect Password";  // for debugging
            //echo "Incorrect Credentials";
        }
    }
    else
    {
        // For security purposes, the ERROR message is not
        // accurate to not indicate whether the client has
        // found a correct username or not
        //echo "Incorrect Credentials";
        echo "Username not found";  // for debugging
    }
}

?>

<h1>Log In</h1>
<form class="login.php" method="post">
    <input type="text" name="username" placeholder="Username"><p />
    <input type="password" name="password" placeholder="Password"><p />
    <input type="submit" name="login" value="Log In">
</form>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
    </head>
    <body>
        <?php

            $username = $password ="";
            $usernameerr = $passworderr ="";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['uname'])) {                    
                    $usernameerr = "Please Fill up the Username!";
                }

                else if(empty($_POST['pass'])) {                    
                    $passworderr = "Please Fill up the password!";
                }

                else {
                    $username = $_POST['uname'];
                    $password = $_POST['pass'];

                    $log_file = fopen("Login.txt", "r");
                    
                    $data = fread($log_file, filesize("Login.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['username'] == $username && $json_decode['password'] == $password) 
                        {
                            session_start();
                            $_SESSION['user'] = $username;
                            header("Location: information.php");
                        }
                    }
                    echo "Wrong Password! Please Try Again.";
                }
            }
        ?>
        
        <h1>Login Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend><b>Login</b></legend>
            
                <label for="username">Username:</label>
                <input type="text" name="uname" id="username">
                <?php echo $usernameerr; ?>

                <br>

                <label for="parmanent_address">Password:</label>
                <input type="password" name="pass" id="password">
                <?php echo $passworderr; ?>
                
                </fieldset>

            <input type="submit" value="Login"> 
        </form>
        
    </body>
</html>
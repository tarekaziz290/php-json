<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>

    
    <?php
 
        session_start();
        $var = $_SESSION['user'];
        unset($_SESSION['user']); 



        $log_file = fopen("Registration.txt", "r");
        
        $data = fread($log_file, filesize("Registration.txt"));

        $data_filter = explode("\n", $data);
        
        for($i = 0; $i< count($data_filter)-1; $i++) {
            
            $json_decode = json_decode($data_filter[$i], true);
            

            if($json_decode['username'] == $var) 
            {
                $firstnameerr = $json_decode['firstname'];
                $lastnameerr = $json_decode['lastname'];
                $gendererr = $json_decode['gender'];
                $emailerr = $json_decode['email'];
            }

        }
        fclose($log_file);

?>

        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                    header('Location: registration.php');
                }
        ?>
        

            <fieldset>
                <legend><b>Basic Information:</b></legend>
            
                <label for="firstname">First Name:</label>
                <?php echo $firstnameerr; ?>

                <br>

                <label for="lastname"> LastName:</label>
                <?php echo $lastnameerr; ?>

                <br>

                <label for="gender">Gender:  </label>
                <?php echo $gendererr; ?>

                <br>

                <label for="email">Email:</label>
                <?php echo $emailerr; ?>

               

            </fieldset>

        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <input type="submit" value="Logout">
        </form>
        
    </body>
</html>



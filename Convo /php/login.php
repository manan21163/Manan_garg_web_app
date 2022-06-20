<?php 
    session_start();
    include_once "config.php";
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    // we got valid mail pass strings to use in sql querry 
    if(!empty($mail) && !empty($pass)){
        // sql quey to fetch from the databas for a particular e-mail 
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE mail = '{$mail}'");
    
        if(mysqli_num_rows($sql) > 0){
            // recieving an associative array for the rows in the database 
            $row = mysqli_fetch_assoc($sql);
            // md5 hash for pass
            $user_pass = md5($pass);
            // encoded pass from the row
            $enc_pass = $row['pass'];
            if($user_pass === $enc_pass){
                // if user pass matches encoded pass
                // then login accepted
                $status = "Active now";
                // updating the status of user as active usin this sql query
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE uniqueID = {$row['uniqueID']}");
                if($sql2){
                    // session ID getting from the row table
                    $_SESSION['uniqueID'] = $row['uniqueID'];
                    echo "success";
                }else{
                    // echoing something wrong if mishap happens
                    echo "Something went wrong. Please try again!";
                }
            }else{
                // if user enter wrong pass, then can't login and says incorrect pass
                echo "mail or pass is Incorrect!";
            }
        }else{
            // mail is checked from the database
            // if unknown then says doesn't exist
            echo "$mail - This mail not Exist!";
        }
    }else{
        // for missing field, we output all fields are required
        echo "All input fields are required!";
    }
?>
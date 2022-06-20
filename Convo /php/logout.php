<?php
    session_start();
    if(isset($_SESSION['uniqueID'])){
        include_once "config.php";
        // gets logout id as valid sql statement string
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            // when user is logged out the status is set to offline using this sql query
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE uniqueID={$_GET['logout_id']}");
            if($sql){
                //session is unset and destroyed
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>
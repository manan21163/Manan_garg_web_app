<?php 
    session_start();
    if(isset($_SESSION['uniqueID'])){

        include_once "config.php";
        $outgoing_id = $_SESSION['uniqueID'];
        // making a valid string of incoming id for  sql statement 
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        // making a valid string of the msg  for  sql statement
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            // If msg not empty then the msg is stored in the table as per this sql query 
            $sql = mysqli_query($conn, "INSERT INTO messages (inmsgID, outmsgID, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.php");
    }
?>
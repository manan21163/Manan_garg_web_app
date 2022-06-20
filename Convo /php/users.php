<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['uniqueID'];
    // selects users where unique id not outgoing id
    $sql = "SELECT * FROM users WHERE NOT uniqueID = {$outgoing_id} ORDER BY userID DESC";
    // running against the database
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        // when 0 users there to chat
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>
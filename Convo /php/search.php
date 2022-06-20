<?php
    session_start();
    include_once "config.php";
    
    $outgoing_id = $_SESSION['uniqueID'];
    // search input turned to valid string to search in database
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    // the search term is passed here to search for it in database using this sql query
    $sql = "SELECT * FROM users WHERE NOT uniqueID = {$outgoing_id} AND (firstName LIKE '%{$searchTerm}%' OR lastName LIKE '%{$searchTerm}%') ";
    $output = "";
    // running the query against the database
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        // if invalid search term then this output is shown 
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>
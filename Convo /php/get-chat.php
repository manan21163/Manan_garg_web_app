<?php 
    session_start();
    if(isset($_SESSION['uniqueID'])){
        include_once "config.php";
        // gets the session as per unique id
        $outgoing_id = $_SESSION['uniqueID'];
        // this create a valid sql string to use in the string 
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        // another sql query 
        // query to get all the chats 
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.uniqueID = messages.outmsgID
                WHERE (outmsgID = {$outgoing_id} AND inmsgID = {$incoming_id})
                OR (outmsgID = {$incoming_id} AND inmsgID = {$outgoing_id}) ORDER BY msgID";
         // fetches from the data base
        $query = mysqli_query($conn, $sql);
        // if chats exist 
        // then looping on associative array 
        // now displaying outgoing msg on right side and incoming on the left side 
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outmsgID'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <pic src="php/images/'.$row['pic'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            //  Output when no msg is are available 
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>
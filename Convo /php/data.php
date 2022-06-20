<?php
    while($row = mysqli_fetch_assoc($query)){
        // the sql querres to search for the incoming and outgoing msg using primary key unique id 
        $sql2 = "SELECT * FROM messages WHERE (inmsgID = {$row['uniqueID']}
                OR outmsgID = {$row['uniqueID']}) AND (outmsgID = {$outgoing_id} 
                OR inmsgID = {$outgoing_id}) ORDER BY msgID DESC LIMIT 1";
    //    this performs a query agains the database  
       $query2 = mysqli_query($conn, $sql2);
    //    this func return associate array fetch from the database
        $row2 = mysqli_fetch_assoc($query2);
//  says no msg available when their is no msg in database for that perticular unique id 
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        // show this is used to show msg send from us with the name "you".
        if(isset($row2['outmsgID'])){
            ($outgoing_id == $row2['outmsgID']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        // set status offline now when user is offline 
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['uniqueID']) ? $hid_me = "hide" : $hid_me = "";
        //output of the msg seen on front end  
        $output .= '<a href="chat.php?userID='. $row['uniqueID'] .'">
                    <div class="content">
                    <pic src="php/images/'. $row['pic'] .'" alt="">
                    <div class="details">
                        <span>'. $row['firstName']. " " . $row['lastName'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
    }
?>
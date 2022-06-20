<?php
    session_start();
    include_once "config.php";
    // user details stored in valid string to pass for sql query
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    if(!empty($firstName) && !empty($lastName) && !empty($mail) && !empty($pass)){
        if(filter_var($mail, FILTER_VALIDATE_mail)){
            // qurey to select user as per email
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE mail = '{$mail}'");
            // if email already exist then this output is shown
            if(mysqli_num_rows($sql) > 0){
                echo "$mail - This mail already exist!";
            }else{
                if(isset($_FILES['image'])){
                    // user image is gettin uploaded here
                    $pic_name = $_FILES['image']['name'];
                    $pic_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $pic_explode = explode('.',$pic_name);
                    // adding pic extension in end
                    $pic_ext = end($pic_explode);
                    // the available image extensions
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($pic_ext, $extensions) === true){
                        //  consider 3 types of image extensions 
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($pic_type, $types) === true){
                            $time = time();
                            // this contain the timestamp 
                            $new_pic_name = $time.$pic_name;
                            // timestamped name of the file 
                            if(move_uploaded_file($tmp_name,"images/".$new_pic_name)){
                                // uploading file to the database 
                                $ran_id = rand(time(), 100000000);
                                $status = "Active now";
                                $encrypt_pass = md5($pass);
                                // encreption of user "*"
                                $insert_query = mysqli_query($conn, "INSERT INTO users (uniqueID, firstName, lastName, mail, pass, pic, status)
                                VALUES ({$ran_id}, '{$firstName}','{$lastName}', '{$mail}', '{$encrypt_pass}', '{$new_pic_name}', '{$status}')");
                                if($insert_query){
                        
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE mail = '{$mail}'");
                                    // getting info of the newely registered user 
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['uniqueID'] = $result['uniqueID'];
                                        echo "success";
                                        // if successful then create a session 
                                    }else{
                                        echo "This mail address not Exist!";
            
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }
            }
        }else{
            echo "$mail is not a valid mail!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
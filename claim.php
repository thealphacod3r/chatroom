<?php

$room = $_POST['room'];

if(strlen($room)>20 or strlen($room)<2){
    $message = "Please choose a name between 2 to 10 characters";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost:8080/chatroom";';
    echo '</script>';
}
else if(!ctype_alnum($room)){
    $message = "Please choose an alphanumeric room name";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost:8080/chatroom";';
    echo '</script>';
}
else {
    include'db_connect.php';
}

$sql = "SELECT * FROM `room` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);
if($result){
    if(mysqli_num_rows($result) > 0){
    $message = "Please choose a different room this room has been already created and running";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost:8080/chatroom";';
    echo '</script>';
    }
    else {
        $sql = "INSERT INTO `room` (`roomname`, `timestamp`) VALUES ('$room', CURRENT_TIMESTAMP);";
        if (mysqli_query($conn, $sql)){
        $message = "Room Created!";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost:8080/chatroom/room.php?roomname=' .$room. '";';
        echo '</script>';  
        }
    }
}
else {
    echo 'Error: '. mysqli_error($conn);
}
?>
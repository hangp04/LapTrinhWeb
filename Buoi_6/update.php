<?php 
    include 'connection.php';
    
    $conn = connection(false);

    $sql = "UPDATE MyGuests SET firstname = 'Jane' where firstname = 'James'";
    if ($conn->query($sql) == true){
        echo "Record updated successfully";

        header("Location: show_data.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
?>
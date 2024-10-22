<?php 
    include 'connection.php';
    
    $conn = connection(false);

    $sql = "DELETE FROM MyGuests where id = 3";
    if ($conn->query($sql) == true){
        echo "Record deleted successfully";

        header("Location: show_data.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
?>
<?php 
    include 'connection.php';
    
    $conn = connection(false);

    $sql = "INSERT INTO MyGuests (firstname, lastname, email) values 
    ('John', 'Doe', 'john@example.com'),
    ('Jane', 'Smith', 'jane@example.com'),
    ('James', 'Johson', 'james@example.com'),
    ('Emily', 'Brown', 'emily@example.com'),
    ('Michael', 'Davis', 'michael@example.com')";
    if ($conn->query($sql) == true){
        echo 'New records created successfully';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>
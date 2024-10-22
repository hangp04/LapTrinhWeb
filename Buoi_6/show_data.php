<?php 
    include 'connection.php';
    
    $conn = connection(false);

    $sql = "SELECT id, firstname, lastname, reg_date FROM MyGuests";
    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        echo '<table border="1" style="border-collapse: collapse;">';
        echo '<tr><th>Id</th><th>Firstname</th><th>Lastname</th><th>Reg_Date</th></tr>';
        
        while ($row = $results->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['firstname']}</td><td>{$row['lastname']}</td><td>{$row['reg_date']}</td></tr>";
        }
        echo '</table>';
    } else {
        echo '0 results';
    }

    $conn->close();
?>

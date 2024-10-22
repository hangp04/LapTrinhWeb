<?php
require_once 'libs/employee.php';
require_once 'libs/departments.php';
 require_once 'libs/employeeroles.php';

$employees = get_all_employees();
if ($employees === false) {
    echo json_encode(['error' => 'Could not retrieve employees']);
    exit;
}

// Return the employee data in JSON format
header('Content-Type: application/json');
echo json_encode($employees);
?>

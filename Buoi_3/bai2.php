<?php
    $firstname = $lastname = $email = $invoiceID = "";
    $firstnameerror = $lastnameerror = $emailerror = $invoiceIDerror = $payforerror = "";
    $payfor = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["firstname"])){
            $firstnameerror = "Vui lòng nhập tên.";
        } else {
            $firstname = test_input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)){
                $firstnameerror = "Vui lòng chỉ điền chữ cái và dấu cách";
            }
        }

        if(empty($_POST["lastname"])){
            $lastnameerror = "Vui lòng nhập họ.";
        } else {
            $lastname = test_input($_POST["lastname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)){
                $lastnameerror = "Vui lòng chỉ điền chữ cái và dấu cách";
            }
        }

        if(empty($_POST["email"])){
            $emailerror = "Vui lòng nhập email.";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailerror = "Vui lòng nhập đúng định dạng email.";
            }
        }

        if(empty($_POST["invoiceID"])){
            $invoiceIDerror = "Vui lòng nhập Invoice ID.";
        } else {
            $invoiceID = test_input($_POST["invoiceID"]);
            if (!preg_match("/^[0-9]*$/",$invoiceID)){
                $invoiceIDerror = "Vui lòng chỉ điền số";
            }
        }

        if(empty($_POST["payfor"])) {
            $payforerror = "Hãy chọn ít nhất 1 mục trong Pay For.";
        } else {
            $payfor = $_POST["payfor"];
            foreach ($payfor as $value) {
                $value = test_input($value);
            }
        }
         
    }
    function test_input($a){
        $a = trim($a);
        $a = stripslashes($a);
        $a = htmlspecialchars($a);
        return $a;
    }
?>
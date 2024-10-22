<?php
    $firstname = $lastname = $email = $invoiceID = $fileToUpLoad = $add_in4 = "";
    $firstnameerror = $lastnameerror = $emailerror = $invoiceIDerror = $payforerror = $imgerror = "";
    $payfor = [];
    
    $target_dir = "uploads/";    

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_FILES["fileToUpLoad"]) && $_FILES["fileToUpLoad"]["error"] == 0) {
            $target_file = $target_dir . basename($_FILES["fileToUpLoad"]["name"]);
            $uploadok = 1;
            $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpLoad"]["tmp_name"]);
            if($check !== false) {
                $uploadok = 1;
            } else {
                $imgerror = "File is not an image.";
                $uploadok = 0;
            }
            if(file_exists($target_file)) {
                $imgerror = "File already exists.";
                $uploadok = 0;
            }
    
            if ($_FILES["fileToUpLoad"]["size"] > 500000) {
                $imgerror = "Your file is to large.";
                $uploadok = 0;
            }
    
            if ($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif") {
                $imgerror = "Only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadok = 0;
            }
    
            if ($uploadok == 0) {
                $imgerror;
            } else {
                if (!move_uploaded_file($_FILES["fileToUpLoad"]["tmp_name"], $target_file)) {
                    $imgerror = "There was an error uploading your file.";
                } else {
                    $fileToUpLoad = $target_file;
                }
            }
        } else {
            $imgerror = "Please upload an image file.";
        }

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
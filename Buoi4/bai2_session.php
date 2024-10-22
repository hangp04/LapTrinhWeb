<?php
    $firstname = $lastname = $email = $invoiceID = $fileToUpLoad = $add_in4 = "";
    $firstnameerror = $lastnameerror = $emailerror = $invoiceIDerror = $payforerror = $imgerror = "";
    $payfor = [];

    $target_dir = "uploads/";

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_valid = true;

        if (isset($_FILES["fileToUpLoad"]) && $_FILES["fileToUpLoad"]["error"] == 0) {
            $target_file = $target_dir . basename($_FILES["fileToUpLoad"]["name"]);
            $uploadok = 1;
            $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpLoad"]["tmp_name"]);
            if ($check !== false) {
                $uploadok = 1;
            } else {
                $imgerror = "File is not an image.";
                $uploadok = 0;
                $form_valid = false;
            }
            if (file_exists($target_file)) {
                $imgerror = "File already exists.";
                $uploadok = 0;
                $form_valid = false;
            }

            if ($_FILES["fileToUpLoad"]["size"] > 500000) {
                $imgerror = "Your file is too large.";
                $uploadok = 0;
                $form_valid = false;
            }

            if ($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif") {
                $imgerror = "Only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadok = 0;
                $form_valid = false;
            }

            if ($uploadok == 0) {
                $form_valid = false;
            } else {
                if (!move_uploaded_file($_FILES["fileToUpLoad"]["tmp_name"], $target_file)) {
                    $imgerror = "There was an error uploading your file.";
                    $form_valid = false;
                } else {
                    $fileToUpLoad = $target_file;
                }
            }
        } else {
            $imgerror = "Please upload an image file.";
            $form_valid = false;
        }

        if (empty($_POST["firstname"])) {
            $firstnameerror = "Vui lòng nhập tên.";
            $form_valid = false;
        } else {
            $firstname = test_input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
                $firstnameerror = "Vui lòng chỉ điền chữ cái và dấu cách.";
                $form_valid = false;
            }
        }

        if (empty($_POST["lastname"])) {
            $lastnameerror = "Vui lòng nhập họ.";
            $form_valid = false;
        } else {
            $lastname = test_input($_POST["lastname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
                $lastnameerror = "Vui lòng chỉ điền chữ cái và dấu cách.";
                $form_valid = false;
            }
        }

        if (empty($_POST["email"])) {
            $emailerror = "Vui lòng nhập email.";
            $form_valid = false;
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailerror = "Vui lòng nhập đúng định dạng email.";
                $form_valid = false;
            }
        }

        if (empty($_POST["invoiceID"])) {
            $invoiceIDerror = "Vui lòng nhập Invoice ID.";
            $form_valid = false;
        } else {
            $invoiceID = test_input($_POST["invoiceID"]);
            if (!preg_match("/^[0-9]*$/", $invoiceID)) {
                $invoiceIDerror = "Vui lòng chỉ điền số.";
                $form_valid = false;
            }
        }

        if (empty($_POST["payfor"])) {
            $payforerror = "Hãy chọn ít nhất 1 mục trong Pay For.";
            $form_valid = false;
        } else {
            $payfor = $_POST["payfor"];
        }

        if ($form_valid) {
            $_SESSION["userData"] = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "invoiceID" => $invoiceID,
                "fileToUpLoad" => $fileToUpLoad,
                "payfor" => $payfor,
                "add_in4" => $_POST['add_in4'] ?? ''
            ];

            header("Location: show_session.php");
        }
    }

    function test_input($a){
        $a = trim($a);
        $a = stripslashes($a);
        $a = htmlspecialchars($a);
        return $a;
    }
?>

<?php
    $tensach = $tacgia = $nxb = $namxb = "";
    $tensacherror = $tacgiaerror = $nxberror = $namxberror = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tensach = $_POST["tensach"];
        $tacgia = $_POST["tacgia"];
        $nxb = $_POST["nxb"];
        $namxb = $_POST["namxb"];

        if (empty($tensach)) {
            $tensacherror = "Vui lòng điền tên sách!";
        } else {
            $tensach = test_input($tensach);
        }
        if (empty($tacgia)) {
            $tacgiaerror = "Vui lòng điền tên tác giả!";
        } else {
            $tacgia = test_input($tacgia);
        }
        if (empty($nxb)) {
            $nxberror = "Vui lòng điền nhà xuất bản!";
        } else {
            $nxb = test_input($nxb);
        }
        if (empty($namxb)) {
            $namxberror = "Vui lòng điền năm xuất bản!";
        } else if (!is_numeric($namxb)) {
            $namxberror = "Năm xuất bản phải là số!";
        } else {
            $namxb = test_input($namxb);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<?php 
    $array = [];
    $LonNhat = $NhoNhat = $Tong = 0;
    $arraySapXep = [];
    $SoCanTim = "";
    $Found = false;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $arrayInput = isset($_GET['array']) ? $_GET['array'] : '';
        $array = array_map('intval', explode(" ", $arrayInput));

        if(!empty($array)) {
            $LonNhat = max($array);
            $NhoNhat = min($array);
            $Tong = array_sum($array);

            $arraySapXep = $array;
            sort($arraySapXep);

            $SoCanTim = isset($_GET['So_Can_Tim']) ? (int)$_GET['So_Can_Tim'] : '';
            $Found = in_array($SoCanTim, $array);
        }
    }
?>

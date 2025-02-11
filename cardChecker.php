<?php
function resolve($number) {
    $number = str_split($number);
    $total = 0;
    for ($i = 0; $i < sizeof($number)-1; $i++) {
        if ($i % 2 == 1) {
            foreach (str_split($number[$i]*2) as $num) {
                $total += $num;
            };
        } else {
            $total += $number[$i];
        }
    }
    return $number[sizeof($number)-1] == fmod($total*9,10) ? '1' : '0';
}

$uri = "https://localhost/cardChecker.php";
$server = new SoapServer(null, array("uri"=>$uri));
$server->addFunction("resolve");
$server->handle();

?>
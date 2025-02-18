<?php
/**
 * @param int $number
 * 
 * @return int|string
 */
function resolve($number) {
    $number = str_split($number);
    $total = 0;
    $length = sizeof($number)-2;

    for ($i = 0; $i <= $length; $i++) {
        if ($i % 2 == 0) {
            $num = $number[$length - $i] * 2;
            if ($num >= 10) {
                $total += floor($num / 10);
                $total += $num % 10;
            } else {
                $total += $num;
            }
        } else {
            $total += $number[$length-$i];
        }
    }

    return $number[sizeof($number)-1] == (10 - ($total % 10)) % 10 ? '1' : '0';
}

$uri = "https://localhost/cardChecker.php";
$server = new SoapServer(null, array("uri"=>$uri));
$server->addFunction("resolve");
$server->handle();

?>
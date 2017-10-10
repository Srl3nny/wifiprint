<?php
include("valida.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$usuario=$_SESSION['usu'];
$impressora=$_REQUEST['impressora'];
$copias=$_REQUEST['copias'];
$orientacao=$_REQUEST['orientacao'];
$paginas=$_REQUEST['paginas'];

//$padrao = "^[[:alpha:]][0-9]{5,6}$";

if (preg_match('/^[[:alpha:]][0-9]{5,6}$/',$usuario) && $impressora == "2-administracao")
{
    session_destroy();
    header("Location:printerror.php");
    exit("Saindo)");
}


if (isset($_REQUEST['verso'])){
  $verso = 'two-sided-long-edge';
}	
else{
  $verso = 'one-sided-long-edge';	
}

if (isset($_FILES['arquivo'])) {
    $arq = $_FILES['arquivo']['name'];
    echo "teste<br>";
    }
echo "$arq<br>";

echo '<pre>', PHP_EOL;
print_r($_FILES);
echo '</pre>';

$uploaddir = '/tmp/';
$uploadfile = $uploaddir.$arq;
move_uploaded_file($_FILES['arquivo']['tmp_name'],$uploadfile);


if ($impressora == 1)
{
    $imp = "lab";
}
else
{
    $imp = "adm";
}
if (!empty($_REQUEST['paginas'])){
$command = 'lp -o fit-to-page -o media=A4 -d '.$imp.' -n '.$copias.' -U '.$usuario.' -o orientation-requested='.$orientacao.' '.$uploadfile.' -o sides='.$verso.' -o page-ranges='.$paginas;
$printing = exec($command);
}
else{
$command = 'lp -o fit-to-page -o media=A4 -d '.$imp.' -n '.$copias.' -U '.$usuario.' -o orientation-requested='.$orientacao.' '.$uploadfile.' -o sides='.$verso;
//$printing = exec($command);
}
echo "<br>";
//echo "$command<br>";
echo "<br>";
?>

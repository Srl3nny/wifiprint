<?php
include("valida.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8" />
   <title>WifiPrint</title>
   <link rel="stylesheet" type="text/css" href="estilos.css">
   <script language="JavaScript" type="text/javascript" src="funcs.js"></script>
</head>
<body>

<?

function logMsg( $msg, $level = 'info', $file = '/var/log/wifiprint.log' )
{
    // variável que vai armazenar o nível do log (INFO, WARNING ou ERROR)
    $levelStr = '';
 
    // verifica o nível do log
    switch ( $level )
    {
        case 'info':
            // nível de informação
            $levelStr = 'INFO';
            break;
 
        case 'warning':
            // nível de aviso
            $levelStr = 'WARNING';
            break;
 
        case 'error':
            // nível de erro
            $levelStr = 'ERROR';
            break;
    }
 
    // data atual
    $date = date( 'Y-m-d H:i:s' );
 
    // formata a mensagem do log
    // 1o: data atual
    // 2o: nível da mensagem (INFO, WARNING ou ERROR)
    // 3o: a mensagem propriamente dita
    // 4o: uma quebra de linha
    $msg = sprintf( "[%s] [%s]: %s%s", $date, $levelStr, $msg, PHP_EOL );
 
    // escreve o log no arquivo
    // é necessário usar FILE_APPEND para que a mensagem seja escrita no final do arquivo, preservando o conteúdo antigo do arquivo
    file_put_contents( $file, $msg, FILE_APPEND );
}

echo 'Verifique na impressora ';
echo $_SESSION['usu'];
echo "<br><input type='button' value='Sair' onclick='location.href=\"index.php\";'><br>";

$usuario=$_SESSION['usu'];
$impressora=$_REQUEST['impressora'];
$copias=$_REQUEST['copias'];
$orientacao=$_REQUEST['orientacao'];
$paginas=$_REQUEST['paginas'];

//$padrao = "^[[:alpha:]][0-9]{5,6}$";

if (preg_match('/^[[:alpha:]][0-9]{5,6}$/',$usuario) && $impressora == "2-administracao")
{
    LogMsg( 'Usuario '.$usuario.' nao permitido imprimir na imp Administacao','error' );
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
    }
echo "$arq<br>";

echo '<pre>', PHP_EOL;
//print_r($_FILES);
echo '</pre>';

$uploaddir = '/tmp/';
$uploadfile = $uploaddir.$arq;
move_uploaded_file($_FILES['arquivo']['tmp_name'],$uploadfile);

//$convert = 'pdftops '.$uploadfile;

//$converttops = exec($convert);
//echo "$converttops";
$nomearq = preg_replace('/\s+/', '', $arq);
$extension = end(explode(".", $nomearq));

if ($extension !== "pdf")
{
   LogMsg( 'Formato do arquivo diferente de PDF '.$usuario.' !','error' );
   session_destroy();
   header("Location:printerror2.php");
   exit("Saindo)");
}

if ($impressora == 1)
{
    $imp = "lab";
}
else
{
    $imp = "adm";
}
if (!empty($_REQUEST['paginas'])){
    $paginas = preg_replace('/\s+/', '', $paginas);
    $command = 'lp -o fit-to-page -o media=A4 -d '.$imp.' -n '.$copias.' -U '.$usuario.' -o orientation-requested='.$orientacao.' "'.$uploadfile.'" -o sides='.$verso.' -o page-ranges='.$paginas;
    $printing = exec($command);
}
else{
    $paginas = "todas";
    $command = 'lp -o fit-to-page -o media=A4 -d '.$imp.' -n '.$copias.' -U '.$usuario.' -o orientation-requested='.$orientacao.' "'.$uploadfile.'" -o sides='.$verso;
    $printing = exec($command);
}

LogMsg( 'Comando usado para imprimir -- '.$command );
logMsg( 'Imprimindo para '.$usuario.' com '.$copias.' quantidade de copias as paginas '.$paginas.' do arquivo '.$uploadfile.' na impressora '.$imp );
echo "<br>";
echo "<br>";
echo "<br>";
?>
</body>
</html>
<?
?>

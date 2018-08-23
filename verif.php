<?php
// ******************************************************************
//  ATENÇÃO 
//Variáveis que são necessárias configurar de acordo com o seu ambiente
// $ldaphost   $ldapport   $dominio   $ip_server  
//********************************************************************
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

error_reporting(0);
ini_set('display_errors', 0);

set_time_limit(0);

function valida_ldap($srv, $usr, $pwd)
{

    $ldap_server = $srv;
    $auth_user = $usr;
    $auth_pass = $pwd;

    // Tenta se conectar com o servidor
  //  if (!($connect = @ldap_connect($ldap_server))){
    //   return FALSE;
   // }
  //$connect = ldap_connect("") or die("Could not connect to LDAP server.");

    $ldaphost = "ldap://servidor-ldap";  // your ldap servers
    $ldapport = 389;                 // your ldap server's port number

// Connecting to LDAP
    $connect = ldap_connect($ldaphost, $ldapport)
          or die("Could not connect to $ldaphost");
    ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);

    // Tenta autenticar no servidor
    if (!($bind = ldap_bind($connect, $auth_user, $auth_pass))) {
        // se nao validar retorna false
        return FALSE;
    } else {
        // se validar retorna true
        return TRUE;
    }

} // fim funcao conectar ldap

$dominio = ",ou=Users,dc=xx,dc=xx,dc=xx";
$usu = 'uid='.$_REQUEST['usu'].$dominio;
$senha = $_REQUEST['senha'];
$ip_server = "ldap://servidor-ldap";

if (valida_ldap($ip_server, $usu, $senha)) {
    echo "usuario autenticado<br>";

    session_start();
    $_SESSION['usu'] = $_REQUEST['usu'];
    $_SESSION['senha'] = $_REQUEST['senha'];

    //header("form.php");
	header("Location: form.php");

}else {
?>
  <div align='center';vertical-align: 'middle'><? echo "Usuario ou Senha Invalidos<br>";?></div>
   <div align='center';vertical-align: 'middle'><? echo "<br><input type='button' value='voltar' onclick='location.href=\"index.php\";'>";?> </div>
<?
}

?>

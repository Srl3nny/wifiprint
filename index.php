<?php
session_start('sessao');

?>
<html>
<head>
    <meta charset="UTF-8" />
   <title>WifiPrint</title>
   <link rel="stylesheet" type="text/css" href="estilos.css">
   <script language="JavaScript" type="text/javascript" src="funcs.js"></script>
</head>
<body>
    <div id="area">

    <form method="post" action="verif.php" name="form" AUTOCOMPLETE='ON' onSubmit="return valida()">
        Usuario:<br>
        <input type="text" name="usu" size="50" maxlength="50" required>
        <br><br>
        Senha:<br>
        <input type="password" name="senha" size="50" maxlength="25" required>
        <br><br>
        <input type="submit" value="Entrar">
    </form>
    </div>
</body>
</html>
 <style>
 label{display:block;}
 </style>
~           

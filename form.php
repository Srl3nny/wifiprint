<?php
include("valida.php");
echo 'Usuário Logado: ';
echo $_SESSION['usu'];
echo "<br><input type='button' value='Sair' onclick='location.href=\"index.php\";'>";
?>
<!DOCTYPE html>
 <html lang="pt-BR">
 <head>
   <meta charset="UTF-8" />
   <title>WifiPrint</title>
   <link rel="stylesheet" type="text/css" href="estilos.css">
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="css/estiloie.css">
    <![endif]-->
</head>
 <body>
   <div id="area">
     <form name="formPrint" enctype="multipart/form-data" action="print.php" method="POST">
       <fieldset>
         <legend>WifiPrint</legend>
   	     <label> Arquivo:
	       <input type="file" required name="arquivo" accept="application/vnd.ms-excel, text/plain, application/pdf">
	     </label>
		 <label>Impressora:
		   <select name="impressora">
			<option>1-labinformatica</option>
			<option>2-administracao</option>
		   </select>
		 </label>
		 <label>Páginas:	 	
		   <input type="text" name="paginas" size="10" maxlength="20">
	     </label>
		 <label>Número de Cópias:	 	
		   <input type="text" name="copias" required size="3" maxlength="3">
	     </label>		 
		 <label>Orientação
		   <input type="radio" name="orientacao" value="3" checked> Retrato 
		   <input type="radio" name="orientacao" value="4"> Paisagem
		 </label> 	
		 <label> Imprimir Frente/Verso?
		   <input type="checkbox" name="verso" value="off" /> 

		 </label>   
		 <br>
		 <input type="submit" class="btn">
	   </fieldset>
     </form>
    <br>
   </div>
 </body>
 </html>
 
 <style>
 label{display:block;}
 </style>

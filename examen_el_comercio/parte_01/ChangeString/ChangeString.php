<?php

header('Content-Type: text/html; charset=ISO-8859-1');

class ChangeString
{
    public function build($cadena)
    {
        $arregloCaracteres = str_split($cadena);
        $arregloCadenaDeRemplazos = array();        

        try 
        {            
            for($i = 0 ; $i < count($arregloCaracteres) ; $i++)
            {                
                $arregloCadenaDeRemplazos[$i] = $arregloCaracteres[$i]; // Primero va poniendo uno por uno los caracteres de la cadena en el arreglo "$arregloCadena".
                
                if ((ord($arregloCaracteres[$i]) >= 97 && ord($arregloCaracteres[$i]) <= 121) || (ord($arregloCaracteres[$i]) >= 65 && ord($arregloCaracteres[$i]) <= 89)) // Reemplaza donde encuentra letras minúsculas o mayúsculas excepto "z", "Z", "ñ", y "Ñ".
                    $arregloCadenaDeRemplazos[$i] = str_replace($arregloCaracteres[$i], chr(ord($arregloCaracteres[$i]) + 1), $arregloCaracteres[$i]);
                
                if (ord($arregloCaracteres[$i]) == 122) // Reemplaza donde encuentra "z" minúscula.
                    $arregloCadenaDeRemplazos[$i] = str_replace($arregloCaracteres[$i], chr(97), $arregloCaracteres[$i]);
                
                if (ord($arregloCaracteres[$i]) == 90) // Reemplaza donde encuentra "Z" mayúscula.
                    $arregloCadenaDeRemplazos[$i] = str_replace($arregloCaracteres[$i], chr(65), $arregloCaracteres[$i]);
                
                if (ord($arregloCaracteres[$i]) == 241) // Reemplaza donde encuentra "ñ".                    
                    $arregloCadenaDeRemplazos[$i] = str_replace($arregloCaracteres[$i], "o", $arregloCaracteres[$i]); // Como se que sólo es una ñ la reemplazo directamente por la letra "o".
                
                if (ord($arregloCaracteres[$i]) == 209) // Reemplaza donde encuentra "Ñ".
                    $arregloCadenaDeRemplazos[$i] = str_replace($arregloCaracteres[$i], "O", $arregloCaracteres[$i]); // Como se que sólo es una ñ la reemplazo directamente por la letra "o".
            }

            return implode($arregloCadenaDeRemplazos); // Retorna el arreglode caracteres en formato cadena.
        } 
        catch (Exception $e) 
        {
            throw $e;
        }
    }  
}

$cadena = "";
$resultado = "";

if(isset($_POST['submit']))
{
	if (isset($_POST["cadena"]))
		$cadena = $_POST["cadena"];

    $objetoChangeString = new ChangeString();                    
    $resultado = $objetoChangeString->build($cadena);  
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Transformación de cadena</title>
	</head>
	<body>
		<form action="ChangeString.php" method="post">
			cadena: <input type="text" name="cadena" autofocus />
			<br /><br />			 
			<input type="submit" name="submit" value="Transformar Cadena" />
		</form>
		<br />
		<br />
		<p><?php echo($resultado) ?></p> 
	</body>
</html>

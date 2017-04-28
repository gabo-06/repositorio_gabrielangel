<?php

class ClearPar
{
    public function build($cadena)
    {
        $arreglo = str_split($cadena);        
        $orden = "par"; // Sirve para llevar un control del ordern de los paréntesis, cuando su valor es "par" quiere decir que se ha encontrado el paréntesis de apertura "(" al evaluar la cadena y si sy valor es "impar" se ha encontrado el paréntesis de clausura ")".
        $nuevaCadena = "";

        try 
        {            
            for ($i = 0 ; $i < count($arreglo) ; $i++) 
            { 
                if ($arreglo[$i] != "(" && $arreglo[$i] != ")")
                    throw new Exception("Ingrese sólo paréntesis en la cadena!");
            }

            for ($i = 0 ; $i < count($arreglo) ; $i++) 
            {
                if ($orden == "par")
                    if ($arreglo[$i] != ")") // Quiere decir que ha encontrado un paréntesis de apertura.
                    {
                        $nuevaCadena .= $arreglo[$i];
                        $orden = "impar";
                        continue;
                    }

                if ($orden == "impar")
                    if ($arreglo[$i] != "(") // Quiere decir que ha encontrado un paréntesis de apertura.
                    {
                        $nuevaCadena .= $arreglo[$i];
                        $orden = "par";
                    }                    
            }

            if ((strlen($nuevaCadena) % 2) != 0) // Si al final la cantidad de caracteres de la variable "$nuevaCadena" es 1, quiere decir que aún mantiene uno de los paréntesis, para eso se hace está comprobación.
                $nuevaCadena = "";

            return $nuevaCadena;
        } 
        catch (Exception $e) 
        {
            throw $e;
        }
    }  
}

$resultado = "";
$cadena = "";

if(isset($_POST['submit']))
{
	if (isset($_POST["cadena"]))
		$cadena = $_POST["cadena"]; 
    
    $objetoClearPar = new ClearPar(); 

    try 
    {        
        $resultado = $objetoClearPar->build($cadena);
    } 
    catch (Exception $e) 
    {
        echo $e->getMessage();    
        echo "<br /><br />";
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ajustar cadena de paréntesis</title>
	</head>
	<body>
		<form action="ClearPar.php" method="post">
			Ingrese cadena formada sólo por paréntesis: <br />
            <input type="text" name="cadena" autofocus />
			<br /><br />			 
			<input type="submit" name="submit" value="Ajustar" />
		</form>
		<br />
		<br />
		<p>
            <?php 
            if (isset($resultado)) 
                echo $resultado;
            ?>
        </p> 
	</body>
</html>

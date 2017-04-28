<?php

// header('Content-Type: text/html; charset=ISO-8859-1');

class CompleteRange
{
    public function obtenerNumero($val) 
    { 
      if (is_numeric($val)) 
      { 
        return $val + 0; 
      } 
      return 0; 
    } 

    public function verificaOrdenAscendente($coleccionNumeros)
    {        
        try 
        {
            for ($i = 0 ; $i < count($coleccionNumeros); $i++) 
            {                
                if ($i == 0) // En el primer índice toma el primer elemento del arreglo como "valor anterior" y se almacena en la variable "$valorAnterior" para luego poder tener una referencia en las siguiente comparaciones.
                    $valorAnterior = $coleccionNumeros[$i];                
                else         // A patir del segundo índice ($i = 1) verifica si el elemento actual es mayor que el elemento anterior y si es así establece como valor anterior al elemento actual.
                    if ($coleccionNumeros[$i] >= $valorAnterior)
                        $valorAnterior = $coleccionNumeros[$i];
                    else
                        throw new Exception("La colección de números no está ordenada ascendentemente en el valor ".$coleccionNumeros[$i]. ", por favor corregir.");
            }
        }
        catch (Exception $e) 
        {
            throw $e;   
        }
    }

    public function build($coleccionNumeros)
    {

        $minimoValorColeccion = min($coleccionNumeros);
        $maximoValorColeccion = max($coleccionNumeros);
        $coleccionCompleta = array();        
        $indiceRecorrido = 0;

        try 
        {         
            for ($i = 0 ; $i < count($coleccionNumeros); $i++) 
            {   

                if (!is_numeric($coleccionNumeros[$i])) // Primero verifica si el elemento es una cadena numérica.                
                    throw new Exception("El valor ".$coleccionNumeros[$i]." no es un número");                                                            
                                
                $numero = $this->obtenerNumero($coleccionNumeros[$i]); // Una vez verificado que el valor es una cadena numérica rescata el valor de la cadena numérica.
                
                if (!is_int($numero)) // Verifica si el número es un entero.
                    throw new Exception("El número ".$numero." no es un entero, por favor ingrese sólo número enteros");                
            }               

            $this->verificaOrdenAscendente($coleccionNumeros); // Verifica el orden ascendente de la colección de números.            
            
            for ($i = $minimoValorColeccion ; $i <= $maximoValorColeccion ; $i++) // Hace un recorrido entre el mínimo y el máximo valor de la colección de números y va llenando un arreglo con números enteros válidos dentro de ese rango. 
            { 
                $coleccionCompleta[$indiceRecorrido] = $i; // La variable $i es el valor que se le da a cada elemento del arreglo.
                $indiceRecorrido++; // Esta variable sirve como índice del arreglo $coleccionCompleta mientras que la variable $i es el valor que se le da a cada elemento del arreglo.
            }         
            
            return $coleccionCompleta; // Devuelve la colección completa de números enteros con los ajustes necesarios si es que hubo algún número entero faltante.
        } 
        catch (Exception $e) 
        {
            throw $e;
        }
    }  
}

if(isset($_POST['submit']))
{
	if (isset($_POST["numeros"]))
		$numeros = $_POST["numeros"];    

    $coleccionNumeros = explode(",", $numeros); // Devuelve la colección de números en forma de arreglo.
    $objetoCompleteRange = new CompleteRange(); 

    try 
    {
        $coleccionCompleta = $objetoCompleteRange->build($coleccionNumeros);      
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
		<title>Completar Rango de números</title>
	</head>
	<body>
		<form action="CompleteRange.php" method="post">
			Ingrese números enteros separados por comas (ascendentemente): <br />
            <input type="text" name="numeros" autofocus />
			<br /><br />				 
			<input type="submit" name="submit" value="Completar rango" />
		</form>
		<br />
		<br />
		<?php 
        if (isset($coleccionCompleta)) 
            echo "Resultado: ".(implode(",", $coleccionCompleta));
        else
            echo "Ingrese una cadena!";
        ?>
	</body>
</html>

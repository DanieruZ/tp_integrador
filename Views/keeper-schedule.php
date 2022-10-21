<form action="<?php echo FRONT_ROOT ?>Keeper/fecha" method="POST" class="p-5">

  <p>Fecha Inicio: <input type="date" name="fechaInicio"></p>
  <p>Fecha Fin: <input type="date" name="fechaFin"> <input type="submit" value="Enviar datos"></p>


</form>
<?php
  
date_default_timezone_set("America/Buenos_Aires");
 #Domingo 0, Lunes 1... Sábado 6

$dia_actual = intval(date("w")); #Convertir siempre a entero para evitar errores
print_r($dia_actual);
if ($dia_actual != 6 && $dia_actual != 0 ) {
    # Aquí la acción que se realice en el horario permitido
    echo "Bienvenido, visitante";
} else {
    # Mostrar un aviso
    echo "No se permiten visitantes en este día";
}
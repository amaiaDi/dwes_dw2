<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/06.css">
    <title>Ejercicio 6 | Edgar Martínez Palmero</title>
</head>
<body>
    <h1>Ejercicio 6</h1>
    <?php
      
      function tabla($arrDias, $horaInicio, $horaFin, $intervaloMin) {
        
        echo "<table>";
        echo "<tr>";
        echo "<td></td>";
        foreach ($arrDias as $dia) {
          echo "<td>{$dia}</td>";
        }
        $horas = horas($horaInicio, $horaFin, $intervaloMin);
        foreach ($horas as $arrHora) {
          
          echo "<tr>";
          echo "<td>{$arrHora[0]}:{$arrHora[1]}</td>";
          for ($i=0; $i < count($arrDias); $i++) { 
            echo "<td></td>";
          }
          echo "</tr>";
        }
        echo "</tr>";
        echo "</table>";
      }
      
      function horas($fechaInicio, $fechaFin, $intervaloMin) {
        $horaInicio = $fechaInicio[0];
        $minInicio = $fechaInicio[1];
        $horaFin = $fechaFin[0];
        $minFin = $fechaFin[1];
        $horaAux = $horaInicio;
        $minAux = $minInicio;
        $arrHoras = array();
        $numIntervalos = (($horaFin * 60 + $minFin) - ($horaInicio * 60 + $minInicio))/$intervaloMin;
        for ($i=0; $i <= $numIntervalos; $i++) { 
          while ($minAux >= 60) {
            $horaAux++;
            $minAux-=60;
          }
          // A las horas con un solo carácter se les concatenara un 0 por delante 
          if (strlen($horaAux) == 1)
            $horaAux = '0'.$horaAux;
          // A los minutos con un solo carácter se les concatenara un 0 por delante
          if (strlen($minAux) == 1)
            $minAux = '0'.$minAux;

          $arrHoras[] = array($horaAux, $minAux);
          $minAux+=$intervaloMin;
        }
        return $arrHoras;
      }

      $dias = array ("Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom");
      $fechaInicio = array(8,00);
      $fechaFin = array(15,00);
      tabla($dias, $fechaInicio, $fechaFin, 120);

    ?>
</body>
</html>
<?php
class individual
{

public function seleccion(){
 $sql = "SELECT *,departamento.Nombre FROM horas_laboradas INNER JOIN departamento on departamento.DepartamentoID=horas_laboradas.DepartamentoID Where horas_laboradas.ID_Usuario='".$_GET['id']."'";
 $result =mysqli_query($link, $sql);
 while($row = mysqli_fetch_array($result)){
   $sql3=mysqli_query($link,"SELECT SUM(Horas_Cumplidas) as total FROM horas_laboradas WHERE ID_Usuario='".$_GET['id']."' OR  ID_Usuario='".$_GET['alumnoid']."' OR ID_Usuario='".$_GET['horas']."'" );
   $row3=mysqli_fetch_array($sql3);
    echo "<tr>";
    echo "<td>".$a."</td>";
    echo "<td>".$row['Nombre']."</td>";
    echo "<td>".$row['Fecha_Inicio']."</td>";
    echo "<td>".$row['Fecha_FinalReal']."</td>";
    echo "<td>".$row['Horas_Cumplidas']."</td>";
    echo "</tr>";
 $a=$a+1;
}
echo "<td>TOTAL</td>";
echo "<td>-</td>";
echo "<td>-</td>";
echo "<td>-</td>";
echo "<td>". $row3['total'] ."</td>";
echo "</table></center>";
echo '</ul><div class="holder"></div>';
    }
public function horas()
  {
    echo '<ul id="itemContainer" class="list-unstyled">';
          echo "<table class='table table-hover text-center'>";
          echo "<tr>";
          echo "<th>#</th>";
          echo "<th>Departamento</th>";
          echo "<th>Fecha Inicio</th>";
          echo "<th>Fecha Final</th>";
          echo "<th>Cantidad De Horas</th>";
          echo "</tr>";
  }
  public function ciclo_detallehora($result)
  {
    while($row = mysqli_fetch_array($result)){
       $sql3=mysqli_query($link,"SELECT SUM(Horas_Cumplidas) as total FROM horas_laboradas WHERE ID_Usuario='".$_GET['id']."' OR  ID_Usuario='".$_GET['alumnoid']."' OR ID_Usuario='".$_GET['horas']."'" );
       $row3=mysqli_fetch_array($sql3);
        echo "<tr>";
        echo "<td>".$a."</td>";
        echo "<td>".$row['Nombre']."</td>";
        echo "<td>".$row['Fecha_Inicio']."</td>";
        echo "<td>".$row['Fecha_FinalReal']."</td>";
        echo "<td>".$row['Horas_Cumplidas']."</td>";
        echo "</tr>";
     $a=$a+1;
    }
    echo "<td>TOTAL</td>";
    echo "<td>-</td>";
    echo "<td>-</td>";
    echo "<td>-</td>";
    echo "<td>". $row3['total'] ."</td>";
    echo "</table></center>";
    echo '</ul><div class="holder"></div>';

}
}
?>

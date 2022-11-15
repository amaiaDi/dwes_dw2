<?php
     $sql = "SELECT * FROM CATEGORIAS";
     $result = mysqli_query($con, $sql);

     $li = "<li><a href='index.php?ir=items'>VER TODAS</a></li>";

     while( $fila = mysqli_fetch_Array($result)){
          $id = $fila['id'];
          $categoria = $fila['categoria'];
          $li = $li."<li><a href='index.php?id=$id&ir=items'>$categoria</a></li>";
     }
?>
<h1>CATEGORIAS</h1>
<div>
     <ul>
          <?php echo $li;?>
     </ul> 
</div>
<?php 
    include_once("config.php");
   
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);

?> 
<?php
   // pujas
   function fncP($con){

      $sql = "SELECT *  FROM PUJAS WHERE exists(select * from items where pujas.id_item=items.id)";   
      $rP= mysqli_query($con,$sql);
      
      if(mysqli_errno($con)) die(mysqli_error($con)); 
  
      if($rP==false){
          return array();
      }else{
          return $rP;
      }
  }$rP=fncP($con );
                
   // items
   function fncIt($con){

      $sql = "SELECT * 
              from items ";   
      $rIT= mysqli_query($con,$sql);
      
      if(mysqli_errno($con)) die(mysqli_error($con)); 
  
      if($rIT==false){
          return array();
      }else{
          return $rIT;
      }
  }$rIT=fncIt($con );

  // imagenes
  function fncIM($con){

      $sql = "SELECT *
              from imagenes
              where EXISTS
                  (select *
                  from items
                  where imagenes.id_item=items.id) ";   
      $rIM= mysqli_query($con,$sql);
      
      if(mysqli_errno($con)) die(mysqli_error($con)); 
  
      if($rIM==false){
          return array();
      }else{
          return $rIM;
      }
  }$rIM=fncIM($con );
?>
<h3>Items Disponibles</h3>
<table>
   <tr><td>Imagen</td><td>Item</td><td>Pujas</td><td>Precio</td><td>Pujas Hasta</td></tr>
<?php 
   $contIM=0;
   $contP=0; 
   $contIT=0;
   $contITP=0;
   $arrayIM =array();
   $arrayIT =array();
   $arrayITM =array();
   $arrayP =array();
   $arrayPF =array();
   $arrayITP =array();
   while($fila = mysqli_fetch_assoc($rIT)){ 
      $id=$fila['id'];
      
      while($filaIM = mysqli_fetch_assoc($rIM)){ 
         if($id=$filaIM['id_item']){
            $arrayIM[$contIM]="<img src='imagenes/$filaIM[imagen]' width=150px>";
         }
         $contIM=$contIM+1;
      }
      $arrayIT[$contIT]=$fila['nombre'];
      $arrayITM[$contIT]=$fila['preciopartida'];
      while($filaP = mysqli_fetch_assoc($rP)){ 
         if($id=$filaP['id_item']){
            $arrayP[$contP]=$filaP['cantidad'];
            $arrayPF[$contP]=$filaP['fecha'];
         }
         $contP= $contP+1;
      }
      



      $contIT=$contIT+1;
      
   } 
   function fnC($con,$ide){

      $sql = "SELECT count(*) as numItems
      from imagenes
      where exists(select * from items where $ide=imagenes.id_item)";   
      $rC= mysqli_query($con,$sql);
      
      if(mysqli_errno($con)) die(mysqli_error($con)); 
  
      $numItems=0;
      while($fila = mysqli_fetch_assoc($rC)){ 
         $numItems=$fila['numItems'];
      }
      return $numItems;
     
  }
   
  function fnC1($con){

   $sql = "SELECT count(*) as numItemss
         from items ";   
         $rC= mysqli_query($con,$sql);
   
   if(mysqli_errno($con)) die(mysqli_error($con)); 

   $numItemss=0;
   while($fila = mysqli_fetch_assoc($rC)){ 
      $numItemss=$fila['numItemss'];
   }
   return $numItemss;
  
}$rC1=fnC1($con );
?>
<?php
   
   for ($i=0; $i < $rC1; $i++) { 
      echo "<tr>"; 
      $rC=fnC($con,$i+1);
      if($rC==1){
         echo "<td>$arrayIM[$i]</td>";
         echo "<td>$arrayIT[$i]</td>";
         echo "<td>$arrayP[$i]</td>";
         echo "<td>$arrayITM[$i]</td>";
         echo "<td>$arrayPF[$i]</td>";
      }else{
         echo "<td>NO IMAGE</td>";
         echo "<td>$arrayIT[$i]</td>";
         echo "<td>-</td>";
         echo "<td>$arrayITM[$i]</td>";
         echo "<td>-</td>";
      }
           
      
      echo "</tr>"; 
   }
      
?>
</table>
      
<!DOCTYPE html>
<html>
    <style>
        table,tr,td{
            border: 1px solid;
        }
        tr:nth-child(2n-1){
            background-color:grey;
        }
        tr:first-child{
            background-color:white;
        }
    </style>
<body>

<?php
$info=array(array("Lun","Mar","Mie","Jue","Vie","Sab","Dom")
,8, 15);
$dias = count($info[0]);

print "<table><tr>";
print "<td></td>";
foreach($info[0] as $dia){
    print "<td>$dia</td>";
}


print "</tr>";

for($i=$info[1];$i<$info[2];$i++){
    print "<tr><td>$i:00</td>";
    for($o=0;$o<$dias;$o++){
        print "<td></td>";
    }
    print "</tr>";
}

print "</table>";
?>
</body>
</html>
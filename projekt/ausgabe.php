<table>
 <tr>
 <td> Bezeichnung</td>
 <td> Termin Beginn</td> 
 <td> Zeitanfang</td>
 <td> Termin Ende</td> 
 <td> Zeitende</td>
 <td> Priorität</td>
 <td> Beschreibung</td>
 <td> Kategorie</td>
 </tr>
<?php
include 'crud.php';
$sql = "SELECT * FROM `erste`";
$result = selectdata($sql);
if($result != "zero")
{
 
 while($row = $result->fetch_assoc())
 {
 echo "<tr>";
 echo "<td>" . $row['bezeichnung']. "</td>";
 echo "<td>" . $row['terminbeginn']. "</td>"; 
 echo "<td>" . $row['zeitanfang']. "</td>";
 echo "<td>" . $row['terminende']. "</td>";
 echo "<td>" . $row['zeitende']. "</td>";
 echo "<td>" . $row['prioritat']. "</td>";
 echo "<td>" . $row['beschreibung']. "</td>";
 echo "<td>" . $row['radiogroup']. "</td>";
 echo "</tr>";
 }
 
 
}
else
{
 echo $result;
}
?>
 </table>
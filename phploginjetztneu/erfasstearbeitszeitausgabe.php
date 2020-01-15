
	  
	
<table>
 <tr>
   <td> Arbeitszeitid</td>
  <td> Benutzerid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
   <td> Beschreibung</td>



 </tr>



	 
<?php

include 'crud.php';
$sql = "SELECT * FROM `erfasstearbeitszeit`";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['arbeitszeitid']."</td>";
 echo "<td>" . $row['benutzerid']."</td>";
 echo "<td>" . $row['beginn']. "</td>"; 
 echo "<td>" . $row['ende']. "</td>"; 
  echo "<td>" . $row['beschreibung']."</td>";
 
 


 echo "</tr>";
 }
 
 
}
else
{
 echo $result;
}

?>
 </table>
<a href="javascript:history.back()">Zurück</a></br>
	<a href="zeitberechnen.php"><i class="fa fa-tasks"></i>zeitberechnen</a>

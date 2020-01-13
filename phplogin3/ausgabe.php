
	  
	
<table>
 <tr>
  <td> Ereigniereignisid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
  <td> Bezeichnung</td>
  <td> Beschreibung</td>
   <td> Status</td>
 <td> Prioritaet</td>


 </tr>



	 
<?php

include 'crud.php';
$sql = "SELECT * FROM `ereignis`";
$result = selectdata($sql);
if($result != "zero")
{
 
  while($row = $result->fetch_assoc())
    {
		
echo "<tr>";
 echo "<td>" . $row['ereignisid']."</td>";
 echo "<td>" . $row['beginn']. "</td>"; 
 echo "<td>" . $row['ende']. "</td>"; 
  echo "<td>" . $row['bezeichnung']."</td>";
     echo "<td>" . $row['beschreibung']."</td>";
	 	  echo "<td>" . $row['status']."</td>";
  echo "<td>" . $row['prioritaet']."</td>";
	 if ($row['status']==1) {
	echo "<td><a href='insert.php?ereignisid=".$row['ereignisid']."'>insert</a></td>";
	} else { 
	echo false;}	
 echo "</tr>";
 }
 
 
}
else
{
 echo $result;
}

?>
 </table>


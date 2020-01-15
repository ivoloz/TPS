
	  
	
<table>
 <tr>
  <td> Ereignisid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
    <td> Bezeichnung</td>
	   <td> Beschreibung</td>
   <td> Status</td>
  <td> Priorität</td>


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
  if ($row['status']==1){
	 echo "<td>verfügbar</td>";
 }	 else{
	  echo "<td>zugewiesen</td>";
 }
     echo "<td>" . $row['prioritaet']."</td>";
	 if ($row['status']==1) {
	echo "<td><a href='ereigniszuweisen.php?ereignisid=".$row['ereignisid']."'>auswahl</a></td>";
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


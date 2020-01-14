
	  
	
<table>
 <tr>
  <td> Benutzerid</td>
  <td> Ereignisid</td>
 <td> Beginn</td> 
 <td> Ende</td> 
   <td> Status</td>



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
 echo "<td>" . $row['benutzerid']."</td>";
 echo "<td>" . $row['ereignisid']."</td>";
 echo "<td>" . $row['beginn']. "</td>"; 
 echo "<td>" . $row['ende']. "</td>"; 
 
  if ($row['status']==1){
	 echo "<td>verfügbar</td>";
 }	 else{
	  echo "<td>zugewiesen</td>";
 }
  echo "<td>" . $row['status']."</td>";
	 if ($row['status']==1) {
	echo "<td><a href='update2.php?ereignisid=".$row['ereignisid']."'>auswahl</a></td>";
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


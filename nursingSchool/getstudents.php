<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;
	font-weight: bold;
	font-family: arial black;
	background-color: #14BCEB;
}
.tah {
	font-weight: bold;
}
.data_td {
	background-color: #C5DFFA;
}
</style>
</head>
<body>

<?php
include "dbconnect.php";
$q = intval($_GET['q']);

$sql = "SELECT * FROM sono WHERE studentid LIKE '%$q%' ORDER BY date_added DESC";
$result = mysqli_query($dbconnect,$sql) or die(mysqli_error($dbconnect)) ;
echo "<div class='product_formlist' style='max-height:400px; overflow-y: auto;'>";
echo "<table>
<tr>
<th class='tah'>Student ID</th>
<th class='tah'>Firstname</th>
<th class='tah'>Lastname</th>
<th class='tah'>Othernames</th>
<th class='tah'>Sex</th>
<th class='tah'>Phone No</th>
<th class='tah'>Details</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td class='data_td'>" . "BUTH/SON/" . $row['studentid'] . "</td>";
	echo "<td class='data_td'>" . $row['surName'] . "</td>";
	echo "<td class='data_td'>" . $row['firstName'] . "</td>";
	echo "<td class='data_td'>" . $row['otherName'] . "</td>";
	echo "<td class='data_td'>" . $row['sex'] . "</td>";
	echo "<td class='data_td'>" . $row['phoneNo'] . "</td>";
	echo "<td class='data_td'>" . "<a href='student_details.php?student_id=".$row['studentid']."' style='font-style: normal; font-family: Adobe Heiti Std R; color: #880000'>View Details</a>" . "</td>";
	echo "</tr>";
	
}
echo "<hr><h1 style='font-family: monospace; color: #880000'>"."Results found for". " " .$q."</h1><br>";
echo "</table><br>";
echo "</div>";
mysqli_close($dbconnect);
?>
<form action="printstudents.php?query=$q" method="GET" id="jsform" target="_blank">
<input type="hidden" name="query" value="<?php echo $q; ?>">
<center><input type="button" onclick="document.getElementById('jsform').submit();" class="submit4" value="Print"></center>
</form>
</body>
</html>
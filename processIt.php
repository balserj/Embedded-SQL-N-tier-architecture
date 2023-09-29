<html>
<body>
<?php

$usersQuery = $_POST['usersQueryVariable'];
$usersQuery2 = $_POST['usersQueryVariable2'];
$userName = $_POST['userName'];
$myName = $_POST['Name'];

echo "Output after processing the queries in the form: <br><br>";

//Connect to the database server on voyager with user/pwd info
//fill user/pwd/database name please
$myUserName = "";
$myPassword = "";
$myDatabaseName = "" ;
$myHandle= mysqli_connect
    ('127.0.0.1', $myUserName, $myPassword, $myDatabaseName);

if (!$myHandle) {
   echo "Authentication Failure:    " . $myName . "    " . $userName;
   exit;
}

echo "Authentication Success:    " . $myName . "    " . $userName;
echo "<br><br>Your first query: " . $usersQuery . "<br><br>";
echo "Your second query: " . $usersQuery2 . "<br><br>";

//Run the query the user typed in the form
if (!$result = $myHandle->query($usersQuery)) {
   echo "sql error ... bail out ";
   exit;
}
if ($result->num_rows === 0) {
   echo "no tuples ... bail out ";
   exit;
}
echo "First Query is completed";



//print the tuples as a nice table
print "<table border=2><tr><th>BT<th>PD<th>AN<th>publDate\n";

while ($nextTuple = $result->fetch_assoc()) {

        print "<tr><td>" . $nextTuple ["BT"];
        print "    <td>" . $nextTuple ["PD"];
	print "    <td>" . $nextTuple ["AN"];
	print "    <td>" . $nextTuple ["DATE(publDate)"];
        print "\n";
}

print "</table>\n";

if (!$result = $myHandle->query($usersQuery2)) {
   echo "sql error ... bail out ";
   exit;
}
if ($result->num_rows === 0) {
   echo "no tuples ... bail out ";
   exit;
}

echo "<br>Second Query is completed";


print "<table border=2><tr><th>AN<th>AD<th>BT<th>publDate<th>PD\n";

while ($nextTuple = $result->fetch_assoc()) {
	if(!$nextTuple ["AN"])
	{
		print "<tr><td> NULL";
	}
	else
		print "<tr><td>" . $nextTuple ["AN"];

	if(!$nextTuple ["AD"])
	{
		print "<td> NULL";
	}
	else
        	print "    <td>" . $nextTuple ["AD"];

	if(!$nextTuple ["BT"])
	{
		print "<td> NULL";
	}
	else
		print "    <td>" . $nextTuple ["BT"];
       		
	if(!$nextTuple ["publDate"])
	{
		print "<td> NULL";
	}
	else
		print "    <td>" . $nextTuple ["publDate"];

	if(!$nextTuple ["PD"])
	{
		print "<td> NULL";
	}
	else
		print "    <td>" . $nextTuple ["PD"];

        print "\n";
}

print "</table>\n";


print "<xmp>\n";
$printMyFileAsIs = file_get_contents('form.php');
        echo $printMyFileAsIs;
echo "\n\n";
$printMyFileAsIs2 = file_get_contents('processIt.php');
        echo $printMyFileAsIs2;



?>

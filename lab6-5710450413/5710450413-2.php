<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
echo "JOIN ข้อ 22 รหัสลูกค้า ชื่อและนามสกุุลลูกค้า ว่าไปดูอสังหาวันไหนบ้าง และอสังหาอยู่ที่เมืองใด";
echo "<table style='border: solid 1px black;'>";

echo "<tr><th>Client no.</th><th>Firstname</th><th>Lastname</th><th>View date</th><th>City</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreamhome";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT client.clientno,client.fname,client.lname,viewing.viewdate,propertyforrent.city  FROM client INNER JOIN viewing ON (client.clientno = viewing.clientno) INNER JOIN propertyforrent ON (viewing.propertyno = propertyforrent.propertyno) " ); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php


/*
1er script en php para probar creación de código

*/
//$html = htmlspecialchars($utf8_string, ENT_COMPAT, 'UTF-8')

$servername = "localhost";
$username = "";
$password = "";
$dbname = "ExactoLab";
$charset = "utf8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn , $charset );
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT PK_ITEM, I_DESCRIPCION FROM show_servicios";
$result = $conn->query($sql);
echo("<table><tr><td>ID</td><td>Nombre</td></tr>");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["PK_ITEM"]. "</td><td>" . $row["I_DESCRIPCION"]. "</td></tr>";
    }
} else {
    echo "0 results";
}
echo("</table");
$conn->close();
?>
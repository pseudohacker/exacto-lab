<?php


/*
1er script en php para probar creación de código

*/
//$html = htmlspecialchars($utf8_string, ENT_COMPAT, 'UTF-8')

$servername = "localhost";
$username = "reader";
$password = "";
$dbname = "exactolab";
$charset = "utf8";
$filter = $_POST["name"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn , $charset );
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT
	A.`PK_ITEM`,
	A.`I_DESCRIPCION`,
	B.`CAT_DESCRIPCION`,
	LEFT(A.`I_TIEMPO_RESULTADO`,(char_length(A.`I_TIEMPO_RESULTADO`) - 1)) AS `TIEMPO_PROC`,
	C.`TU_DESCRIPCION`,
	D.`PK_PRECIO`,
	D.`PP_NOMBRE`,
	D.`PP_PRECIO`
FROM
		`lista_servicios` A, `servicios_categoria` B, `tiempo_unidad` C, `precios` D
WHERE
		A.`I_CATEGORIA`= B.`PK_CAT` AND
		RIGHT(A.`I_TIEMPO_RESULTADO`,1) = C.`PK_TU` AND
		A.`PK_ITEM` = D.`FK_ITEM` AND 
		D.`PP_NOMBRE`='".$filter."' ORDER BY B.`CAT_DESCRIPCION`, A.`I_DESCRIPCION`";
$result = $conn->query($sql);
echo("<table><tr><td>ID</td><td>Nombre</td><td>Precio</td></tr>");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["PK_ITEM"]. "</td><td>" . $row["I_DESCRIPCION"]. "</td><td>" . $row["PP_PRECIO"]. "</td></tr>";
    }
} else {
    echo "0 results";
}
echo("</table");
$conn->close();
?>
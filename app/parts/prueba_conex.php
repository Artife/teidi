<?php
$servername = "db694966402.db.1and1.com";
$username = "dbo694966402";
$password = "InterNauta1954_*";
$dbname = "db694966402";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `gx_alimentos` LEFT JOIN gx_alimentos_desactivados ON gx_alimentos.id_alimento = gx_alimentos_desactivados.id_alimento WHERE gx_alimentos.id_usuario IS NULL AND gx_alimentos_desactivados.fecha IS NULL OR gx_alimentos.id_usuario = '736' AND gx_alimentos_desactivados.fecha IS NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id_alimento"]."</td><td>".$row["nombre"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password, 'farm');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$cone=$conn;

/*insertar datos
$sql = "INSERT INTO `cliente` ( `nombre`, `apellido`, `telefono`, `direccion`, `correo`, `fechaNac`) VALUES ('Ricardo', 'Perez', '52819696', 'guate', 'elum', '2020-10-22 10:46:00')";

			if ($conn->query($sql) === TRUE) {
			//echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
      $cone->close();
      
      
      obtener datos
$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
      */
?>
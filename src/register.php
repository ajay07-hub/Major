<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

// Insert user into database
$sql = "INSERT INTO users_table (name, email, password) VALUES ('$name', '$email', '$password')";
if (mysqli_query($conn, $sql)) {
  echo "User registered successfully!";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>

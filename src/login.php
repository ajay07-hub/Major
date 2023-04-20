<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Connect to MySQL
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "users_db";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL statement
  $stmt = $conn->prepare("SELECT id, name, email, password FROM users_table WHERE email = ?");
  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  // Set the value of the parameter
  $email = $_POST["email"];

  // Bind the parameter
  if (!$stmt->bind_param("s", $email)) {
    die("Binding parameters failed: " . $stmt->error);
  }

  // Execute the statement
  if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
  }

  // Bind the result variables
  if (!$stmt->bind_result($id, $name, $email, $hashed_password)) {
    die("Binding result variables failed: " . $stmt->error);
  }

  // Fetch the result
  if ($stmt->fetch()) {
    // Verify the password
    if (password_verify($_POST["password"], $hashed_password)) {
      // Start the session and set the session variables
      session_start();
      $_SESSION["id"] = $id;
      $_SESSION["name"] = $name;
      $_SESSION["email"] = $email;

      // Redirect to the main page
      header("Location: index.html");
      exit();
    } else {
      // Invalid password
      echo "Invalid email or password.";
    }
  } else {
    // User not found
    echo "Invalid email or password.";
  }

  $stmt->close();
  $conn->close();
}
?>

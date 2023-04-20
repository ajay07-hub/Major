<?php
  $name = $_POST['name'];
    $email = $_POST['email'];
    $pofo = $_POST['pofo'];
    $resumeurl = $_POST['resumeurl'];
    $coverletter = $_POST['coverletter'];
    

  // Database connection
  $conn = new mysqli('localhost','root','','jobapp');
  if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
  } 
  else {
    $stmt = $conn->prepare("insert into jobapp(name, email, pofo, resumeurl, coverletter) values( ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $pofo, $resumeurl, $coverletter);
    $execval = $stmt->execute();
    echo $execval;
    echo "Registration successfully...";
    $stmt->close();
    $conn->close();
  }
?>
<?php 
$username = "root"; 
$password = ""; 
$database = "task_3"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 

$query = "SELECT * FROM email_subscription";


echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Email address</font> </td> 
          <td> <font face="Arial">TOS</font> </td> 
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $email = $row["email"];
        $terms = $row["terms"];

        echo '<tr> 
                  <td>'.$email.'</td> 
                  <td>'.$terms.'</td> 
              </tr>';
    }
    $result->free();
} 
?>
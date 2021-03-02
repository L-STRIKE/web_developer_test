<?php
// $email = $_POST['email'];
// $terms = $_POST['terms'];

$email = filter_input(INPUT_POST, 'email');
$terms = filter_input(INPUT_POST, 'terms');

$domain = substr($email, -1);

if (empty($email)) {
    $email_error = "Email address is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_error =  "Please provide a valid e-mail address";
  } elseif ($domain == '.co') {
    $email_error =  "We are not accepting subscriptions from
    Colombia emails";
}


if (empty($terms)) {
    $terms_error = "You must accept the terms and conditions";
}


if (!empty($email) || !empty($terms)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "task_3";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From email_subscription Where email = ? Limit 1";
        $INSERT = "INSERT Into email_subscription (email, terms) values(?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("si", $email, $terms);
            $stmt->execute();
            echo "New record inserted successfully";
        } else {
            echo "Someone already registered using this email";
        }
        $stmt->close();
        $conn->close();
    }

    include('successMsg.php');

} else {
    include('index.php');
    echo "Fill out the form!";
    die();
}

?>


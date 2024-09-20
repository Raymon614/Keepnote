<?php
session_start();
include ('conn/conn.php');
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM register WHERE email = :email AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $count = $stmt->rowCount();

    if ($count > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['alogin'] = $row['user_ID'];
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        }

    } else {
        $message = "Invalid Details! Account not found.";
    }
}
?>

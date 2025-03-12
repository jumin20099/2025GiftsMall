<?php
session_start();

$conn = new mysqli("localhost", "root", "", "giftsmall");
if ($conn->connect_error) exit("DB 연결 실패ㅅㄱ");

$username = $_POST['username'];
$password_input = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];

$salt = bin2hex(random_bytes(16));

$hashed_password = hash('sha256', $password_input . $salt);

$sql = "INSERT INTO users (username, hashed_password, salt, name, email) VALUES ('$username', '$hashed_password', '$salt', '$name', '$email')";
if ($conn->query($sql)) {
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'user';
    header("Location: ./index.html");
    exit;
} else {
    exit("회원가입 실패");
}
?>

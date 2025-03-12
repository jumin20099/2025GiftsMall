<?php
session_start();

$conn = new mysqli("localhost", "root", "", "giftsmall");
if ($conn->connect_error) {
    exit("DB 연결 실패ㅅㄱ");
}

if (!isset($_POST['username'], $_POST['password'])) {
    exit("이상한 방법으로 들어오지 마세요");
}

$username = $_POST['username'];
$password_input = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE username = '$username'");
if ($result->num_rows !== 1) {
    exit("username 다름 ㅅㄱ");
}

$row = $result->fetch_assoc();
$input_hash = hash('sha256', $password_input . $row['salt']);

if ($input_hash !== $row['hashed_password']) {
    exit("비번 틀림 ㅅㄱ");
}

$_SESSION['user_id'] = $row['user_id'];
$_SESSION['username'] = $row['username'];
$_SESSION['role'] = $row['role'];
header("Location: ./index.html");
exit;
?>
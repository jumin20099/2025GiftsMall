<?php
$conn = new mysqli("localhost", "root", "", "giftsmall");
if ($conn->connect_error) {
    exit("DB 연결 실패ㅅㄱ");
}

session_start();

$request = $_SERVER['REQUEST_URI'];
$path = explode("?", $request);
$path[1] = isset($path[1]) ? $path[1] : null;
$resource = explode("/", $path[0]);
$pages = "";

include("./components/header.php");

switch ($resource[1]) {
    case '':
        $pages = './pages/index.php';
        break;
    case 'allProduct':
        $pages = './pages/allProducts.php';
        break;
    case 'cart':
        $pages = './pages/cart.php';
        break;
    case 'introduction':
        $pages = './pages/introduction.php';
        break;
    case 'login':
        $pages = './pages/login.php';
        break;
    case 'signup':
        $pages = './pages/signup.php';
        break;

    default:
        echo "ㄴㄴ";
        exit;
}
include("./components/footer.php");
include($pages);
?>
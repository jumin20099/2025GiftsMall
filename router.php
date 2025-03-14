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


switch ($resource[1]) {
    case 'main':
        $pages = './pages/index.php';
        break;
    case 'allProducts':
        $pages = './pages/allProducts.php';
        break;
    case 'popularProducts':
        $pages = './pages/popularProducts.php';
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
    case 'signupProcess':
        $pages = './pages/signup_process.php';
        break;
    case 'loginProcess':
        $pages = './pages/login_process.php';
        break;
    case 'manageNotice':
        $pages = './pages/manageNotice.php';
        break;
    case 'manageProducts':
        $pages = './pages/manageProducts.php';
        break;

    default:
        echo "ㄴㄴ";
        exit;
}
include("./components/header.php");
include($pages);
include("./components/footer.php");

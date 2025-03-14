<?php
$conn = new mysqli("localhost", "root", "", "giftsmall");
if ($conn->connect_error) {
    exit("DB 연결 실패");
}

session_start();

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base_path = str_replace('/router.php', '', $request_uri);
$route = trim($base_path, '/');

// URL에 ?가 포함된 경우 page 값 추출
if (!empty($_SERVER['QUERY_STRING'])) {
    parse_str($_SERVER['QUERY_STRING'], $query_params);
    if (isset($query_params['page'])) {
        $route = $query_params['page'];
    }
}


$pages = "";

switch ($route) {
    case '':
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
    case 'manageProducts':
        $pages = './pages/manageProducts.php';
        break;
    case 'manageNotice':
        $pages = './pages/manageNotice.php';
        break;
    case 'logout':
        $pages = './pages/logout.php';
        break;
    default:
        echo "잘못된 경로입니다.";
        exit;
}

include("./components/header.php");
include($pages);
include("./components/footer.php");

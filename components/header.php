<?php
// session_start();

$is_admin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gifts Mall</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../images/GIFTS Mall Logo.PNG" alt="헤더 로고">
        </div>
        <ul class="nav">
            <li><a href="/main">HOME</a></li>
            <li><a href="introduction">소개</a></li>
            <li class="dropdown">
                <a href="allProducts">판매상품</a>
                <ul class="hidden-headers">
                    <li><a href="allProducts">전체상품</a></li>
                    <li><a href="popularProducts">인기상품</a></li>
                </ul>
            </li>
            <li><a href="#">가맹점</a></li>
            <li><a href="cart">장바구니</a></li>
            <?php if ($is_admin): ?>
            <li class="dropdown">
                <a href="#">관리자</a>
                <ul class="hidden-headers">
                    <li><a href="notice_manage.php">공지사항관리</a></li>
                    <li><a href="product_manage.php">판매상품관리</a></li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
        <div class="util-menu">
            <?php if ($is_admin): ?>
                <a href="logout.php">로그아웃</a>
            <?php else: ?>
                <a href="login">로그인</a>
                <a href="signup">회원가입</a>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>

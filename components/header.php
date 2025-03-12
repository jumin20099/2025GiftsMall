<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header>
        <div class="logo"><img src="../images/GIFTS Mall Logo.PNG" alt="헤더 로고"></div>
        <ul class="nav">
            <li><a href="../pages/index.php">HOME</a></li>
            <li><a href="../pages/introduction.php">소개</a></li>
            <li class="dropdown">
                <a href="../pages/allProducts.php">판매상품</a>
                <ul class="hidden-headers">
                    <li><a href="../pages/allProducts.php">전체상품</a></li>
                    <li><a href="../pages/popularProducts.php">인기상품</a></li>
                </ul>
            </li>
            <li><a href="#">가맹점</a></li>
            <li><a href="../pages/cart.php">장바구니</a></li>
        </ul>
        <div class="util-menu">
            <a href="./login.php">로그인</a>
            <a href="./signup.php">회원가입</a>
            <a href="#">관리자</a>
        </div>
    </header>
</body>

</html>
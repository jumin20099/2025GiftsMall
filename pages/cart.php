<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>GIFTS:Mall - Shopping Cart</title>
</head>

<body>
    <div id="cart-container">
        <table>
            <thead>
                <tr>
                    <th>상품사진</th>
                    <th>상품명</th>
                    <th>수량 조절</th>
                    <th>단가</th>
                    <th>총액</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="../선수제공파일/A-Module/images/향수/5.PNG" alt="상품사진" style="width: 80px;"></td>
                    <td>향수</td>
                    <td>
                        <input type="number" class="quantity-input" value="1" readonly>
                    </td>
                    <td>10,000원</td>
                    <td>10,000원</td>
                </tr>
                <tr>
                    <td><img src="../선수제공파일/A-Module/images/팬시/5.PNG" alt="상품사진" style="width: 80px;"></td>
                    <td>스피커</td>
                    <td>
                        <input type="number" class="quantity-input" value="2" readonly>
                    </td>
                    <td>20,000원</td>
                    <td>40,000원</td>
                </tr>
            </tbody>
        </table>
        <div class="total">전체 결제금액: ₩50,000</div>
        <button class="purchase-button">구매하기</button>
    </div>
</body>

</html>
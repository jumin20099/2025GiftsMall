<?php
$conn = new mysqli("localhost", "root", "", "giftsmall");
if ($conn->connect_error) exit("DB 연결 실패");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $category_id = $_POST['category_id'];
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $price = $_POST['price'];
        $product_image = $_POST['product_image'];
        $registration_time = date('Y-m-d H:i:s');

        if (empty($category_id) || empty($product_name) || empty($product_description) || empty($price) || empty($product_image)) {
            echo "<script>alert('모든 정보를 입력하세요.'); history.back();</script>";
            exit;
        }

        $sql = "INSERT INTO products (category_id, product_name, product_description, price, product_image, registration_time) 
                VALUES ('$category_id', '$product_name', '$product_description', '$price', '$product_image', '$registration_time')";
        $conn->query($sql);
    } elseif ($action == 'edit') {
        $id = $_POST['id'];
        $category_id = $_POST['category_id'];
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $price = $_POST['price'];
        $product_image = $_POST['product_image'];
        $registration_time = date('Y-m-d H:i:s');

        if (empty($category_id) || empty($product_name) || empty($product_description) || empty($price) || empty($product_image)) {
            echo "<script>alert('모든 정보를 입력하세요.'); history.back();</script>";
            exit;
        }

        $sql = "UPDATE products SET 
                category_id='$category_id', 
                product_name='$product_name', 
                product_description='$product_description', 
                price='$price', 
                product_image='$product_image', 
                registration_time='$registration_time' 
                WHERE product_id=$id";
        $conn->query($sql);
    } elseif ($action == 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM products WHERE product_id=$id";
        $conn->query($sql);
    }
    header("Location: manageNotice");
    exit;
}

$order = isset($_GET['order']) && strtolower($_GET['order']) == 'asc' ? 'ASC' : 'DESC';
$sql = "SELECT * FROM products ORDER BY registration_time $order";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>GIFTS:Mall - Manage Products</title>
</head>

<body>
    <div class="container mt-5" style="padding-top: 100px;">
        <h2>판매상품 관리</h2>

        <form method="POST" class="mb-3">
            <input type="hidden" name="action" value="add">
            <input type="text" name="category_id" placeholder="카테고리" required>
            <input type="text" name="product_name" placeholder="상품명" required>
            <input type="text" name="product_description" placeholder="설명" required>
            <input type="number" name="price" placeholder="가격" required>
            <input type="text" name="product_image" placeholder="이미지 URL" required>
            <button type="submit" class="btn btn-success">추가</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>카테고리</th>
                    <th>상품명</th>
                    <th>설명</th>
                    <th>가격</th>
                    <th>등록시간</th>
                    <th>관리</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['category_id']) ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td><?= htmlspecialchars($row['product_description']) ?></td>
                        <td><?= number_format($row['price']) ?>원</td>
                        <td><?= $row['registration_time'] ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $row['product_id'] ?>">
                                <button type="submit" class="btn btn-danger">삭제</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
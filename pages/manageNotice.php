<?php
$conn = new mysqli("localhost", "root", "", "giftsmall");
if ($conn->connect_error) exit("DB 연결 실패");

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == 'add') {
        // 공지 추가
        $notice_type = $_POST['notice_type'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $posted_at = $_POST['posted_at'];
        $sql = "INSERT INTO notices (notice_type, title, content, posted_at) VALUES ('$notice_type', '$title', '$content', '$posted_at')";
        $conn->query($sql);
    } elseif ($action == 'edit') {
        // 공지 수정
        $notice_id = $_POST['notice_id'];
        $notice_type = $_POST['notice_type'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $posted_at = $_POST['posted_at'];
        $sql = "UPDATE notices SET notice_type='$notice_type', title='$title', content='$content', posted_at='$posted_at' WHERE notice_id=$notice_id";
        $conn->query($sql);
    } elseif ($action == 'delete') {
        // 공지 삭제
        $notice_id = $_POST['notice_id'];
        $sql = "DELETE FROM notices WHERE notice_id=$notice_id";
        $conn->query($sql);
    }
    // 중복 전송 방지
    header("Location: " . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
    exit;
}

$per_page = 6;  // 한 페이지당 공지 개수
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

$order = (isset($_GET['order']) && strtolower($_GET['order']) == 'asc') ? 'ASC' : 'DESC';

$filter = (isset($_GET['notice_type']) && in_array($_GET['notice_type'], ['일반', '이벤트'])) ? $_GET['notice_type'] : '';
$where = $filter ? "WHERE notice_type = '$filter'" : '';

// 공지사항 목록 조회
$sql = "SELECT * FROM notices $where ORDER BY posted_at $order LIMIT $per_page OFFSET $offset";
$result = $conn->query($sql);

// 전체 공지 갯수 조회 (페이지네이션용)
$count_sql = "SELECT COUNT(*) as total FROM notices $where";
$total_result = $conn->query($count_sql);
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $per_page);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIFTS:Mall - Manage Notice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5" style="padding-top: 120px;">
        <h2>공지사항 관리</h2>

        <!-- 공지 추가 폼 -->
        <div class="mb-4">
            <h4>공지 추가</h4>
            <form method="POST" class="form-inline">
                <input type="hidden" name="action" value="add">
                <div class="form-group mr-2">
                    <label for="addNoticeType" class="mr-2">유형</label>
                    <select name="notice_type" id="addNoticeType" class="form-control">
                        <option value="일반">일반</option>
                        <option value="이벤트">이벤트</option>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label for="addTitle" class="mr-2">제목</label>
                    <input type="text" name="title" id="addTitle" class="form-control" required>
                </div>
                <div class="form-group mr-2">
                    <label for="addContent" class="mr-2">내용</label>
                    <input type="text" name="content" id="addContent" class="form-control" required>
                </div>
                <div class="form-group mr-2">
                    <label for="addDate" class="mr-2">공지일자</label>
                    <input type="date" name="posted_at" id="addDate" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">추가</button>
            </form>
        </div>

        <!-- 필터 -->
        <div class="mb-3">
            <form method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <label for="filterNoticeType" class="mr-2">유형</label>
                    <select name="notice_type" id="filterNoticeType" class="form-control">
                        <option value="">전체</option>
                        <option value="일반" <?= $filter == '일반' ? 'selected' : '' ?>>일반</option>
                        <option value="이벤트" <?= $filter == '이벤트' ? 'selected' : '' ?>>이벤트</option>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label class="mr-2">정렬</label>
                    <select name="order" class="form-control">
                        <option value="desc" <?= $order == 'DESC' ? 'selected' : '' ?>>내림차순</option>
                        <option value="asc" <?= $order == 'ASC' ? 'selected' : '' ?>>오름차순</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">적용</button>
            </form>
        </div>

        <!-- 공지사항 목록 테이블 -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>유형</th>
                    <th>제목</th>
                    <th>내용</th>
                    <th>공지일자</th>
                    <th>관리</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['notice_type']) ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['content']) ?></td>
                        <td><?= $row['posted_at'] ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $row['notice_id'] ?>">수정</button>
                            <!-- 삭제 폼 -->
                            <form method="POST" style="display:inline-block;" onsubmit="return confirm('삭제하시겠습니까?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="notice_id" value="<?= $row['notice_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                            </form>
                        </td>
                    </tr>
                    <!-- 수정 모달 -->
                    <div class="modal fade" id="editModal<?= $row['notice_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row['notice_id'] ?>" aria-hidden="true" style="padding-top: 400px;">
                        <div class="modal-dialog" role="document">
                            <form method="POST">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="notice_id" value="<?= $row['notice_id'] ?>">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?= $row['notice_id'] ?>">공지 수정</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="닫기">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editNoticeType<?= $row['notice_id'] ?>">유형</label>
                                            <select name="notice_type" id="editNoticeType<?= $row['notice_id'] ?>" class="form-control">
                                                <option value="일반" <?= $row['notice_type'] == '일반' ? 'selected' : '' ?>>일반</option>
                                                <option value="이벤트" <?= $row['notice_type'] == '이벤트' ? 'selected' : '' ?>>이벤트</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editTitle<?= $row['notice_id'] ?>">제목</label>
                                            <input type="text" name="title" id="editTitle<?= $row['notice_id'] ?>" class="form-control" value="<?= htmlspecialchars($row['title']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editContent<?= $row['notice_id'] ?>">내용</label>
                                            <input type="text" name="content" id="editContent<?= $row['notice_id'] ?>" class="form-control" value="<?= htmlspecialchars($row['content']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDate<?= $row['notice_id'] ?>">공지일자</label>
                                            <input type="date" name="posted_at" id="editDate<?= $row['notice_id'] ?>" class="form-control" value="<?= $row['posted_at'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">수정 완료</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- 페이지네이션 -->
        <nav>
            <ul class="pagination">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>&order=<?= strtolower($order) ?>&notice_type=<?= $filter ?>">«</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&order=<?= strtolower($order) ?>&notice_type=<?= $filter ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>&order=<?= strtolower($order) ?>&notice_type=<?= $filter ?>">»</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
$conn->close();
?>

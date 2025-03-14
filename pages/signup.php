<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gifts Mall : Signup</title>
</head>

<body>
    <div class="container text-center mt-5">
        <h1>회원가입</h1>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#signupModal">
            회원가입
        </button>
    </div>
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true" style="padding-top: 400px;">
        <div class="modal-dialog" role="document">
            <form action="signupProcess" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="signupModalLabel">회원가입</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="닫기">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="signupUsername">아이디</label>
                            <input type="text" class="form-control" id="signupUsername" name="username" placeholder="아이디 입력" required>
                        </div>
                        <div class="form-group">
                            <label for="signupPassword">비밀번호</label>
                            <input type="password" class="form-control" id="signupPassword" name="password" placeholder="비밀번호 입력" required>
                        </div>
                        <div class="form-group">
                            <label for="signupName">이름</label>
                            <input type="text" class="form-control" id="signupName" name="name" placeholder="이름 입력" required>
                        </div>
                        <div class="form-group">
                            <label for="signupEmail">이메일</label>
                            <input type="email" class="form-control" id="signupEmail" name="email" placeholder="이메일 입력" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">회원가입</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
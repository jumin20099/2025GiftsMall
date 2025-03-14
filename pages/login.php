<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>로그인 & 회원가입</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container text-center mt-5">
    <h1>로그인</h1>
    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#loginModal">
      로그인
    </button>
    <br>
    <a href="signup">아직 가입하지 않으셨나요?</a>
  </div>

  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="loginProcess" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">로그인</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="닫기">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="loginUsername">아이디</label>
              <input type="text" class="form-control" id="loginUsername" name="username" placeholder="아이디 입력" required>
            </div>
            <div class="form-group">
              <label for="loginPassword">비밀번호</label>
              <input type="password" class="form-control" id="loginPassword" name="password" placeholder="비밀번호 입력" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">로그인</button>
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

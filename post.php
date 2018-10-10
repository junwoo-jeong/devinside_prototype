<!--
  * post page
  * @Author Jeong Junwoo
  구현 기능
  1. 스마트 마크다운 에디터(toast ui editor)
  2. 글을 작성한 user가 접근시 수정, 삭제 버튼 동적으로 생성
  3. 방문기록을 바탕으로 조회수 증가(여러번 증가 방지)
-->
<?php
  session_start();
  require('./database/postDAO.php');

  $user = $_SESSION['user'] ?? false;
  $db = new PostDAO();
  
  if(!$user) {  // 유저는 글을 볼 수 없음
    header('Location: /main.php');
    exit();
  }

  
  if(!in_array($_GET['num'], $_SESSION['visited'])){
    // 현재 방문 포스트가 방문 기록에 포함되어 있지 않으면 방문 기록에 추가하고 조회수 증가
    $_SESSION['visited'][] = $_GET['num'];
    $db->incrementPostHit($_GET['num']);
  }

  $post = $db->getPostById($_GET['num']);

  
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>devin - <?= $post['title'] ?></title>

    <script src="./public/js/userButton.js"></script>
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/tui-code-snippet/dist/tui-code-snippet.js"></script>
    <script src="bower_components/markdown-it/dist/markdown-it.js"></script>
    <script src="bower_components/to-mark/dist/to-mark.js"></script>
    <script src="bower_components/codemirror/lib/codemirror.js"></script>
    <script src="bower_components/highlightjs/highlight.pack.js"></script>
    <script src="bower_components/squire-rte/build/squire-raw.js"></script>
    <script src="bower_components/tui-editor/dist/tui-editor-Editor.min.js"></script>
    <link rel="stylesheet" href="bower_components/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="bower_components/highlightjs/styles/github.css">
    <link rel="stylesheet" href="bower_components/tui-editor/dist/tui-editor.css">
    <link rel="stylesheet" href="bower_components/tui-editor/dist/tui-editor-contents.css">
    <link rel="stylesheet" href="./public/css/layout.css">
    <link rel="stylesheet" href="./public/css/tools/button.css">
    <link rel="stylesheet" href="./public/css/post.css">
    <link rel="stylesheet" href="./public/css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>  
  <body>
    <div class="postTamplate">
      <div class="headerSection">
        <div class="headerMenu">
          <a href="/main.php" class="logo">devinside</a>
          <div class="right">
            <?php
              if($user){
                echo '<div class="userButton" onclick="userButton()">
                <div class="thumbnail">
                  <img src="' . $user['thumbnail_img'] . '" alt="thumbnail" />
                </div>
              </div>';
              }else {
                echo '<a href="/signinpage.php" class="button outline">로그인</a>';
              }
            ?>
            <div class="user-menu-wrapper" style="display: none;">
              <div class="user-menu-positioner">
                <div class="rotated-square"></div>
                <div class="user-menu">
                  <div class="menu-items">
                    <a class="user-menu-item" href="/#">내 벨로그</a>
                    <div class="separator"></div>
                    <a class="user-menu-item" href="/write.php">새 글 작성</a>
                    <a class="user-menu-item" href="/#">임시 글</a>
                    <div class="separator"></div>
                    <a class="user-menu-item" href="/settings">설정</a>
                    <a class="user-menu-item" href="/controller/auth/logout.php">로그아웃</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="postSection">
        <div class="postHead">
          <div class="userInfo">
            <a href="/#" class="user-thumbnail">
              <img src="<?= $user['thumbnail_img'] ?>" alt="thumbnail" />
            </a>
            <div class="info">
              <a href="#" class="username"><?= $user['nickname'] ?></a>
              <div class="description">asdasdasd</div>
            </div>
          </div>
          <h1><?= $post['title'] ?></h1>
          <div class="date-and-likes">
            <div class="date"><?= $post['create_at'] ?></div>
            <div class="placeholder"></div>
            <div class="date">조회수 : <?= $post['hit'] ?></div>
          </div>
          <div class="separator"></div>
          <?php
            if($user['nickname'] == $post['author']) {
              echo '<div class="postAction">
              <a class="btn" href="/write.php?action=modify&num=' . $post['id'] . '">수정</a>
              <a class="btn" href="/controller/post/postDelete.php?num=' . $post['id'] . '">삭제</a>
            </div>';
            }
          ?>
        </div>
        <div id="editSection"></div>
        <div class="tagSection">태그 섹션</div>
        <div class="commentSection">코멘트 섹션</div>
      </div>
    </div>
  <script src="public/js/post.js"></script>
  <script>
    var content = <?php echo json_encode($post["content"]); ?>;
    editor.setValue(content);
  </script>
  </body>
</html>

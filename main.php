<!--
  * main page
  * @Author Jeong Junwoo
  구현 기능
  1. 정렬 기준을 선택하면 그 기준에 따른 post list를 동적으로 렌더링
  2. 비로그인 유져는 post List는 볼 수 있지만 상세 글을 볼 수 없음(자동으로 redirection)
  3. 로그인 상태를 바탕으로 상단 메뉴바 동적 렌더링
-->

<?php
  session_start();
  require_once('./components/postCardListTemplate.php');
  // 아무런 메뉴를 선택하지 않았을시 tranding으로 자동 선택
  $user = $_SESSION['user'] ?? false; 
  $sorting = $_REQUEST["sorting"] ?? 'tranding';
  //if(!$user) header('Location: /landingpage.php'); 활성화시 비로그인 유저 main 페이지 접근 불가
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="./public/js/userButton.js"></script>
  <link rel="stylesheet" href="./public/css/layout.css">
  <link rel="stylesheet" href="./public/css/main.css">
  <link rel="stylesheet" href="./public/css/tools/button.css">
  <link rel="stylesheet" href="./public/css/components/postCard.css">
  <link rel="stylesheet" href="./public/css/components/postCardList.css">
  <link rel="stylesheet" href="./public/css/components/postCardListTemplate.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <div class="mainTemplate">
      <aside class="mainSidebar">
        <a class="logo" href="?sorting=tranding">
          junwoo
          <div class="badge">blog</div>
        </a>
        <ul class="menu">
          <li class="menuItem <?= tranding==$sorting ? "active" : "" ?>" onclick="menuItemClicked(event)">
            <a href="?sorting=tranding">
              <i class="material-icons">
                trending_up
              </i>
              <div class="text">
                트렌딩
              </div>
            </a>
          </li>
          <li class="menuItem <?= recent==$sorting ? "active" : "" ?>" onclick="menuItemClicked(event)">
            <a href="?sorting=recent">
              <i class="material-icons">
                update
              </i>
              <div class="text">
                최신 포스트
              </div>
            </a>
          </li>
          <li class="menuItem <?= tag==$sorting ? "active" : "" ?>" onclick="menuItemClicked(event)">
            <a href="?sorting=tag">
              <i class="material-icons">
                label
              </i>
              <div class="text">
                태그
              </div>
            </a>
          </li>
        </ul>
      </aside>
      <div class="mainHead">
        <div class="button-area">
          <?php 
            if($user) echo '<a href="/write.php?action=upload" class="button default">새 포스트 작성</a>'; 
          ?>
        </div>
        <div class="spacer"></div>
        <div class="rignt-area">
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
                  <a class="user-menu-item" href="/write.php?action=upload">새 글 작성</a>
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
      <div>
        <!-- 정렬된 postList 출력 -->
        <?= create__PostCardListTemplate($sorting); ?>
      </div>
    </div>
  </div>
</body>
</html>
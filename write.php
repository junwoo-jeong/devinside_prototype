<!--
  * write page
  * @Author Jeong Junwoo
  구현 기능
  1. 스마트 마크다운 에디터 적용(toast ui editor)
  2. 이미지 삽입 기능에 서버 업로딩 기능 추가(ajax)
  3. action에 따라 수정/작성 구분
  4. form 테그를 활용할 수 없기 떄문에 ajax통신 활용
-->
<?php
  session_start();
  require('./database/postDAO.php');
  $action = $_GET['action'] ?? false;
  $id = $_GET['num'] ?? false;

  if(!$action) {
    exit();
    header('Location: /main.php');
  }
  
  // action에 따라 스행사항 분기 적용
  switch($action) {
    case 'upload' : 
      break;
    case 'modify' :
      $db = new PostDAO();
      $post = $db->getPostById($id);
      break;
    default :
      exit();
      header('Location: /main.php');
      break;
  }
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>DEMO</title>
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
    <link rel="stylesheet" href="/public/css/write.css">
    <link rel="stylesheet" href="/public/css/layout.css">
    <link rel="stylesheet" href="./public/css/tools/button.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>    

<body>
  <form class="write_form">
    <div class="title_section">
      <a href="main.php"><i class="material-icons" style="font-size: 28px;">arrow_back</i></a>
      <div class="title">
          <input type="text" id="title_text" value="<?= $post['title']??'' ?>" name="title" placeholder="제목을 입력하세요.">
      </div>
      <div class="button default" onclick="<?=$action=='upload' ? 'submit()' : 'modify()' ?>">작성하기</div>
    </div>
    <div id="editSection"></div>
  </form>
  <script src="/public/js/write.js"></script>
  <script>
    // 데이터가 있으면 에디터에 해당 데이터 삽입
    editor.setValue(editor.convertor.toMarkdown(`<?= $post['content']??'' ?>`));
    
    document.state = {
      'post_id': <?= $post['id'] ?>
    };
  </script>
</body>
</html>
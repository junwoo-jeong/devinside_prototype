<?php
   /**
    * 포스트카드 html 생성.
    * @Author Jeong Junwoo
    * @param {array} post - post data.
    * Return HTML TAG
    */
  function create__PostCard($post) {
    // html로 저장되어 있는 포스트를 단순 문자열로 치환(description 용도)    
    $post['content'] = preg_replace('/(<script(\s|\S)*?<\/script>)|(<style(\s|\S)*?<\/style>)|(<!--(\s|\S)*?-->)|(<\/?(\s|\S)*?>)/', "", $post['content']);
?>
<div class="PostCard">
  <a class="thumbnail-wrapper" href="/post.php?num=<?= $post['id'] ?>">
    <img src="<?= $post['thumbnail_img']; ?>"
      alt="<?= $post['title']; ?>">
    <div class="white-mask"></div>
  </a>
  <div class="card-content">
    <a class="user-thumbnail-wrapper" href="/@ppp3195">
      <img src="<?= $post['user_thumbnail_img']; ?>"
        alt="ppp3195">
    </a>
    <div class="content-head">
      <a class="username" href="/@ppp3195"><?= $post['author']; ?></a>
      <h3>
        <a href="/post.php?num=<?= $post['id'] ?>">
          <?= $post['title']; ?>
        </a>
      </h3>
      <div class="subinfo">
        <span>
          <?= $post['create_at']; ?>
        </span>
        <span>
          5개의 댓글
        </span>
        <span>
        조회수 : <?= $post['hit']; ?>
        </span>
      </div>
    </div>
    <div class="description" style="-webkit-box-orient: vertical;"><?= $post['content']; ?></div>
  </div>
</div>
<?php
  }
?>
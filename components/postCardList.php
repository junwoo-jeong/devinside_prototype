<?php
  /**
    * 포스트 리스트 생성.
    * @Author Jeong Junwoo
    * @param {string} sorting - sorting될 기준(tranding, recent, tag).
    * @Return HTML TAG
    * @called create__PostCard($post)
    */
  function create__PostCardList($sorting) {
    require('./database/postDAO.php');
    require('./components/postCard.php');
    $db = new PostDAO();
    $posts = $db->getAllPosts($sorting);
?>
<div class="PostCardList">
  <?php
    foreach($posts as $post){
      create__PostCard($post);
    }
  ?>
</div>
<?php
  }
?>

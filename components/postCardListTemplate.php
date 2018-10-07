<?php
  require('./components/postCardList.php');
  /**
    * 포스트 리스트 랩핑, HTML TAG 출력.
    * @Author Jeong Junwoo
    * @param {string} sorting - sorting 기준 .
    * @Return HTML TAG
    * @called create__PostCardList($sorting)
    */
  function create__PostCardListTemplate($sorting){
    if($sorting == 'tranding'){
      echo '<div class="TrendingTemplate"><h1>지금 뜨고 있는 포스트</h1>';
        create__PostCardList($sorting);
      echo '</div>';
    }else {
      echo '<div class="TrendingTemplate"><h1>지금 최신의 포스트</h1>';
        create__PostCardList($sorting);
        echo '</div>';  
    }
  }
?>

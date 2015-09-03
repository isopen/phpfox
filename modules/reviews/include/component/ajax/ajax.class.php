<?php

class Reviews_Component_Ajax_Ajax extends Phpfox_Ajax {
  public function sendReviews(){
    $text = $this -> get("text");
    $curr_id = Phpfox::getUserId();
    $date = PHPFOX_TIME;
    $value = array(
      "reviews_user"=>$curr_id,
      "reviews_text"=>$text,
      "reviews_date"=>$date
    );
    $res = Phpfox::getLib('database')
      ->insert(":reviews",$value,false,true);

    echo json_encode(array('date'=>$date));

  }
  public function selReviews(){

    $res = Phpfox::getLib('database')
      ->select('pr.*,pu.full_name')
      ->from(':reviews pr')
      ->join(':user','pu','pr.reviews_user=pu.user_id')
      ->order("reviews_id DESC")
      ->execute('getRows');

    echo json_encode(array("list"=>$res));

  }
}
?>

var convertDate = function(utc){
  utc = new Date(utc*1000);
  utc = utc.getDate()+"."+utc.getMonth()+"."+utc.getFullYear()+" "+utc.getHours()+":"+utc.getMinutes()+":"+utc.getSeconds();
  return utc;
}
$Core.reviews = {
  selReviews:function(data){
    try{
      data = JSON.parse(data);
      if(data.list[0]){
        var i = 0, s = "";
        while(data.list[i]){
          s += "<div><div>"+data.list[i].full_name+"</div><div>"+convertDate(data.list[i].reviews_date)+"</div><div>"+data.list[i].reviews_text+" </div></div>";
          i++;
        }
        $(".box_reviews").html(s);
      }else{
        $(".box_reviews").html("<span>Нет отзывов. Будь первым!</span>");
      }
    }catch(e){
      console.log(e.name);
    }finally{
      console.log("selReviews::ok");
    }
  },
  initForm:function(){
    $(".button_reviews").click(function(){
      var text = $(".input_reviews").text();
      if(text != ""){
        $Core.ajax("reviews.sendReviews",{
          params:{text:text},
            success:function($sOutput){
              try{
                data = JSON.parse($sOutput);
                var s = "<div><div>Вы</div><div>"+convertDate(data.date)+"</div><div>"+text+"</div></div>";
                $(".box_reviews div:first").before(s);
              }catch(e){
                console.log(e.name);
              }finally{
                console.log("sendReviews::ok");
              }
            }
        });
      }else{
        alert("Введите отзыв");
      }
    });
  }
};

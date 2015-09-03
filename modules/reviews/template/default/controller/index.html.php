<div class="text_reviews">Оставить отзыв</div>
<div class="input_reviews" contenteditable="true"></div>
<div class="button_reviews">Отправить</div>
<div class="text_reviews">Отзывы участников</div>
<div class="box_reviews">
	{img theme='misc/loading_animation.gif' alt=''}
</div>

{literal}
<script>
	$Ready(function() {
		$Core.reviews.initForm();
		$Core.ajax("reviews.selReviews",{
			success:function($sOutput){
      	$Core.reviews.selReviews($sOutput);
			}
		});
	});
</script>
{/literal}

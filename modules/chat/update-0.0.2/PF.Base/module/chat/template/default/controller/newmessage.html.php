<div class="mail_thread_holder is_user">
	<div class="mail_user_image">
		<a>
			{img user=$user suffix='_50_square' no_link=true}
		</a>
	</div>
	<div class="mail_content">
		<div class="mail_time_stamp">
				1 second ego
		</div>
		<div class="mail_thread_user">
			<span id="js_user_name_link_profile-{$user.user_id}" class="user_profile_link_span">
				<a href="{url link=''}{$user.user_name}">
					{$user.full_name}
				</a>
			</span>
		</div>
		<div class="mail_text">
			{$message|parse}
		</div>
	</div>
</div>

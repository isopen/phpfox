{if $messages}
<div id="box_user_message{$idUser}" class="block_body_chat">
	{if $messages|count == 10}
		<div onclick="$Core.Chat.prevMessages();" class="prev_messages_button">
			Показать ещё
		</div>
	{else}
	{/if}
	{foreach from=$messages item=message key=index name=messages}
		{if $message.user_id != Phpfox::getUserId()}
		<div class="mail_thread_holder">
			<div class="mail_user_image">
				<a>
					{img user=$message suffix='_50_square' no_link=true}
				</a>
			</div>
			<div class="mail_content">
				<div class="mail_time_stamp">
					{$message.time_stamp|convert_time}
				</div>
				<div class="mail_thread_user">
					<span class="user_profile_link_span">
						<a>
							{$message.full_name}
						</a>
					</span>
				</div>
				<div class="mail_text">
					{$message.text}
				</div>
			</div>
		</div>
		{else}
		<div class="mail_thread_holder is_user">
			<div class="mail_user_image">
				<a>
					{img user=$message suffix='_50_square' no_link=true}
				</a>
			</div>
			<div class="mail_content">
				<div class="mail_time_stamp">
					{$message.time_stamp|convert_time}
				</div>
				<div class="mail_thread_user">
					<span class="user_profile_link_span">
						<a>
							{$message.full_name}
						</a>
					</span>
				</div>
				<div class="mail_text">
					{$message.text}
				</div>
			</div>
		</div>
		{/if}
	{/foreach}
</div>
<div id="mail_write_now{$idUser}" class="mail_write_now">{img theme='layout/typing_blue.gif'}<span></span></div>
{else}
	<div id="box_user_message{$idUser}" class="block_body_chat">
		<div class="block_no_message">
			У Вас пока нет сообщений
		</div>
	</div>
	<div id="mail_write_now{$idUser}" class="mail_write_now">{img theme='layout/typing_blue.gif'}<span></span></div>
{/if}


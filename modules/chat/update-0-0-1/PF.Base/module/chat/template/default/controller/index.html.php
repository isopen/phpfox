<div class="container_chat dont-unbind">
	<div class="block_chat">
		<div class="header_chat">
			<a class="el_menu_chat">
				<div onclick="$Core.Chat.exitChat();">
					{img theme='layout/action_delete.png' alt=''}
				</div>
			</a>
			<a class="el_menu_chat">
				<div onclick="$Core.Chat.selFriends();">
					{img theme='misc/status_online.png' alt=''}
				</div>
			</a>
			<div class="title_chat">
				<span>Диалоги</span>
			</div>
		</div>
		<div class="body_chat">
			{$templateFriends}
		</div>
		<div class="footer_chat">
			<a class="ico_chat">
				<div class="attach_ico">
					{img theme='layout/header_search_button.png' alt=''}
					<!--{img theme='misc/bullet_green.png' alt=''}-->
				</div>
				<div class="attach_ico_messages">
					{img theme='misc/bullet_green.png' alt=''}
				</div>
			</a>
			<div class="message_chat">
				<div class="send_chat">
					<div class="cont_send">
						{img theme='misc/email.png' alt=''}
					</div>
				</div>
				<div class="text_chat" contenteditable="true"></div>
			</div>
			<div class="bottom_chat"></div>
		</div>
	</div>
	<div class="fl_block_chat">
		<div class="fl_key_chat" onclick="">
			{img theme='misc/status_online.png' alt=''}
		</div>
	</div>
</div>

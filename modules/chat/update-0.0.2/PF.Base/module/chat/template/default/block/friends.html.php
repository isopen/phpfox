{if $friends}
	{foreach from=$friends item=friend key=index name=friends}
		<a id="friend_chat{$index}" name="friend_chat{$friend.user_id}" class="friend_chat" onclick="$Core.Chat.selMessages({$friend.thread_id},{$friend.user_id},{$index});">
			<span class="photo_friend">
				{img user=$friend suffix='_50_square' no_link=true}
				<!--{if $friend.viewer_is_new}
					<i class="fa fa-envelope-o new_message_blink"></i>
				{else}
					<i class="fa fa-envelope-o new_message_blink_none"></i>
				{/if}-->
			</span>
			<span id="name_friend{$index}" class="name_friend">{$friend.full_name}</span>
			{if $friend.viewer_is_new}
				<span class="status_friend status_message">
				</span>
			{else}
				{if $friend.is_online == 1}
					<span class="status_friend">
					</span>
				{else}
						<span class="status_friend_hide">
						</span>
				{/if}
			{/if}
		</a>
	{/foreach}
{else}
	<div>
		<div class="block_no_message">
			Нет друзей
		</div>
	</div>
{/if}

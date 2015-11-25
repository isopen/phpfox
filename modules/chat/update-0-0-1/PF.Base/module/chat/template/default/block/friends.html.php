{if $friends}
	{foreach from=$friends item=friend key=index name=friends}
		<a id="friend_chat{$index}" name="friend_chat{$friend.user_id}" class="friend_chat" onclick="$Core.Chat.selMessages({$friend.thread_id},{$friend.user_id},{$index});">
			<span class="photo_friend">
				{img user=$friend suffix='_50_square' no_link=true}
			</span>
			<span id="name_friend{$index}" class="name_friend">{$friend.full_name}</span>
			{if $friend.is_online == 1}
				<span class="status_friend">
				</span>
			{else}
				<span class="status_friend_hide">
				</span>
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

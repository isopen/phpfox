var fromId = 0;
$Core.chat = {
	sendGroup:function(id){

		fromId = id;
		alert(fromId);

	},
	sendMessage:function(){

		var textMessage = $("#text_message").val();

		if(textMessage != ""){

			$Core.ajax("chat.sendMessage",{
				params:{id:fromId,type:"message",message:textMessage},
        			success:function($sOutput){
						alert('Сообщение отправлено.');
        			}
			});

		}else{
			alert('Введите сообщение.');
		}

	},
	selFriends:function(){

		$Core.ajax("chat.selFriends",{
        	success:function($sOutput){
				try{
					var friends = JSON.parse($sOutput),
					    i = 0,
					    s = "";

					while(friends.friends[1][i]){
						s += "<div onclick='$Core.chat.sendGroup("+friends.friends[1][i].user_id+");'>"+friends.friends[1][i].full_name+"</div>";
						i++;
					}
					$("#box_freands").html(s);

				}catch(e){}
        	}
		});

		$("#butt_send").click(function(){

			$Core.chat.sendMessage();

		});

	}

}

$(document).ready(function(){

	alert(1);
	$Core.chat.selFriends();

});


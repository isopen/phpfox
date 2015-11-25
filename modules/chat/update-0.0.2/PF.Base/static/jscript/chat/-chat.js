var fromId = -1,
	userId = 0,
	threadId = 0,
	iPage = 1, //message page flag(top messages)
	flagPage = 0, //flag page open user(0-main window,1-message window)
	flagHide = 0, //flag hide window chat(0-show window,1-hide window)
	filterFriend = {}, //friend name/surname class.
	filterBlock = {}, //friend view elements class.
	timerWrite = 0; //trimer for user write message.
	timerLocal = 0;

//View Chat

$Core.Chat = {
	init:function(){

		window.addEventListener('storage', function (event) {

			console.log(event.newValue);

			if(event.key == "message"){

				var e = JSON.parse(event.newValue);

				$Core.Chat.updateView(e.userId,e.message);

			}

		});

		$Core.ajax("chat.index",{
			success:function($sOutput){

				$("body").append($sOutput);
				$Core.loadInit();

				$(".text_chat").focus();

				$Core.Chat.adaptive();

				$Core.Chat.searchInit();

				//console.log(filterFriend);
				//console.log(filterBlock);

  			}
		});

	},
	selMessages:function(idThread,idUser,i){

		$(".text_chat").empty();
		$(".text_chat").focus();
		$(".attach_ico").hide();
		$(".attach_ico_messages").show();
		$(".cont_send").show();

		$Core.Chat.loading();

		var surname = filterFriend[i]["surname"],
			name = filterFriend[i]["name"];

		name = name.charAt(0).toUpperCase() + name.substr(1);

		if(surname != undefined){
			surname = surname.charAt(0).toUpperCase() + surname.substr(1);
			$(".title_chat").text(name+" "+surname);
		}else{
			$(".title_chat").text(name);
		}

		flagPage = 1;
		fromId = idUser;
		threadId = idThread;

		$Core.ajax("chat.messages",{
			params:{id:idThread,idUser:idUser},
			success:function($sOutput){

				$(".body_chat").html($sOutput);

				var height = $(".block_body_chat").height();
				$(".body_chat").scrollTop(height);
				$Core.loadInit();

  			}
		});
	},
	prevMessages:function(){
		iPage++;
		$Core.ajax("chat.prevMessages",{
			params:{idThread:threadId,iPage:iPage},
			success:function($sOutput){
				if($sOutput != 1){
					//var scrollBlock = $(".block_body_chat").children()[1];
					$(".prev_messages_button").after($sOutput);
					//$(".body_chat").scrollTo(scrollBlock);
					$Core.loadInit();
				}else{
					$(".prev_messages_button").detach();
				}
  			}
		});
	},
	selFriends:function(){

		if((flagHide == 0)&&(flagPage == 1)){

			//default number
			flagPage = 0;
			fromId = -1;
			iPage = 1;
			userId = 0;
			threadId = 0;
			filterFriend = {};
			filterBlock = {};
			/*clearTimeout(timerLocal);
			clearTimeout(timerWrite);
			timerLocal = 0;
			timerWrite = 0;*/
			$Core.Chat.loading();

			$(".title_chat").text("Диалоги");
			$(".text_chat").focus();
			$(".attach_ico").show();
			$(".attach_ico_messages").hide();
			$(".cont_send").hide();
			$(".text_chat").empty();

			$Core.ajax("chat.friends",{
				success:function($sOutput){

					$(".body_chat").html($sOutput);
					$Core.loadInit();

					$(".body_chat").scrollTop(0);

					$Core.Chat.searchInit();

				}
			});
		}else{
			$Core.Chat.showChat();
		}

	},
	sendMessage:function(){

		var textMessage = $(".text_chat").text();

		if(textMessage != ""){

			$(".text_chat").empty();

			$Core.ajax("chat.sendMessage",{
				params:{id:fromId,threadId:threadId,type:"message",message:textMessage},
        success:function($sOutput){

						localStorage.setItem("message",$sOutput);

						var $sOutput = JSON.parse($sOutput);

						/*TODO function index1*/
						if($("#box_user_message"+fromId).children(".mail_thread_holder").length == 0){
							$("#box_user_message"+fromId).empty();
						}
						$("#box_user_message"+fromId).append($sOutput.message);
						$("#mail_messages"+fromId).children("#mail_threaded_new_message").append($sOutput.message);
						$Core.Chat.scroll(fromId);
						$Core.loadInit();

        }
			});

		}else{
			//console.log('Введите сообщение.');
		}

	}/*,
	prevScroll:function(){
		$(".body_chat").scroll(function(){
			var scrollTop = $(".body_chat").scrollTop();
			if(scrollTop == 0){
				scrollTop += 300;
				$Core.Chat.prevMessages();
				$(".body_chat").scrollTop(scrollTop);
			}
		});
	}*/,
	scroll:function(userId){

		var box_user_message = $("#box_user_message"+userId);

		if(box_user_message.length){
			var miniChatHeight = box_user_message.height();
			$(".body_chat").scrollTop(miniChatHeight);
		}

		if($('.mail_messages')[0]){
			$("#mail_messages"+userId).animate({ scrollTop: $('.mail_messages')[0].scrollHeight}, 400);
		}

	},
	updateView:function(userId,message){

		$("#mail_write_now"+fromId).children().hide();
		$("#mail_write_now_mainchat"+userId).children().hide();

		if($("#box_user_message"+userId).children(".mail_thread_holder").length == 0){
			$("#box_user_message"+userId).empty();
		}
		$("#box_user_message"+userId).append(message);
		$("#mail_messages"+userId).children("#mail_threaded_new_message").append(message);

		//if window chat current user open
		if($("#box_user_message"+userId).length){

			var miniChatHeight = $("#box_user_message"+userId).height();
			$(".body_chat").scrollTop(miniChatHeight);
			$Core.ajax("chat.messagesRead",{
				params:{idThread:threadId,fromId:fromId},
        		success:function($sOutput){}
			});

		}else{ //window chat current user close

			if(!($("#mail_messages"+userId).length)){
				var countMessage = $("#js_total_new_messages").text()*1;
				countMessage++;
				$("#js_total_new_messages").html(countMessage);
				$("#js_total_new_messages").css("display","block");

				$("#panel_rows_user"+userId).addClass("is_new");
			}
		}

		if($('.mail_messages')[0]){
			$("#mail_messages"+userId).animate({ scrollTop: $('.mail_messages')[0].scrollHeight}, 400);
		}

		$Core.loadInit();

	},
	showChat:function(){
		flagHide = 0;
		$(".body_chat").removeClass("fl_hide_body");
		$(".body_chat").addClass("fl_show_body");
		$(".container_chat").attr("style","");
	},
	exitChat:function(){
		flagHide = 1;
		$(".body_chat").removeClass("fl_show_body");
		$(".body_chat").addClass("fl_hide_body");
		$(".container_chat").attr("style","");
	},
	searchInit:function(){
		var i = 0;
		while($("#name_friend"+i).length){
			var temp = $("#name_friend"+i).text().toLowerCase().replace(/\s+/g," ").split(" ");
			filterFriend[i] = {"name":temp[0],"surname":temp[1]};
			filterBlock[i] = $("#friend_chat"+i);
			i++;
		}
	},
	writeUser:function(userId,message){

		$("#mail_write_now"+userId).children().show();
		$("#mail_write_now"+userId+" > span").text($(".title_chat").text()+" печатает...");

		$("#mail_write_now_mainchat"+userId).children().show();
		$("#mail_write_now_mainchat"+userId+" > span").text($(".js_box_title").text()+" печатает...");

		function funcHide() {
			clearTimeout(timerLocal);
			timerLocal = 0;
  			$("#mail_write_now"+userId).children().hide();
			$("#mail_write_now_mainchat"+userId).children().hide();
		}
		timerLocal = setTimeout(funcHide, 15000);

	},
	loading:function(){

		$(".body_chat").html('<i class="fa fa-circle-o-notch fa-spin progress_chat"></i>');

	},
	adaptive:function(){
		if ($(window).width() <= '703'){
			$Core.Chat.exitChat();
		}else {
			$Core.Chat.showChat();
    }
	}

};

//Hendler Chat

$Behavior.chatDraggable = function(){

	$(".container_chat").draggable({
    	handle: '.title_chat',
    	opacity: 0.8
    });

};

$Behavior.hendlerTextView = function(){

	$(".text_chat").unbind();

	if(flagPage == 0){

		$(".text_chat").keyup(function(e){

			var text = $(".text_chat").text().toLowerCase().replace(/\s+/g, '');
			if(text != ""){
				var i = 0;
				while(filterFriend[i]){
					try{
						var reg = new RegExp("^"+text+"{1}"),
							name = filterFriend[i]["name"],
							surname = filterFriend[i]["surname"];
						if(surname != undefined){

							conc = name + surname;
							concRev = surname + name;

							if(reg.test(name)||reg.test(surname)||reg.test(conc)||reg.test(concRev)){
								if($(".block_no_message").length){
									$(".body_chat").empty();
								}
								$(".body_chat").append(filterBlock[i][0]);
							}else{
								$("#friend_chat"+i).detach();
							}

						}else{

							if(reg.test(name)){
								if($(".block_no_message").length){
									$(".body_chat").empty();
								}
								$(".body_chat").append(filterBlock[i][0]);
							}else{
								$("#friend_chat"+i).detach();
							}

						}
						if($(".body_chat").children().length == 0){
							$(".body_chat").html('<div><div class="block_no_message">Не найдено друзей с таким именем</div></div>');
						}
					}catch(e){
						// if spec simbol[*/-....
						$(".body_chat").html('<div><div class="block_no_message">Не найдено друзей с таким именем</div></div>');
					}
					i++;
				}
			}else{

				$(".body_chat").empty();
				var i = 0;
				while(filterBlock[i]){
					$(".body_chat").append(filterBlock[i][0]);
					i++;
				}

			}

		});

	}else{

		$(".text_chat").keypress(function(e){
    		if(e.keyCode == 13){
				$Core.Chat.sendMessage();
			}
		});

		$(".text_chat").keyup(function(e){

			if(timerWrite == 0){
				$Core.ajax("chat.userWrite",{
					params:{fromId:fromId},
        				success:function($sOutput){
						}
				});
			}

			function func(){
				clearTimeout(timerWrite);
				timerWrite = 0;
			}
			timerWrite = setTimeout(func,20000);

		});

	}

};

$Behavior.mainChat = function(){
	$("#message").keyup(function(e){

		if(timerWrite == 0){
			$Core.ajax("chat.userWrite",{
				params:{fromId:mainChatFromId},
    				success:function($sOutput){
				}
			});
		}

		function func(){
			clearTimeout(timerWrite);
			timerWrite = 0;
		}
		timerWrite = setTimeout(func,20000);

	});

	$(".cont_send").click(function(){
		$Core.Chat.sendMessage();
	});

	$(window).resize(function() {
		$Core.Chat.adaptive();
  });

};

//Socket connect function
$Core.socket = {
	init:function(){

		var socket = new ReconnectingWebSocket("ws://localhost:8080");
		socket.debug = true;
		socket.reconnectInterval = 3000;

		socket.onmessage = function(e){

			var e = JSON.parse(e.data);

			switch(e.type){
				case "message":
					$Core.Chat.updateView(e.userId,e.message);
				break;
				case "online":
					$(".body_chat > a[name='friend_chat"+e.userId+"'] > .status_friend_hide").css("display","block");
				break;
				case "write":
					$Core.Chat.writeUser(e.userId,e.message);
				break;
			}

			/*if(e.type == "message"){

				$Core.Chat.updateView(e.userId,e.message);

			}

			if(e.type == "online"){

				$(".body_chat > a[name='friend_chat"+e.userId+"'] > .status_friend_hide").css("display","block");

			}*/

		};

		socket.onopen = function(){};

	},
	start:function(){
		$Core.ajax("chat.initConnect",{
			success:function($sOutput){
				$Core.socket.init();
				$Core.Chat.init();
  			}
		});
	}
}

//init connect!!!(insert start into auth complate).
$Core.socket.start();

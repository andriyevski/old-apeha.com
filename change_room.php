<?php
require_once("inc_common.php");
set_variable("user_name");
set_variable("chat_type");
set_variable("c_user_color");
set_variable("password");
set_variable("room_id");

$room_id = $_ROOM['TO_CHANGE'];

$REMOTE_ADDR = "";
if (isset($HTTP_SERVER_VARS['REMOTE_ADDR'])) $REMOTE_ADDR = $HTTP_SERVER_VARS['REMOTE_ADDR'];

set_variable("design");
if ($design == "") $design = $default_design;
else if (!in_array($design, $designes)) $design = $default_design;
$current_design = $chat_url."designes/".$design."/";

set_variable("user_lang");
set_variable("c_ulang");
if ($c_ulang != "" && $user_lang == "") $user_lang = $c_ulang;
if (!in_array($user_lang, $allowed_langs)) $user_lang = $language;
else {
	include_once($file_path."languages/".$user_lang.".php");
	$registered_colors = $s_registered_colors;
	$default_color = $s_default_color;
	$highlighted_color = $s_highlighted_color;
}

set_variable("room");
include($ld_engine_path."rooms_get_list.php");
if (!in_array($room, $room_ids))
$room = intval($room_ids[0]);

//for the future:
//$user_lang = "en";
$fields_to_update = array();


//if user is already in the chat and just reload page or change the room:
if ($session != "") {
	include($engine_path."users_get_list.php");
	if (!$exists) {
		$error_text = "$w_no_user";
		include($file_path."designes/".$design."/error_page.php");
		exit;
	}
	$registered_user = $is_regist;
	//again, cause user has current roomdesign, not the new one
	$shower = "messages.php?session=$session";
	$chat_type = $user_chat_type;
	if (!in_array($chat_type, $chat_types)) $chat_type = $chat_types[0];
	if ($chat_type=="tail") $shower = "$daemon_url?$session";
	elseif ($chat_type=="reload") $shower = "messages.php?session=$session";
	elseif ($chat_type=="php_tail") $shower = "tail.php?session=$session";
	elseif ($chat_type=="js_tail") $shower = "js_frameset.php?session=$session";
	if($c_user_color== "") {$user_color=$default_color;}
	else $user_color = $c_user_color;
	$def_color = $registered_colors[$default_color][1];

	//$room_id == current user room
	//$room -- room where user want to go...
	if ($room_id != $room) {
		//somebody can jumping from one room to another and floods in such way. in this case enable flood_protection
		$flood_protection = 1;
		$w_rob_name = $rooms[$room_id]["bot"];
		$messages_to_show[] = array(MESG_TIME=>my_time(),
		MESG_ROOM=>$room_id,
		MESG_FROM=>$w_rob_name,
		MESG_FROMWOTAGS=>$w_rob_name,
		MESG_FROMSESSION=>"",
		MESG_FROMID=>0,
		MESG_FROMAVATAR=>"",
		MESG_TO=>"",
		MESG_TOSESSION=>"",
		MESG_TOID=>"",
		MESG_BODY=>"<font color=\"$def_color\">".str_replace("*",$rooms[$room]["title"],str_replace("~", $user_name, $sw_goes_to_room))."</font>");
		$w_rob_name = $rooms[$room]["bot"];
		$messages_to_show[] = array(MESG_TIME=>my_time(),
		MESG_ROOM=>$room,
		MESG_FROM=>$w_rob_name,
		MESG_FROMWOTAGS=>$w_rob_name,
		MESG_FROMSESSION=>"",
		MESG_FROMID=>0,
		MESG_FROMAVATAR=>"",
		MESG_TO=>"",
		MESG_TOSESSION=>"",
		MESG_TOID=>"",
		MESG_BODY=>"<font color=\"$def_color\">".str_replace("*",$rooms[$room_id]["title"],str_replace("~", $user_name, $sw_came_from_room))."</font>");
		if($cu_array[USER_CLASS] ==0 && $ar_rooms[$room][ROOM_PREMODER]==1) {
			//khm... i have to output it:
			$flood_protection = 0;
			$messages_to_show[] = array(MESG_TIME=>my_time(),
			MESG_ROOM=>$room,
			MESG_FROM=>$w_rob_name,
			MESG_FROMWOTAGS=>$w_rob_name,
			MESG_FROMSESSION=>"",
			MESG_FROMID=>0,
			MESG_FROMAVATAR=>"",
			MESG_TO=>$user_name,
			MESG_TOSESSION=>$session,
			MESG_TOID=>$is_regist,
			MESG_BODY=>"<font color=\"$def_color\">".$w_premoder_room."</font>");
		}
		include($engine_path."messages_put.php");
	}
	$room_id = $room;
	$fields_to_update[0][0] = USER_ROOM;
	$fields_to_update[0][1] = $room_id;
	include($engine_path."user_din_data_update.php");
	include($file_path."designes/".$design."/voc.php");
	exit;
}

//if user is trying to log in.

setCookie("c_user_name", $user_name, time() + 2678400);
setCookie("c_chat_type", $chat_type, time() + 2678400);
setCookie("c_design", $design, time() + 2678400);
setCookie("c_hash", $c_hash, time() + 2678400);
setCookie("c_ulang", $user_lang, time() + 2678400);

include("inc_user_class.php");
include("inc_to_canon_nick.php");
#check for nickname;


$session = md5(uniqid(rand()));
$shower = "messages.php?session=$session";
if (!in_array($chat_type, $chat_types)) $chat_type = $chat_types[0];

if ($chat_type=="tail") $shower = "$daemon_url?$session";
elseif ($chat_type=="reload") $shower = "messages.php?session=$session";
elseif ($chat_type=="php_tail") $shower = "tail.php?session=$session";
elseif ($chat_type=="js_tail") $shower = "js_frameset.php?session=$session";
#ban check
include($ld_engine_path."ban_check.php");
if (check_ban(array("un|".to_canon_nick($user_name), "ip|".$REMOTE_ADDR, "ch|".$c_hash, "bh|".$browser_hash, "sn|".substr($REMOTE_ADDR, 0 , strrpos($REMOTE_ADDR,".")) ))) {
	$error_text=$w_banned;
	include($file_path."designes/".$design."/error_page.php");
	exit;
}

#???????????
if($c_user_color== "") {$user_color=$default_color;}
else $user_color = $c_user_color;

$registered_user = 0;
$users = array();
$htmlnick = "";
//////////////////////////////////////////! «¿œ»—‹
include($ld_engine_path."voc_user_data.php");


if (!$registered_user && $club_mode) {
	$error_text=$w_registered_only."<br><a href=\"".$chat_url."registration_form.php?design=".$design."\" target=\"_parent\">".$w_registration."</a> &nbsp; &nbsp; <a href=\"".$chat_url."?design=".$design."\" target=\"_parent\">".$w_login_button."</a>";
	include($file_path."designes/".$design."/error_page.php");
	exit;
}

$def_color = $registered_colors[$default_color][1];
$flood_protection = 0;
unset($messages_to_show);
$messages_to_show = array();
include($ld_engine_path."rooms_get_list.php");
//$room we get from request, room_id -- internal variable
$room_id = $room;
if (!in_array($room_id,$room_ids))$room_id=intval($room_ids[0]);
$w_rob_name = $rooms[$room_id]["bot"];


// ----- # «¿œ»—‹ # ----- //
include($engine_path."voc.php");
// ----- #  ŒÕ≈÷ # ----- //
?>
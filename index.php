<?php
include("inc/db_connect.php");
$online=mysql_num_rows(mysql_query("select `id` from `online`"));
$type=$_GET['type'];
if(empty($type)){$type = "news"; }
else if($type=="news"){$title="�������";}
else if($type=="top_user"){$title="��� �������";}
else if($type=="top_klans"){$title="��� ������";}
else if($type=="forum"){$title="�����";}
else if($type=="lib"){$title="����������";}
else if($type=="comments"){$title="����������";}
else if($type=="reg"){$title="�����������";}
else if($type=="about"){$title="� ����";}
else if($type=="law"){$title="������";}
else if($type=="faq"){$title="FAQ";}
else if($type=="start"){$title="������� �����";}
else if($type=="termin"){$title="�������";}
else if($type=="lib_monsters"){$title="�������";}
else if($type=="lib_kvest"){$title="������";}
else if($type=="exp"){$title="������� �����";}
else {die();}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <link href="css/site_index.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta name="description" content="Old-apeha.com">
<title>Old-apeha.com - MMORPG <?=$title?></title>
<script language="JavaScript">
function setCookie (name, value, expires, path, domain, secure) {
      document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

</script>
</head>
<body>
<div class="all_site">
    <div class="header">Header</div>
    <div class="left_footer">
    <div id="name_block">
        <div id="name_block_info"<b>������������<br>�����</b></div>
    </div>
    </div>
    <div class="center">center content</div>
    <div class="right_footer">right footer</div>
    <div class="footer">footer</div>
</div>
</body>

</html>


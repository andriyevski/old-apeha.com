
<body background="../img/chat/chat_bg.png" onload="showTime();">
<table style="margin-top: 3px;" width="100%">
    <tr>
        <td> <form action="?act=send" method="post">
                <select name="pre">
                    <option value="<?=htmlspecialchars($_POST['pre'])?>"><? if($_POST['pre']=='!')echo '�����';elseif($_POST['pre']=='[�����]')echo '�����';elseif($_POST['pre']=='[�����]')echo '�����';else echo '�����';?></option>
                    <? if($_POST['pre']!='') {?><option value="">�����</option><?}?>
                    <? if($_POST['pre']!='!') {?><option value="!">�����</option><?}?>
                    <? if($_POST['pre']!='[�����]') {?><option value="[�����]">�����</option><?}?>
                    <? if($_POST['pre']!='[������]') {?><option value="[������]">������</option><?}?>
                </select>
        </td><td valign=top><input type="text" name="text" id='msg' value="" size="50"></td><td valign=top><input type="submit" value="���������" style="background-image: url(img/chat/Chat_gramophone.png); float: left);" ></form></td><?
        if ($stat['level'] >= 4)
            echo "<td valign=top><input type=button  height='30' value=��������  border=0 style='cursor: pointer' title='�������� ��������� / ��������' onclick=\"parent.main.location='main.php?set=transfer';\"></td>";
        ?>

        <?

        if ($stat['tribe'])
            echo "<input height='30' type=button value=����  border=0 style='cursor: pointer' title='����' onclick=\"parent.main.location='main.php?set=clan';\"></td>";
        if (($stat['rank'] >= 10 && $stat['rank'] < 15) || $stat['rank'] >= 98)
            echo "<td valign=top ><input type=button value=����������  border=0 style='cursor: pointer' title='����������' onclick=\"parent.main.location='guard.php?';\"></td>";
        if ($stat['skl'] == '2')
            echo "<td valign=top ><input type=button value='������ ����' height='30'   border=0 style='cursor: pointer' title='����' onclick=\"parent.main.location='dark.php';\"></td>";
        if ($stat['skl'] == '3')
            echo "<td valign=top ><input type=button value='������ �����' height='30'   border=0 style='cursor: pointer' title='����' onclick=\"parent.main.location='svet.php';\"></td>";

        ?><td valign=top id=clock style="color: #feeab9; font-size: 16;">



            <img src="img/chat/chat_bsclanold.png" width="21" height="21" title="����" style="cursor: hand;
    float: left; margin: 6px 0 0 5px;">


            <img src="img/chat/chat_meonlyold.png" width="21" height="21" title="����� �����������" style="cursor: hand;
    float: left; margin: 6px 0 0 5px;">
            <img src="img/chat/chat_out.png" width="21" height="21" title="�����" style="cursor: hand;
    float: left; margin: 6px 0 0 5px;" onclick="if (confirm('����� �� ����?')) top.window.navigate('/main.phtml?exit=0.781520416407446')">

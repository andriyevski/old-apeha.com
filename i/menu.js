

function rc1 (id) { document.all(''+id+'').style.backgroundColor = '0A246A'; document.all(''+id+'').style.color = 'FFFFFF'; }
function rc2 (id) { document.all(''+id+'').style.backgroundColor = 'D4D0C8'; document.all(''+id+'').style.color = '000000'; }

function menu () {
var menu = document.all('menu');

menu.innerHTML = '<table onmouseleave=\"document.all(\'menu\').innerHTML = \'\';\" width=107 style=\"border-style: outset; border-width: 1\" bgcolor=D4D0C8>$img<tr><td id=1 onmousemove=\"rc1(1);\" onmouseout=\"rc2(1);\">&nbsp;<span style=\"CURSOR: Hand\" onclick=\'window.location.href=\"main.php?set=edit&unset=all&tmp=\"+Math.random();\"\"\'><i><b>Снять всё</b></i></span></td></tr><tr><td id=2 onmousemove=\"rc1(2);\" onmouseout=\"rc2(2);\">&nbsp;<span style=\"CURSOR: Hand\" onclick=\'window.location.href=\"main.php?set=updates&tmp=\"+Math.random();\"\"\'><i><b>Умения</b></i></span></td></tr><tr><td id=3 onmousemove=\"rc1(3);\" onmouseout=\"rc2(3);\">&nbsp;<span style=\"CURSOR: Hand\" onclick=\'window.location.href=\"main.php?set=anketa&step=1&tmp=\"+Math.random();\"\"\'><i><b>Анкета</b></i></span></td></tr><tr><td id=4 onmousemove=\"rc1(4);\" onmouseout=\"rc2(4);\">&nbsp;<span style=\"CURSOR: Hand\" onclick=\'window.location.href=\"main.php?set=security&tmp=\"+Math.random();\"\"\'><i><b>Безопасность</b></i></span></td></tr><tr><td id=5 onmousemove=\"rc1(5);\" onmouseout=\"rc2(5);\">&nbsp;<span style=\"CURSOR: Hand\" onclick=\'window.location.href=\"main.php?set=otchets&tmp=\"+Math.random();\"\"\'><i><b>Отчёты</b></i></span></td></tr></table>';
}

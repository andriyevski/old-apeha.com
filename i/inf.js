function iteminfo(id) {
   var PageUrl = "iteminfo.php?id="+id;
   window.open(PageUrl, 'Inf', 'location=no,menubar=no,status=no,toolbar=no,scrollbars=no,width=650,height=400')
}

// �������� ����
function openpopup (popurl) { winpops=window.open('+popurl+',"","width=120,height=300,resizable") }

// ������� ����
function inf(login){
window.open('inf.php?login='+login, 'Inf', 'location=yes,menubar=yes,status=yes,toolbar=yes,scrollbars=yes, resizable')
}
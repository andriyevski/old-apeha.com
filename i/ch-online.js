function ch(rase,login,id,align,klan,level) {
var inf, about;

if (klan!=0 && klan!='') klan='<A HREF="encicl.php?view=tribes&name='+klan+'" target=_blank><IMG SRC="i/klan/'+klan+'.gif" WIDTH=10 HEIGHT=10 BORDER=0 ALT="���� '+klan+'"></A>'; else klan='';


if (rase=='') {rase_alt='';}
if (rase=='Or') {rase_alt='416E00';}
if (rase=='El') {rase_alt='FF8400';}
if (rase=='Hm') {rase_alt='537B8D';}
if (rase=='Dw') {rase_alt='704500';}
if (rase=='An') {rase_alt='AA0000';}

if (align==0) {align_alt='';}
if (align==10) {align_alt='������ IV';}
if (align==11) {align_alt='������ III';}
if (align==12) {align_alt='������ II';}
if (align==13) {align_alt='������ I';}
if (align==14) {align_alt='��������� ������';}
if (align==30) {align_alt='�����';}
if (align==20) {align_alt='Ҹ����';}
if (align==60) {align_alt='���';}
if (align==99) {align_alt='�����';}
if (align==100) {align_alt='������';}

if (login==my_user) private='<IMG SRC="i/private_0.gif" BORDER=0 ALT="" width=10 height=10>'; else private='<a href="javascript:top.pp(\''+login+'\')"><IMG SRC="i/private.gif" BORDER=0 ALT="��������"></a>';

document.write(' '+private+' <IMG SRC="i/align/align'+align+'.gif" BORDER=0 ALT=\"'+align_alt+'\" width=10 height=10>'+klan+'<b><font size=2 color='+rase_alt+' >'+rase+'</b></font> <font size=2><a href="javascript:top.to(\''+login+'\')">'+login+'</a><b> ['+level+']</b></font> <a href="inf.php?'+id+'" target=_blank>'+'<IMG SRC="i/inf.gif" BORDER=0 ALT="���������� � '+login+'" width=10 height=10></a>');
document.write('<BR>');}
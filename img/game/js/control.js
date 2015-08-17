var imag=new Array();
var imags=new Array("m1_1.gif",
"m1_1on.gif",
"m2_1.gif",
"m2_1on.gif",
"m3_1.gif",
"m3_1on.gif",
"m4_1.gif",
"m4_1on.gif",
"m5_1.gif",
"m5_1on.gif",
"m6_1.gif",
"m6_1on.gif",
"m7_1.gif",
"m7_1on.gif",
"m8_1.gif",
"m8_1on.gif");

for(i=0; i<14; i++){
    imag[i]=new Image;
	imag[i].src="../img/game/menu/"+imags[i];
}

function getEl(objId){
 return document.getElementById(objId)
}

function chim(img,i) { 
  getEl(img).src = "../img/game/menu/"+imags[i];
}


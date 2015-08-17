var request;

function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

/*function doLoad(url,tt){
var xmlhttp = getXmlHttp()
// alert(url);
xmlhttp.open('GET', url, true);
xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && tt===undefined) eval(xmlhttp.responseText);
};
xmlhttp.send(null);
}*/

function doLoad(url,tt){
var xmlhttp = getXmlHttp()
xmlhttp.open('GET', url, true);
xmlhttp.onreadystatechange = function() {
  if (xmlhttp.readyState == 4 && tt===undefined) {
     if(xmlhttp.status == 200) {
       //alert(xmlhttp.responseText);
       eval(xmlhttp.responseText);
       //eval('alert(1);');
         }
  }
};
xmlhttp.send(null);
}

var xmlHttp;
function createXMLHttpRequest(){if(window.ActiveXObject){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}else if(window.XMLHttpRequest) {xmlHttp=new XMLHttpRequest();}else{alert("����������ͧ��ҹ���ʹѺʹع��÷ӧҹ�ͧ AJAX!");}}
function RequestFile(strRequest, strDiv) {createXMLHttpRequest();xmlHttp.onreadystatechange=function(){if(xmlHttp.readyState==4){if(xmlHttp.status==200) {document.getElementById(strDiv).innerHTML=xmlHttp.responseText;}}};xmlHttp.open("GET", strRequest,true);xmlHttp.send(null);}

function AHref(url){window.location.replace(url);}
function confirmDelete(path){var drop = confirm("��ô�׹�ѹ���ź������");if(drop==1){AHref(path);}}


function showVisit(val){
	RequestFile("getData.php?op=visit&pop_id="+val,"Visit") ;
}

function showDiag(val){
	RequestFile("getData.php?op=diag&vn="+val,"Diagnosis") ;
}

function showRx(val){
	RequestFile("getData.php?op=rx&vn="+val,"Rx") ;
}

function showProced(val){
	RequestFile("getData.php?op=proced&vn="+val,"Proced") ;
}

function showCC(val){
	RequestFile("getData.php?op=cc&vn="+val,"CC") ;
}

function showPI(val){
	RequestFile("getData.php?op=pi&vn="+val,"PI") ;
}

function showPE(val){
	RequestFile("getData.php?op=pe&vn="+val,"PE") ;
}

function showLAB(val){
	RequestFile("getData.php?op=lab&vn="+val,"LAB") ;
}



// nav menu
var timeout	= 500;
var closetimer	= 0;
var ddmenuitem	= 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose; 



//��Ʒ���ർ��

var menuids=["suckertree1"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className="subfolderstyle"
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus)



function comment_check() {
if ( document.form1.name.value == '' ) {
window.alert('����������^_^');
document.form1.name.focus();
return false;}

if ( document.form1.email.value.length> 0 &&!document.form1.email.value.indexOf('@')==-1|document.form1.email.value.indexOf('.')==-1 ) {
window.alert('��������ȷ��Email��ַ����:mikl@163.com ');
document.form1.email.focus();
return false;}

if(document.form1.qq.value.search(/^([0-9]*)([.]?)([0-9]*)$/)   ==   -1)   
      {   
  window.alert("QQֻ��������^_^");   
document.form1.qq.focus();
return false;}

if ( document.form1.content.value == '' ) {
window.alert('����������^_^');
document.form1.content.focus();
return false;}

if ( document.form1.verycode.value == '' ) {
window.alert('��������֤��^_^');
document.form1.verycode.focus();
return false;}

return true;}


/* Fucus*/
$(function() {
	var sWidth = $("#Focus").width(); //��ȡ����ͼ�Ŀ�ȣ���ʾ�����
	var len = $("#Focus ul li").length; //��ȡ����ͼ����
	var index = 0;
	var picTimer;
	
	//���´���������ְ�ť�Ͱ�ť��İ�͸������������һҳ����һҳ������ť
	var btn = "<div class='btnBg'></div><div class='btn'>";
	for(var i=0; i < len; i++) {
		btn += "<span></span>";
	}
	btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
	$("#Focus").append(btn);
	$("#Focus .btnBg").css("opacity",0.3);

	//ΪС��ť�����껬���¼�������ʾ��Ӧ������
	$("#Focus .btn span").css("opacity",0.3).mouseenter(function() {
		index = $("#Focus .btn span").index(this);
		showPics(index);
	}).eq(0).trigger("mouseenter");

	//��һҳ����һҳ��ť͸���ȴ���
	$("#Focus .preNext").css("opacity",0.1).hover(function() {
		$(this).stop(true,false).animate({"opacity":"0.3"},300);
	},function() {
		$(this).stop(true,false).animate({"opacity":"0.1"},300);
	});

	//��һҳ��ť
	$("#Focus .pre").click(function() {
		index -= 1;
		if(index == -1) {index = len - 1;}
		showPics(index);
	});

	//��һҳ��ť
	$("#Focus .next").click(function() {
		index += 1;
		if(index == len) {index = 0;}
		showPics(index);
	});

	//����Ϊ���ҹ�����������liԪ�ض�����ͬһ�����󸡶�������������Ҫ�������ΧulԪ�صĿ��
	$("#Focus ul").css("width",sWidth * (len));
	
	//��껬�Ͻ���ͼʱֹͣ�Զ����ţ�����ʱ��ʼ�Զ�����
	$("#Focus").hover(function() {
		clearInterval(picTimer);
	},function() {
		picTimer = setInterval(function() {
			showPics(index);
			index++;
			if(index == len) {index = 0;}
		},4000); //��4000�����Զ����ŵļ������λ������
	}).trigger("mouseleave");
	
	//��ʾͼƬ���������ݽ��յ�indexֵ��ʾ��Ӧ������
	function showPics(index) { //��ͨ�л�
		var nowLeft = -index*sWidth; //����indexֵ����ulԪ�ص�leftֵ
		$("#Focus ul").stop(true,false).animate({"left":nowLeft},300); //ͨ��animate()����ulԪ�ع������������position
		//$("#Focus .btn span").removeClass("on").eq(index).addClass("on"); //Ϊ��ǰ�İ�ť�л���ѡ�е�Ч��
		$("#Focus .btn span").stop(true,false).animate({"opacity":"0.4"},300).eq(index).stop(true,false).animate({"opacity":"1"},300); //Ϊ��ǰ�İ�ť�л���ѡ�е�Ч��
	}
});

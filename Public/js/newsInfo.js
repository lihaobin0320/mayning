$(document).ready(function(){
	
	init();
	
});

function init(){
	
	var searchStr = location.search;
	//由于searchStr属性值包括“?”，所以除去该字符
    searchStr = searchStr.substr(1);
	var id = searchStr.split("=")[1];
	$.getJSON("ContentDetail?ttid='"+Math.random(),{id:id},function(json){
	var item = json.content;
	$("#content").html(item.content);
});

}
$(document).ready(function(){
	//获取首页轮播图
	getIndexRoll();
	//获取首页展示图
	getIndexShow();
	//获取首页欢迎语
	getIndexWelcome();
	
});

function  getIndexRoll()
{
	jQuery.getJSON('ListContentByCategory?ttid='+Math.random(), {"recommend":"2","cateid":"8","pageno":"0","pagenum":"10"}, function(json, textStatus) {
		  if(json==null||json=='')
			  return ;
		  
			var items = json.items;
			var str='';
			$.each(items,function(index,item){
				str+='<li title="'+item.title+'" ><a  href="productInfo.html?id='+item.id+'"><img src="upload/images/'+item.imgs+'"   /></a></li>';
			});
			$('#slider').html("");
		  	jQuery(str).appendTo('#slider');
		  	//$('#slider').nivoSlider();	
		  	//$('.banner').unslider();
		  	$('.banner').unslider({
		  		speed: 500,               //  The speed to animate each slide (in milliseconds)
		  		delay: 3000,              //  The delay between slide animations (in milliseconds)
		  		complete: function() {},  //  A function that gets called after every slide animation
		  		keys: true,               //  Enable keyboard (left, right) arrow shortcuts
		  		dots: true,               //  Display dot navigation
		  		fluid: false              //  Support responsive design. May break non-responsive designs
		  	});
		});
	
	
};


function getIndexShow()
{
	jQuery.getJSON('ListContentByCategory?ttid='+Math.random(), {"recommend":"3","cateid":"8","pageno":"0","pagenum":"4"}, function(json, textStatus) {
		  if(json==null||json=='')
			  return ;
		  
			var items = json.items;
			var str='';
			var num=0;
			$.each(items,function(index,item){
				if(num<2)
					{
						str+=' <div class="main_img"><a href="javascript:void(0)" onclick=getProductInfo("'+item.id+'")><img src="upload/images/'+item.imgs+'"  title="'+item.title+'"  width="266" height="255" /></a></div>';
					}else{
						str+='<div class="main_img margin_02"><a href="javascript:void(0)" onclick=getProductInfo("'+item.id+'")><img src="upload/images/'+item.imgs+'"  title="'+item.title+'"  width="266" height="255" /></a></div>';
					}
				if(num>4)
					return;
				num++;
			});
			$('#indexShow').html("");
		  	jQuery(str).appendTo('#indexShow');
		  	
		});
};

function getIndexWelcome()
{
	jQuery.getJSON('ListContentByCategory?ttid='+Math.random(), {"cateid":"6","pageno":"0","pagenum":"1"}, function(json, textStatus) {
		  if(json==null||json=='')
			  return ;
		  
			var items = json.items;
			
			$.each(items,function(index,item){
				$("#welcomeTitle").html(item.title);
				$("#welcomeInfo").html(item.content);
			});
		  	
		});
};

//获取产品详情
function getProductInfo(id)
{
	
	window.location="productInfo.html?id="+id;
}
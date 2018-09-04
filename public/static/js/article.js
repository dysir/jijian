var doc = $(document);
var win = $(window);
$(function(){
	var catelogtop = $(".catalogwindow").offset().top;


	var uid = $("#uid").val();

	if(uid == ""||uid ==undefined )
	{
		return false;
	}
	$.ajax({
		url:"/index.php/Ajax/getUserInfo?uid="+uid,
		success:function(resInfo){
			var data = resInfo.data;
			if(resInfo.code == 1&&data&&(data['zfbcode']||data['wxcode']) )
			{
				$("#usernameinfo").attr("disabled",false);
				if(data['zfbcode']){
					data['zfbcode']!=""?$("#zfb_img").attr("src",data['zfbcode']):"";
				}else{
					$("#zfb_img").parent().parent().remove();
				}

				if(data['wxcode']){
					data['wxcode']!=""?$("#wx_img").attr("src",data['wxcode']):"";	
				}else{
					$("#wx_img").parent().parent().remove();
				}
				
			}
		}
	})

	var num = 0;
	var arrcatalog = [];

	$("h2").each(function(){
		var local = $(this).offset().top;
		var height = $(this).height();
		var title = $(this).text();
		var active = num?"":"active";
		num += 1;

		var str = '<a href="javascript:void(0)" class="list-group-item catalog_list_'+num+' '+active+' " >'+title+'</a>';
		$(".catalog").append(str);
		//每个标题距离文档顶部的高度，doc.scrollTop应该设置的高度
		var titletop = local+height-90;

		arrcatalog.push({
			c:'catalog_list_'+num,
			h:titletop-height
		});
		$(".catalog_list_"+num).on("click",function(){
			$(this).siblings().removeClass("active");
			$(this).addClass("active");
			doc.scrollTop(titletop);

		})
	})
	//防止频繁操作 ，一百毫秒以内操作只执行一次
	var timeoutRef;
	win.on("scroll resize", function(){
		if(timeoutRef){
        	clearTimeout(timeoutRef);
    	}
    	timeoutRef = setTimeout(winCalalog , 100);
	} );

	function winCalalog()
	{
		var doctop = doc.scrollTop();

		var ii = -1;
		for(var i in arrcatalog)
		{
			if(doctop <= arrcatalog[i]['h'])
			{
				ii = i==0?0:i-1;
				break;
			}
		}
		ii = ii == -1?arrcatalog.length-1:ii;

		if(arrcatalog[ii])
		{
			$("."+arrcatalog[ii]['c']).siblings().removeClass("active");
			$("."+arrcatalog[ii]['c']).addClass("active");
		}


		if(doctop+100 > catelogtop)
		{
			$(".catalogwindow").addClass("catalogwindow_fix");
		}else{
			$(".catalogwindow").removeClass("catalogwindow_fix");
		}

		if( win.width() <= 970 )
		{
			$(".catalogwindow").css("display","none");
		}else{
			$(".catalogwindow").css("display","block");
		}
	}

})



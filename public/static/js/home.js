var doc = $(document);
var win = $(window);
$(function(){
    doc.on("click",".article_open",function(){
    	var article_open = $(this);
    	var article_footer = article_open.parent().parent();
    	var aritlce_desc = article_footer.siblings(".article_content_dec");
    	var aritlce_cont = article_footer.siblings(".article_content");
    	
    	if( $.trim( article_open.text() ) == "展开内容")
    	{
    		article_open.text("收起内容");
    		aritlce_desc.hide();
    		aritlce_cont.show();


            var fixed = function(){

                var scrollHeight = doc.scrollTop() + win.height();
                var panelScroll = aritlce_cont.offset().top + aritlce_cont.height();

                if (scrollHeight - panelScroll < 80 && aritlce_cont.offset().top <doc.scrollTop() )
                {
                    if(!article_footer.hasClass("article_footer_fixed"))
                    {
                        article_footer.addClass("article_footer_fixed");
                        var docWidht = doc.width();
                        var md_width = (docWidht - article_footer.offset().left*2 )/12;
                        var right = md_width*4+article_footer.offset().left;
                        article_footer.css("right",right);
                        article_footer.width(md_width*8-30);
                    }

                }else{
                    article_footer.removeClass("article_footer_fixed");
                    article_footer.removeAttr("style");
                }
            }
            fixed();
            win.on("scroll", fixed );
    	}else{
    		article_open.text("展开内容");
    		aritlce_desc.show();
    		aritlce_cont.hide();
            article_footer.removeClass("article_footer_fixed");
            article_footer.removeAttr("style");
            doc.scrollTop(aritlce_desc.offset().top-90) ;
    	}

    })
})

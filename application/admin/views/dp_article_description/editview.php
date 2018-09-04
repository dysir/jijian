<link rel="stylesheet" type="text/css" href="<?=static_url('js/markdown/css/editormd.css')?>">
<link rel="stylesheet" type="text/css" href="<?=static_url('js/markdown/css/style.css')?>">
<h3 class="page-title">
<?php
echo empty($_current['mname'])?"":$_current['mname'];
?> 
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <?php
            echo empty($_current['mname'])?"":$_current['mname'];
			?> 
            <i class="fa fa-angle-right"></i>markdown
        </li>
    </ul>
</div>

<div class="row">
	<div class="col-md-6">
        <input type="" class="form-control articletitle" name="articletitle" placeholder="标题" value="<?php echo $articleinfo['title']; ?>">
    </div>
    <div class="col-md-6">
        <select class="form-control articletype">
        	<option value=-1>--分类--</option>
            <?php
            if(!empty($arrtopic)){
                foreach ($arrtopic as $key => $value) {
                    
                    $check = !empty($topicinfo['tid'])&&$topicinfo['tid'] == $value['tid']?"selected":"";
                    echo "<option ".$check." value='".$value['tid']."'>".$value['name']."</option>";
                }
            }
            ?>
        </select>
    </div>

</div>
<input type="text" value="<?php echo $_GET['article_id']; ?>" id="article_id" style="display: none;" name="">
<div class="row" style="margin-top: 20px;">
    <div class="col-md-6">
        <button class="btn btn-success col-md-12 savearticle ">保存</button>
    </div>
    <div class="col-md-6">
        <button class="cleararticle btn btn-danger col-md-12">清空</button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success editmsg"  style="margin: 20px 0px 0px  0px;padding:7px;" role="alert">
            欢迎使用编辑器 <span style="color:red">文章编辑页没有暂存，刷新新编辑内容将丢失</span>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 5px;">
    <div class="col-md-12" style="">
	    <div id="editormd">
            <textarea style="display:none;"><?php echo empty($articleinfo['markdown'])?"":$articleinfo['markdown'];?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success editmsg"  style="margin: 5px 0px 0px  0px;padding:7px;" role="alert">
            欢迎使用编辑器 <span style="color:red">文章编辑页没有暂存，刷新新编辑内容将丢失</span>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-md-6">
        <button class="btn btn-success col-md-12 savearticle ">保存</button>
    </div>
    <div class="col-md-6">
        <button class="cleararticle btn btn-danger col-md-12">清空</button>
    </div>
</div>

<script src="<?=static_url('js/markdown/editormd.js')?>" type="text/javascript"></script>
<script type="text/javascript">
    
    $(function() {
        editormd = editormd("editormd", {
            width   : "100%",
            height  : 640,
            syncScrolling : "single",
            path    : "/admin/static/js/markdown/lib/",
            htmlDecode:true,
            placeholder:"MarkDown or HTML",
            saveHTMLToTextarea:true,

        });

        $(".cleararticle").on("click",function(){
            if(!confirm("确认清空当前内容?")){
                return false;
            }
            editormd.clear();
            $(".articletype").val(-1);
            $(".articletitle").val("");
        })

        $(".savearticle").on("click",function(){

            var athml = editormd.getHTML();
            var amarkdown = editormd.getMarkdown();
            var articletitle = $(".articletitle").val();
            if(!articletitle){
                alertError("必须填写标题!");
                return false;
            }
            var articletype = $(".articletype").val();
            if(!articletype){
                alertError("必须选择类型");
                return false;
            }


            var aid = $("#article_id").val();
            $.loadajax({
                url:baseurl+"Dp_article_description/savearticle",
                type:"post",
                data:{
                    athml:athml,
                    amarkdown:amarkdown,
                    atitle:articletitle,
                    atype:articletype,
                    aid:aid
                },
                success:function(res){
                    if(res.code!=1){
                        $(".editmsg").html("<span style='color:red'>"+res.msg+"</span>");
                    }else{
                        $(".editmsg").text("保存成功。");
                    }
                }
            })


        })


    });
</script>
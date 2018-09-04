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
        <input type="" class="form-control articletitle" name="articletitle" placeholder="标题">
    </div>
    <div class="col-md-6">
        <select class="form-control articletype">
        	<option value=-1>--分类--</option>
            <?php
            if(!empty($arrtopic)){
                foreach ($arrtopic as $key => $value) {
                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                }
            }
            ?>
        </select>
    </div>

</div>
<input type="text" id="article_id" style="display: none;" name="">
<div class="row" style="margin-top: 20px;">
    <div class="col-md-6">
        <button class="btn btn-success col-md-12 savearticle ">保存</button>
    </div>
    <div class="col-md-6">
        <button class="cleararticle btn btn-danger col-md-12">清空</button>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <button class="btn btn-warning col-md-12 zssave">暂存数据库 (可点击暂存列表恢复，暂存将清空当前页)</button>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success editmsg"  style="margin: 20px 0px 0px  0px;padding:7px;" role="alert">
            欢迎使用编辑器...
        </div>
    </div>
</div>
<div class="row" style="margin-top: 5px;">
    <div class="col-md-12" style="">
	    <div id="editormd">
            <textarea style="display:none;"></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success editmsg"  style="margin: 5px 0px 0px  0px;padding:7px;" role="alert">
            欢迎使用编辑器...
        </div>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div class="col-md-12">
        <button class="btn btn-warning col-md-12 zssave">暂存数据库 (可点击暂存列表恢复，暂存将清空当前页)</button>
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
<div class="note note-success animated flipInX" style="margin-top: 20px;">
    <p>
        暂存数据库列表
    </p>
</div>

<div id="linkarticlelist">
    
    <?php
        if(!empty($linklist)){
            foreach ($linklist as $key => $value) {
    ?>

    <div class="row" style="margin-top: 5px;">
        <div class="col-md-6">
            <?=$value['title']?>
        </div>
        <div class="col-md-3">
            <?=$value['ctime']?>
        </div>
        <div class="col-md-3">
            <button aid="<?=$value['id']?>" class="hflinkaritcle btn btn-success delete btn-xs">
                <i class="fa fa-trash-o"></i>恢复
            </button>
            <button aid="<?=$value['id']?>"  class="dellinkaritcle btn btn-danger delete btn-xs">
                <i class="fa fa-trash-o"></i>删除
            </button>
        </div>
    </div>
    <?php
            }
        }
    ?>
</div>
<script src="<?=static_url('js/markdown/editormd.js')?>" type="text/javascript"></script>
<script type="text/javascript">
	var testEditor;
    
    if(window.localStorage){
        var db = window.localStorage;
    }else{
        var db = null;
        $(".editmsg").text("浏览器不支持临时数据库,不影响编辑但不能实时保存")
    }
    $(function() {


        editormd = editormd("editormd", {
            width   : "100%",
            height  : 640,
            syncScrolling : "single",
            path    : "/admin/static/js/markdown/lib/",
            htmlDecode:true,
            placeholder:"MarkDown or HTML",
            saveHTMLToTextarea:true,
            onchange:function(){
                if(db == null){
                    return false;
                }
                var articletitle = $(".articletitle").val();
                db.setItem("articletitle" , articletitle);

                var articletype = $(".articletype").val();
                db.setItem("articletype" , articletype);

                var md = this.getMarkdown();
                var date = new Date()
                db.setItem("linkarticle" , md);
                $(".editmsg").text(date.toUTCString()+" 已经做浏览器存储 ...")
            },
            onload:function(){
                var linkarticle = db.getItem("linkarticle");
                if(linkarticle){
                    this.setMarkdown(linkarticle);
                }
                var articletitle = db.getItem("articletitle");
                if(articletitle){
                    $(".articletitle").val(articletitle);
                }

                var articletype = db.getItem("articletype");
                if(articletype){
                    $(".articletype").val(articletype);
                }

            }
        });

        $(".cleararticle").on("click",function(){
            if(!confirm("确认清空当前内容?")){
                return false;
            }
            window.localStorage.clear();
            editormd.clear();
            $(".articletype").val(-1);
            $(".articletitle").val("");
        })

        $(".zssave").on("click" , function(){
            var athml = editormd.getHTML();
            var amarkdown = editormd.getMarkdown();
            var articletitle = $(".articletitle").val();
            if(!articletitle){
                alertError("必须填写标题!");
                return false;
            }
            var articletype = $(".articletype").val();

            $.loadajax({
                url:baseurl+"dp_article/zssave",
                type:"post",
                data:{
                    athml:athml,
                    amarkdown:amarkdown,
                    atitle:articletitle,
                    atype:articletype,
                },
                success:function(res){
                    if(res.code!=1){
                        $(".editmsg").html("<span style='color:red'>"+res.msg+"</span>");
                    }else{
                        $(".editmsg").text("暂存数据库成功。");
                        location.reload();
                    }
                }
            })
        })
        $(".dellinkaritcle").on("click" , function(){
            if(!confirm("删除后不可恢复 确认删除?")){
                return false;
            }
            var id = $(this).attr("aid");
            $.loadajax({
                url:baseurl+"dp_article/delzcsave",
                data:{
                    id:id,
                },
                success:function(res){
                    if(res.code!=1){
                        alertError(res.msg);
                        return false;
                    }else{
                        location.reload();
                    }
                }
            })
        })
        $(".hflinkaritcle").on("click" , function(){
            if(!confirm("恢复将覆盖当前编辑内容 , 确认恢复")){
                return false;
            }
            var id = $(this).attr("aid");
            $.loadajax({
                url:baseurl+"dp_article/hflinkaritcle",
                data:{
                    id:id,
                },
                success:function(res){
                    if(res.code!=1){
                        alertError(res.msg);
                        return false;
                    }else{
                        var data = res.data;
                        db.setItem("articletitle" , data['title']);
                        db.setItem("articletype" , data['tid']);
                        db.setItem("linkarticle" , data['amarkdown']);
                        location.reload();
                    }
                }
            })
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

            if(!confirm("保存将清空当前页内容,可在列表页查看,建议暂存再保存")){
                return false;
            }

            var aid = $("#article_id").val();
            $.loadajax({
                url:baseurl+"dp_article/savearticle",
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
                        window.localStorage.clear();
                        location.reload();

                    }
                }
            })


        })


    });
</script>
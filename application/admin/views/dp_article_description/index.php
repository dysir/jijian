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
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
</div>
<div class="note note-success">
    <p>
        描述...
    </p>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green-haze animated fadeInRight">
            <div class="portlet-title">
                <div class="caption">
                    <?php echo empty($_current['mname'])?"":$_current['mname'];?>
                </div>
            </div>
            <div class="portlet-body">
                <div class='row'>
                    <div class='col-md-12'>
                        <form method='get' action="/Dp_article_description/index">

                        </form>
                    </div>
                </div>
                <div class="table-responsive" style="margin-top:20px;">
                    <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        
						<th>文章ID</th>
						<th>标题</th>
						<th>作者名</th>
						<th>更新时间</th>
                        <th>状态</th>
						<th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (! empty($list)) {

                        $arrStatus = getTableColumnInfo("dp_article_description","status","colmunvalue");

                        foreach ($list as $key => $value) {    
                    ?>
                    <tr>
						<td><?php echo $value['article_id'];?></td>
						<td><?php echo $value['title'];?></td>
						<td><?php echo $value['uname'];?></td>
						<td><?php echo $value['mtime'];?></td>
                        <td><?php echo empty($arrStatus[$value['status']])?"":$arrStatus[$value['status']];?></td>
						<td>
                            <a href="<?=$_siteurl?>/Dp_article_description/editview?article_id=<?php echo $value['article_id'];?>"  class="btn blue-madison btn-xs"><i class="fa fa-edit"></i>编辑</a>
                            <button aid="<?php echo $value['article_id'];?>" astatus="9" class="changestatus btn btn-danger delete btn-xs"><i class="fa fa-trash-o"></i>删除</button>
                            <?php
                                if($value['status'] == 2){
                            ?>
                                <button aid="<?php echo $value['article_id'];?>" astatus="1" class="changestatus btn btn-warning delete btn-xs"><i class="fa fa-trash-o"></i>下线</button>
                            <?php
                                }else{
                            ?>
                                <button aid="<?php echo $value['article_id'];?>" astatus="2" class="changestatus btn btn-success delete btn-xs"><i class="fa fa-trash-o"></i>发布</button>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <?php
            echo $page_view;
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $(".changestatus").on("click",function(){
        if(!confirm("确认修改")){
            return false;
        }
        var aid = $(this).attr("aid");
        var astatus = $(this).attr("astatus");

        $.loadajax({
            url:baseurl+"Dp_article_description/changestatus",
            data:{
                aid:aid,
                astatus:astatus,
            },
            success:function(res){
                if(res.code!=1){
                    alertError(res.msg);
                    return
                }
                location.reload();
            }
        })
    })
})
</script>
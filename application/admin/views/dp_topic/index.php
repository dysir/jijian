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
                        <input type="text" name="addtopic" class="form-control input-inline input-medium" placeholder="添加分类">
                        <button id="addtopic" class="btn btn-danger">添加分类</button>
                    </div>
                </div>
                <div class="table-responsive" style="margin-top:20px;">
                    <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>分类ID</th>
                        <th>分类名</th>
                        <th>创建时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (! empty($list)) {
                        foreach ($list as $key => $value) {
                            
                    ?>
                    <tr>
                        <td><?php echo $value['id'];?></td>
                        <td><?php echo $value['name'];?></td>
                        <td><?php echo $value['ctime'];?></td>
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
        $("#addtopic").on("click",function(){

            var tname = $("input[name=addtopic]").val();
            if(!tname){
                alertError("不能为空");
            }
            $.loadajax({
                url:baseurl+"dp_topic/addtopic?topic="+tname,
                success:function(res){
                    if(res.code==1)
                    {
                        location.reload();
                    }else{
                        alertError(res.msg);
                    }
                },error:function(){
                    alertError("添加失败，请重试");
                }
            })
        })
    })
</script>
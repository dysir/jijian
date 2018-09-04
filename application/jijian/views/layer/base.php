<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php $_titleHome =c("title");  echo $_titleHome.=(!empty($_title)?"_".$_title:"");  ?></title>
    <meta name="keywords" content="<?php echo $_seo['keywords'];?>" />
    <meta name="description" content="<?php echo $_seo['description'];?>"/>
    <link href="<?=asset('static/bootstrap/dist/css/bootstrap.css')?>" rel="stylesheet">
    <link href="<?=asset('static/css/my.css')?>" rel="stylesheet">
    <script src="<?=asset('static/js/jquery.min.js')?>"></script>
    <script src="<?=asset('static/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style type="text/css">
  body { 
    padding-top: 70px; 
  }
  .footer{
    border-top: 4px solid #eee;
    height: 50px;
    background: white;
    text-align: center;
  }
  .footer h5{
    line-height:55px;
  }
  </style>
  <body>
    <?php
    echo empty($tmp_SIDE)?"":$tmp_SIDE;
    ?>
    <div class="container">
    <?php
    echo empty($tmp_BODY)?"":$tmp_BODY;
    ?>
    </div>
    <div class="footer">

      <h5>编程笔记&nbsp;&nbsp;&nbsp;&nbsp;<a href="codebooks.cn">codebooks.cn</a>&nbsp;&nbsp;&nbsp;&nbsp;备案号：京ICP备14051145号</h5>
    </div>
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?68813ca1f31b2d65536d7018bbf2964c";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>

  </body>
</html>
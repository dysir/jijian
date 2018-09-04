<script type="text/javascript" src="<?=asset('static/js/article.js')?>"></script>

<div class="col-md-8">
	<div class="row">
		<div class="col-md-12">
    <?php
    if(!empty($article_topic))
    {
      foreach ($article_topic as $key => $value) {
        echo "<a href='{$_siteurl}/topic/".$key."' class='btn btn-success topic'>".$value."</a>";
      }
    }
    ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
			  <h1><?php echo empty($article['title'])?"":$article['title'];?></h1>
			</div>
			<div class="article_content">
			<?php echo empty($article['content'])?"":$article['content'];?>
			</div>
			<div class="donate">
				<button type="button" disabled="true" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#donate" id="usernameinfo">
        <?php echo empty($article['uname'])?"":$article['uname'];?>
				</button>
        <input type="" id="uid" value="<?php echo empty($article['uid'])?"":$article['uid'];?>" style="display: none;">
			</div>
		</div>
	</div>
</div>
<div class="col-md-4">
  <?php
  $arrTopicView = array(
      'arrTopiclist'=>$topiclist
    );
  load_component("topic_list" , $arrTopicView);
  ?>
  <div class="row catalogwindow">
    <div class="col-md-12">
      <?php
      $arrTopicView = array(
          'tmp_TITLE'=>"目录",
          'tmp_ICON'=>"glyphicon glyphicon-book"
        );
      load_component("home_title" , $arrTopicView);
      ?>
        <div class="list-group catalog">

        </div>
      <!-- </div> -->
    </div>
  </div>
</div>
<div class="modal fade" id="donate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">捐赠作者</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="thumbnail">
              <img src="" alt="..." id="zfb_img">
              <div class="caption">
                <h3>支付宝</h3>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="thumbnail">
              <img src="" alt="..." id="wx_img">
              <div class="caption">
                <h3>微信</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">感谢捐赠</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
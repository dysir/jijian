<script type="text/javascript" src="<?=asset('static/js/home.js')?>"></script>
<div class="col-md-8">
	<?php
	$home_title_data = empty($home_title_data)?array():$home_title_data;
	load_component("home_title" , $home_title_data);
	if(!empty($list))
	{
		foreach ($list as $article) {
			extract($article);
	?>
	<div class="row" >
		<div class="col-md-12">
			<div class="form_source">
				<a href="" class="form_source_title"><?php echo empty($uname)?"":$uname;?></a> <span class="form_source_title_small"><?php echo empty($udescription)?"作者很懒，啥也没说":$udescription; ?></span>
			</div>
			<a href="<?=$_siteurl?>/home/<?php echo empty($article_id)?"":$article_id;?>" class="article_title h4"><?php echo empty($title)?"":$title;?>
			</a>
		</div>
		<div class="col-md-12 article_content_dec">
			<?php
	    	if(!empty($thumbnail))
	    	{
	    	?>
			<div class="media">
			  <div class="media-left">
			    <a href="#">
			    <img src='<?php echo $thumbnail;?>' width='190px;'>
			    </a>
			  </div>
			  <div class="media-body">
			  <?php echo empty($description)?"":$description;?>
			  </div>
			</div>
			<?php
			}else{
				echo empty($description)?"":$description;
			}
	    	?>
		</div>
		<div class="col-md-12 article_content" style="display: none;">
			  <?php echo empty($content)?"":$content;?>
		</div>
		
		<div class="col-md-12 article_footer">
			<div class="row ">
				<div class="col-md-3">
					<span class="glyphicon glyphicon-pencil"></span> <?php echo strData($ctime);?>
				</div>
				<div class="col-md-offset-6 col-md-3 article_open">
					展开内容
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="article_line">
			</div>
		</div>
	</div>
	<?php
		}
	}
	?>
</div>
<div class="col-md-4">
	<?php
	$arrTopicView = array(
			'arrTopiclist'=>$topiclist
		);
	load_component("topic_list" , $arrTopicView);
	?>
</div>
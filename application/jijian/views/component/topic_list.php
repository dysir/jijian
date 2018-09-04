<style type="text/css">
	.topic{
		margin-left: 10px;
		margin-top:10px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<?php
		$arrTopic = array(
				'tmp_ICON'=>"glyphicon glyphicon-tags",
				'tmp_TITLE'=>"标签",
			);
		load_component("home_title",$arrTopic);
		if($arrTopiclist)
		{
			echo "<a href='/' class='btn btn-success topic'>全部内容</a>";
			foreach ($arrTopiclist as $key => $value) {
				echo "<a href='{$_siteurl}/topic/".$key."' class='btn btn-success topic'>".$value."</a>";
			}
		}
		?>
	</div>
</div>
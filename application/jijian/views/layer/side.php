<nav class="navbar navbar-inverse navbar-fixed-top">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"><?php echo c("title");?></a>
  </div>
  <div class="container">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
        $menulistconfig = c("menu_config");
        if(!empty($menulistconfig))
        {
          foreach ($menulistconfig as $menu) {
            if(empty($menu['list']))
            {
              $property = empty($menu['property'])?"":$menu['property'];
               echo "<li><a {$property} href='{$menu['url']}'>{$menu['name']}</a></li>";
            }else{
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menu['name'];?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
            foreach ($menu['list'] as $v) {
              $property = empty($v['property'])?"":$v['property'];

              echo "<li><a {$property} href='{$v['url']}'>{$v['name']}</a></li>";
            }
            ?>
          </ul>
        </li>
        <?php
            }
          } 
        }

        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
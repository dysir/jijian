<?php
class MY_Loader extends CI_Loader {
    
    public function __construct() {
        parent::__construct ();
    }
    public function myview($body, $data = array() ) {

        $ci = &get_instance();
        //获取页面seo信息
        $class = !empty($this->my_class)?$this->my_class:$ci->router->fetch_class();
        $method = !empty($this->my_method)?$this->my_method:$ci->router->fetch_method();

        if(empty($data['_seo']))
        {
            $arrSeo =empty(c("seo")[$class][$method])?c("seo")['default']:c("seo")[$class][$method];
        }else{
            $arrSeo = $data['_seo'];
        }

        $template['_seo'] = $arrSeo;

        $data['_siteurl'] = site_url();


        //加载页面
        $template['tmp_SIDE'] = $this->view("layer/side" , array(
            '_siteurl'=>site_url()
        ) ,true); 

        $template['tmp_BODY'] = $this->view($body , $data ,true);
        $this->view( "layer/base" , $template);
    }

    public function show_404()
    {
        $this->myview( "errors/my_404");
        return false;
    }
}
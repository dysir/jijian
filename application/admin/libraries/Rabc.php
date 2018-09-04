<?php

class Rabc
{

    public function check($a)
    {
        $a = strtolower($a);
        $ci = & get_instance();
        $ci->load->library('session');
        $userinfo = $ci->session->userdata("user_info");
        $level = $userinfo['level'];
        $right = $userinfo['right'];

        if ($level == 8) {
            return true;
        }
        // 只有超级管理员才有权限
        if ($level != 8 && $a == "superadmin") {
            return false;
        }
        if ($level == 4) {
            return true;
        }
        // 普通管理员有权限访问
        if ($level > 1 && $a == "normaladmin") {
            return true;
        }
        
        if ($a == "") {
            return false;
        }
        
        $arrRight = json_decode($right, true);
        if (empty($arrRight) || ! in_array($a, $arrRight)) {
            return false;
        }
        return true;
    }

    /*
     * 获取左侧导航目录
     * return
     * arrmenu
     * current
     */
    function getMenu()
    {
        $CI = &get_instance();
        
        $CI->load->model('admin/Manage_model');
        
        $arrMenuList = $CI->Manage_model->getMenu();
        
        $arrRes = array();
        $arrCurent = array(
            'mname' => '',
            'desription' => '',
            'url' => '',
            'parent' => ''
        );
        $resFd = $CI->router->fetch_directory();
        $atfunc =  empty($resFd)?"/":"/".$CI->router->fetch_directory();
        $arfuncNoIndex = $atfunc;

        $arfuncNoIndex.=($CI->router->fetch_method() == 'index'?$CI->router->fetch_class():$CI->router->fetch_class()."/".$CI->router->fetch_method());
        $atfunc .= $CI->router->fetch_class()."/".$CI->router->fetch_method();

        $atfunc = strtolower($atfunc);
        $arfuncNoIndex = strtolower($arfuncNoIndex);

        if (! empty($arrMenuList)) {
            $arrLinkMenu = array();
            foreach ($arrMenuList as $key => $arrMenu) {
                $bool = false;
                if(strpos($arrMenu['url'], "?") ){
                    $requesturl = substr($_SERVER["REQUEST_URI"], 0,1)=="/"?substr($_SERVER["REQUEST_URI"], 1):$_SERVER["REQUEST_URI"];

                    $arrmenuurl = substr($arrMenu['url'], 0,1)=="/"?substr($arrMenu['url'], 1):$arrMenu['url'];


                    if(substr($requesturl, 0,strlen($arrmenuurl)) == $arrmenuurl){
                        $bool = true;
                    }
                }
                if (strtolower($arrMenu['url']) == $atfunc||strtolower($arrMenu['url']) == $arfuncNoIndex||$bool) {
                    $arrCurent = array(
                        'mname' => $arrMenu['mname'],
                        'desription' => $arrMenu['desription'],
                        'url' => $arrMenu['url'],
                        'parent' => $arrMenu['parent']
                    );
                }
                
                ! isset($arrLinkMenu[$arrMenu['id']]) ? $arrLinkMenu[$arrMenu['id']] = array() : "";
                
                if (empty($arrMenu['parent'])) {
                    $arrMenu['_list'] = &$arrLinkMenu[$arrMenu['id']];
                    $arrRes[] = $arrMenu;
                } else {
                    $arrLinkMenu[$arrMenu['parent']][] = $arrMenu;
                }
            }
        }
        //是否为管理员
        if(!$this->check(''))
        {
            $CI = & get_instance();
            $CI->load->library('session');
            $userinfo = $CI->session->userdata("user_info");
            $right = $userinfo['right'];
            $arrRight = json_decode($right, true);
            foreach ($arrRes as $key => $info) {
                if(!empty($info['_list']) )
                {
                    foreach ($info['_list'] as $k => $v) {
                        if(!empty($v['action']) && !in_array($v['action'], $arrRight))
                        {
                            unset($arrRes[$key]['_list'][$k]);
                            unset($info['_list'][$k]);
                        }
                    }
                    if(empty($info['_list']))
                    {
                        unset($arrRes[$key]);
                    }
                }else{
                    if(!empty($info['action']) && !in_array($info['action'], $arrRight))
                    {
                        unset($arrRes[$key]);
                    }
                }

            }
        }
        return array(
            "arrmenu" => $arrRes,
            "current" => $arrCurent
        );
    }
    //获取当前访问方法
    function getCurrentFunc()
    {
        $CI =& get_instance();

        $resFunc = "";
        $reFd = $CI->router->fetch_directory();
        $resFunc = empty($reFd)?"/":"/".$CI->router->fetch_directory();
        $resFunc .= $CI->router->fetch_class()."/".$CI->router->fetch_method();
        return strtolower($resFunc);
    }
}
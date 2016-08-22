<?php
    list($usec, $sec)   =   explode(' ', microtime());
    define('BOF_TIME', (float)$usec + (float)$sec);
    require ROOT_PATH . '/core/lib/firefox/firefox_FB.php';
    require ROOT_PATH . '/core/lib/firefox/firefox_FirePHP.php';

    /**
     * 核心调试输出函数
     */
    function _sf()
    {
        call_user_func_array('fb', func_get_args());
    }

    /**
     * 终结函数
     */
    function _quit($msg = '')
    {
        echo $msg;
        list($usec, $sec) = explode(' ', microtime());
        define('EOF_TIME', (float)$usec + (float)$sec);
        _sf('---------------- 资源汇总 ----------------');
        _sf('消耗时间: ' . number_format((EOF_TIME - BOF_TIME) , 3) . ' s');
        _sf('消耗内存: ' . number_format((memory_get_usage() / 1024 / 1024) , 2) . ' MB');
        exit;
    }
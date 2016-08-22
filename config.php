<?php
    error_reporting(E_ALL);
    define('DS', DIRECTORY_SEPARATOR);
    /**
     * 函数运行模式，对应core/fun/xxx.php文件
     * default  为默认模式，一般用于默认配置的运行环境
     * debug    为调试模式，一般用于开发配置的运行环境
     */
    define('FUN_MODE', 'debug');

    /**
     * 数据库模式，对应core/db/xxx.php文件
     */
    define('DB_MODE', 'mysql');
    /**
     * 数据库服务器路径
     */
    define('DB_HOST', 'localhost');
    /**
     * 数据库名称
     */
    define('DB_NAME', 'sf');
    /**
     * 数据库访问用户
     */
    define('DB_USER', 'root');
    /**
     * 数据库访问密码
     */
    define('DB_PASSWORD', '');
    /**
     * 数据库名称前缀
     */
    define('DB_PREFIX', '');
    /**
     * 数据库表名前缀
     */
    define('DB_TABLE_PREFIX', '');

    /**
     * 根路径 d:/www/sf
     */
    define('ROOT_PATH', dirname(__FILE__));
    /**
     * 基目录  d:/www/sf -> sf
     */
    $basedir = ltrim(dirname($_SERVER['SCRIPT_NAME']));
    $basedir = ($basedir === DS ? '' : $basedir);
    define('BASE_DIR', $basedir);
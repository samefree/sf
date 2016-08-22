<?php
    /**
     * 自动加载类
     * @param  String $className 类名
     * @return void
     */
    function __autoload($className)
    {
        $path = str_replace('_', DS, $className);
        $fullPath = ROOT_PATH . DS . $path . '.php';

        if (is_file($fullPath)) {
            require $fullPath;
        }
    }

    /**
     * @param  String $number 编号
     * @param  Mixed $prefix 对象或前缀字符串
     * @return String 返回的代码
     */
    function _code($number, $prefix = null)
    {
        if ($prefix === null) {
            return $number;
        }
        if (is_string($prefix)) {
            return $prefix . '_' . $number;
        }
        if (is_object($prefix)) {
            return get_class($prefix) . '_' . $number;
        }
        return $number;
    }

    /**
     * 根据类名获取对象不同域下的单例
     * @param String $name      例如 Core_Base
     * @param Object $object    单例的域
     * @param Array  $scope     单例的域组
     * @param Mixed  $arg       可选，多个参数用于初始化构造函数
     * @return Object 返回的类对象
     */
    function _instance($className, $object = null, $scope = null)
    {
        $argList = array_slice(func_get_args(), 3);
        $pathClassName = str_replace('_', DS, $className);
        $exCurFilePath = ROOT_PATH . DS . 'Theme' . DS . THEME_CUR . 'Plugin' . DS . $pathClassName . '.php';
        $isExtended = false;
        if (file_exists($exCurFilePath)) {
            $isExtended = true;
        } else {
            $exDefFilePath = ROOT_PATH . DS . 'Theme' . DS . THEME_DEF . 'Plugin' . DS . $pathClassName . '.php';
            if (file_exists($exDefFilePath)) {
                $isExtended = true;
            }
        }
        if ($isExtended) {
            $className = 'Ex_' . $className;
        }
        /**
         * 若 $object 不为 null，则返回 $object 范围下的单例，
         * 否则遍历 $scope 范围下单例，若不存在，则返回全局单例。
         */
        if (is_object($object)) {
            $objName = get_class($object);
            if (!isset($GLOBALS['instances'][$objName][$className])) {
                $GLOBALS['instances'][$objName][$className] = new $className();
            }
            $GLOBALS['instances'][$objName][$className]->apply($argList);
            return $GLOBALS['instances'][$objName][$className];
        } else {
            if (is_array($scope)) {
                foreach ($scope as $key => $objName) {
                    if (isset($GLOBALS['instances'][$objName][$className])) {
                        $GLOBALS['instances'][$objName][$className]->apply($argList);
                        return $GLOBALS['instances'][$objName][$className];
                    }
                }
            }
        }
        if (class_exists($className)) {
            if (!isset($GLOBALS['instances']['__'][$className])) {
                $GLOBALS['instances']['__'][$className] = new $className();
            }
            $GLOBALS['instances']['__'][$className]->apply($argList);
            return $GLOBALS['instances']['__'][$className];
        }
        return null;
    }

    /**
     * 核心调试输出函数
     */
    function _sf()
    {
    }

    /**
     * 执行错误逻辑
     * @param  Mixed $errors 错误信息
     */
    function _error($errors = null)
    {
        if ($errors) {
            $GLOBALS['errors'] = $errors;
        }
        ob_clean();
        $errors = print_r(func_get_args(), true);
        if (!empty($errors)) {
            $number = md5($errors);
            file_put_contents(ROOT_DIR . DS . 'asset' . DS . 'internal' . DS . 'report' . DS . $number . '.txt', $errors);
            $GLOBALS['report'] = $number;
        }
        include ROOT_PATH . DS . 'error.phtml';
        _quit();
    }

    /**
     * 终结函数
     */
    function _quit($msg = '')
    {
        echo $msg;
        exit;
    }
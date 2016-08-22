<?php
    /**
    *   系统基类
    */
    class Core_Base
    {
        /**
         * 错误集合数据
         * @var Array
         */
        protected $error;
        /**
         * 数据集合
         * @var Array
         */
        protected $data;

        /**
         * 类名
         * @var String
         */
        protected $className;

        /**
         * 最后代码
         * @var String
         */
        protected $lastCode;

        public function __construct()
        {
            $this->className = get_class($this);
        }

        /**
         * 传参（配置）重走构建逻辑
         * @param  Mixed 构造参数
         * @return void
         */
        public function apply($argList)
        {
            if (!empty($argList)) {
                call_user_func_array(array($this, '__construct'), $argList);
            }
        }

        /**
         * 获取代码
         * @param  String $number 代码
         * @return String 返回代码
         */
        public function code($number, $fun = null)
        {
            $prefix = $fun === null ? $this->className : $this->className . '_' . $fun;
            $this->lastCode = _code($number, $prefix);
            return $this->lastCode;
        }

        /**
         * 判断代码是否正确
         * @param  String $number 代码
         * @param  String $fun 函数名称
         * @param  String $byNumber 依据代码
         * @return boolean 是否相等
         */
        public function isCode($number, $fun = null, $byNumber = null)
        {
            if ($byNumber === null) {
                $byNumber = $this->lastCode;
            }
            $prefix = $fun === null ? $this->className : $this->className . '_' . $fun;
            return strtolower(_code($number, $prefix)) == strtolower($byNumber);
        }

        /**
         * 设置错误
         * @param String $msg 错误信息
         * @param String $code 错误代码
         * @param Mixed $data 相关数据
         * @param String $key 错误Key
         * @param String 处理的错误Key
         */
        public function setError($msg, $code = 0, $data = null, $key = null)
        {
            $data = array('msg' => $msg, 'code' => $code, 'data' => $data);
            if ($key === null) {
                $this->error[] = $data;
                return count($this->error);
            }
            $this->error[$key] = $data;
            return $key;
        }

        /**
         * 获取错误
         * @param  String $key 错误Key
         * @return Array 错误的相关信息
         */
        public function getError($key = null)
        {
            if ($key === null) {
                return current($this->error);
            }
            return $this->error[$key];
        }

        /**
         * 获取错误集合
         * @return Array 整个错误信息
         */
        public function getErrors()
        {
            return $this->error;
        }

        /**
         * 设置数据
         * @param String $key 数据Key
         * @param Mixed $value 存储数据
         * @param Boolean $append 是否追加
         */
        public function setData($key, $value, $append = false)
        {
            if ($append !== false) {
                if (!empty($this->data[$key])) {
                    if (is_array($this->data[$key])) {
                        $this->data[$key][] = $value;
                    } else {
                        $this->data[$key] .= $value;
                    }
                } else {
                    $this->data[$key] = $value;
                }
            } else {
                $this->data[$key] = $value;
            }
            return true;
        }

        /**
         * 获取数据
         * @param  String $key 数据Key
         * @return Mixed 返回相关Key的数据
         */
        public function getData($key)
        {
            return $this->data[$key];
        }
    }
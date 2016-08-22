<?php
    /**
     * 后台模型
     */
    class Core_Modal_Admin extends Core_Modal
    {
        /**
         * 加密字符串
         * @param  String $str 需要加密的字符串
         * @return String 加密后的字符串
         */
        public function encode($str)
        {
            $rand = substr(md5(rand(1, time())), rand(1, 10), 2);
            $str1 = substr($rand, 0, 1);
            $str2 = substr($rand, 1, 1);
            $number = (int)(is_numeric($str1) ? $str1 : is_numeric($str2) ? $str2 : strlen($str) / 2);
            $leftStr = substr($str, 0, $number);
            $rightStr = substr($str, $number);
            return md5($leftStr . $str2 . $rightStr . $str1) . ':' . $rand;
        }

        /**
         * 判断原密文跟加密文是否正确
         * @param  String $str 未加密的字符串
         * @param String $eStr 已加密的字符串
         * @return Boolean 是否正确
         */
        public function check($str, $eStr)
        {
            $array = explode(':', $eStr);
            if (count($array) !== 2) {
                return false;
            }
            $str1 = substr($array[1], 0, 1);
            $str2 = substr($array[1], 1, 1);
            $number = (int)(is_numeric($str1) ? $str1 : is_numeric($str2) ? $str2 : strlen($str) / 2);
            $leftStr = substr($str, 0, $number);
            $rightStr = substr($str, $number);
            return md5($leftStr . $str2 . $rightStr . $str1) == $array[0];
        }

        /**
         * 登录管理员
         * @param  String $account 登录账号
         * @param  String $password 登录密码
         * @return Boolean 是否成功
         */
        public function login($account, $password)
        {
            $base = $this->db->select()->from(DB_TABLE_PREFIX . 'admin');
            $base->where('admin__account = ?', $account);
            $base->limit(1);
            $admin = $this->db->fetchRow($base);
            if (empty($admin)) {
                $this->setError('找不到用户！', $this->code(404));
                return false;
            }
            if (!$this->check($password, $admin['admin__password'])) {
                $this->setError('密码不正确！', $this->code(403));
                return false;
            }
            return true;
        }
    }
<?php
    set_include_path(ROOT_PATH . '/Core/Lib');
    require ROOT_PATH . '/Core/Lib/Zend/Db.php';
    /**
    * MYSQL的数据基类
    */
    class Core_Db extends Core_Base implements Core_Idb
    {
        protected $db;

        public function open()
        {
            if (!$this->db) {
                try {
                    $config = array (
                        'host'     => DB_HOST
                        , 'username' => DB_USER
                        , 'password' => DB_PASSWORD
                        , 'dbname'   => DB_PREFIX . DB_NAME
                    );
                    $this->db = Zend_Db::factory('PDO_MYSQL', $config);
                    if ($this->db) {
                        $this->db->query("SET NAMES UTF8");
                        $this->db->query("SET time_zone = '" . SYS_TIME_ZONE . "'");
                        $this->db->getProfiler()->setEnabled(true);
                        _sf('成功连接数据库！');
                    } else {
                        _error('Data connection not');
                    }
                } catch (Exception $e) {
                    _error($e);
                }
            }
        }

        public function close()
        {
            if ($this->db) {
                $this->db->closeConnection();
                _sf('成功断开数据库！');
                return true;
            }
            return false;
        }
    }
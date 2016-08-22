<?php
    /**
    *   核心模型类
    */
    class Core_Modal extends Core_Db
    {
        public function __construct() {
            parent::__construct();
            $this->open();
        }

        public function __destruct()
        {
            $this->close();
        }
    }
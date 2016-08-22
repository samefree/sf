<?php
    require 'config.php';
    require 'Core/Fun/' . FUN_MODE . '.php';
    require 'Core/Db/' . DB_MODE . '.php';
    require 'var.php';
    $aModal = _instance('Core_Modal_Admin');
    $result = $aModal->login('admin', '123456');
    if (!$result) {
        if ($aModal->isCode(403)) {
            _sf($aModal->getError());
        }
    }
    _quit();
<?php
    /**
     * Created by PhpStorm.
     * User: timeteam
     * Date: 18-12-3
     * Time: 下午3:10
     */

    return [
        'id' => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix' => 'admin_',
        // 驱动方式 支持redis memcache memcached
        'type' => 'redis',

        'host' => 'redis',

        'select' => '8',
        // 是否自动开启 SESSION
        'auto_start' => true,
    ];
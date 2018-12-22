<?php
    /**
     * Created by PhpStorm.
     * User: timeteam
     * Date: 18-12-3
     * Time: 下午3:08
     */

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------
    return [
        // 驱动方式
        'type' => 'redis',
        //主机地址
        'host' => 'redis',
        'select' => '8',
        // 缓存保存目录
        // 'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => 'cache_admin_',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ];
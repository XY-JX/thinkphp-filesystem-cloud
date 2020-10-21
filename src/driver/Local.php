<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
declare(strict_types=1);

namespace xy_jx\filesystem\driver;

use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\AdapterInterface;
use xy_jx\filesystem\traits\Storage;
use think\filesystem\Driver;

class Local extends Driver
{
    use Storage;
    /**
     * 配置参数.
     *
     * @var array
     */
    protected $config
        = [
            'root' => '',
        ];

    protected function createAdapter(): AdapterInterface
    {
        $permissions = $this->config['permissions'] ?? [];

        $links = ($this->config['links'] ?? null) === 'skip'
            ? LocalAdapter::SKIP_LINKS
            : LocalAdapter::DISALLOW_LINKS;

        return new LocalAdapter(
            $this->config['root'], LOCK_EX, $links, $permissions
        );
    }
}

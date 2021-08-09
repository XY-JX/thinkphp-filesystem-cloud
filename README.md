
<h1><p align="center">thinkphp-filesystem-cloud</p></h1>
<p align="center"> thinkphp6.0 的文件系统扩展包，支持上传阿里云OSS和七牛和腾讯云COS</p>

## 包含

1. php >= 7.1
2. thinkphp >=6.0.0
3. guzzlehttp/guzzle  >= 6.3

   对[guzzlehttp/guzzle 7](https://github.com/XY-JX/thinkphp-filesystem-cloud/tree/dev) 的支持

   对[guzzlehttp/guzzle 7](https://github.com/XY-JX/thinkphp-filesystem-cloud/tree/dev) 的支持

## 支持

1. 阿里云
2. 七牛云
3. 腾讯云

## 计划
1. 支持华为云

## 安装
第一步：
```shell
$ composer require xy_jx/thinkphp-filesystem-cloud 
```
第二步：
在config/filesystem.php中添加配置

```
'aliyun' => [
    'type'         => 'aliyun',
    'accessId'     => '******',
    'accessSecret' => '******',
    'bucket'       => 'bucket',
    'endpoint'     => 'oss-cn-hongkong.aliyuncs.com',
    'url'          => 'http://oss-cn-hongkong.aliyuncs.com',//不要斜杠结尾，此处为URL地址域名。
],
'qiniu'  => [
    'type'      => 'qiniu',
    'accessKey' => '******',
    'secretKey' => '******',
    'bucket'    => 'bucket',
    'url'       => '',//不要斜杠结尾，此处为URL地址域名。
],
'qcloud' => [
    'type'       => 'qcloud',
    'region'      => '***', //bucket 所属区域 英文
    'appId'      => '***', // 域名中数字部分
    'secretId'   => '***',
    'secretKey'  => '***',
    'bucket'          => '***',
    'timeout'         => 60,
    'connect_timeout' => 60,
    'cdn'             => '您的 CDN 域名',
    'scheme'          => 'http',
    'read_from_cdn'   => false,
]
```

第三步：
开始使用。
```
<?php

namespace app\controller;

use app\BaseController;
use app\Request;
use think\facade\Filesystem;

/**
 * 公共类
 * Class PublicController
 * @package app\api\controller
 */
class PublicController extends BaseController
{
    /**
     * 图片上传
     * @param Request $request
     * @return \think\response\Json
     */
    public function upload_image(Request $request)
    {
            $file = $request->file('file');
            if ($file) {
                //验证文件
                $this->validate($request->file(), ['file' => 'fileSize:10485760|fileMime:image/jpeg,image/png|file']);
                // 上传到阿里云oss
                $savename = Filesystem::disk('aliyun')->putFile('', $file);
                $result = [
                    'type' => $file->getMime(),
                    'extension' => $file->extension(),
                    'url' => $savename,
                    'full_url' => $type['url'] . $savename,
                ];
                return \Api::success($result);
            } else {
                return \Api::error(-1, '没有上传文件');
            }
    }
}

```
请参考thinkphp文档
文档地址：[https://www.kancloud.cn/manual/thinkphp6_0/1037639 ](https://www.kancloud.cn/manual/thinkphp6_0/1037639 )


## 授权

MIT

## 感谢
1. thinkphp
2. xxtime/flysystem-aliyun-oss
3. liz/flysystem-qiniu
4. league/flysystem
5. overtrue/flysystem-cos

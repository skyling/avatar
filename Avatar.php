<?php

/**
 * 头像类
 * author: v_frli <frenlee@163.com>
 * since: 2015/12/11 15:31
 */
require_once './vendor/autoload.php';
class Avatar
{
    private $identicon ;
    function __construct()
    {
        $this->identicon = new \Identicon\Identicon();
    }

    /**
     * 根据URL获取图像
     * 使用_区分开三个参数 字符串_大小.png
     */
    public function getByUrl()
    {
        $uri = $_SERVER['REQUEST_URI'];//获取到url地址
        $uri = !empty($uri) ? $uri : md5(time());
        if (0 === preg_match('/.*[\?=\/](.*)\..+/', $uri, $matches)) {
            $matches[1] = $uri.'_512.png';
        }
        $matches = explode('_', $matches[1]);
        $string = isset($matches[0]) ? $matches[0] : time();
        $string = md5($string);
        $size   = isset($matches[1]) && (intval($matches[1])!=0) ? intval($matches[1]) : 512;
        $color  = substr($string, 0, 6);
        $bgColor  = substr($string, -6);
        $this->identicon->displayImage($string, $size, $color, $bgColor);
    }
}

/*  End of file Avatar.php*/
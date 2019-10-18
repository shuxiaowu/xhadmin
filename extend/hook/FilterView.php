<?php

namespace hook;

use think\Request;

/**
 * 视图输出过滤
 * Class FilterView
 * @package hook
 * @author Anyon <zoujingli@qq.com>
 * @date 2017/04/25 11:59
 */
class FilterView
{

    /**
     * 当前请求对象
     * @var Request
     */
    protected $request;

    /**
     * 行为入口
     * @param $params
     */
    public function run(&$params)
    {
        $this->request = Request::instance();
        $appRoot = $this->request->root(true);
        $replace = [
            '__APP__'    => $appRoot,
            '__SELF__'   => $this->request->url(true),
            '__PUBLIC__' => strpos($appRoot, EXT) ? ltrim(dirname($appRoot), DS) : $appRoot,
        ];
        $params = str_replace(array_keys($replace), array_values($replace), $params);
//         !IS_CLI && $this->baidu($params);
    }

  
}

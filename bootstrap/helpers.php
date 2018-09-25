<?php
    /**
     * 将当前路由名称替换为css名称
     * @return mixed
     */
    function route_class()
    {
        return str_replace('.','-',Route::currentRouteName());
    }

    function make_excerpt($value,$length=200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return str_limit($excerpt, $length);
    }
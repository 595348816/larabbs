<?php
    /**
     * 将当前路由名称替换为css名称
     * @return mixed
     */
    function route_class()
    {
        return str_replace('.','-',Route::currentRouteName());
    }
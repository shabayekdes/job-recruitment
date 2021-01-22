<?php 

if (! function_exists('getQueryUrl')) {
    function getQueryUrl($url) {

        if(count(request()->except('page')) != 0){
            $url .= '&';
            $url .= http_build_query(request()->except('page'), '', '&');
        }

        return $url;
    }
}
<?php
       function c_url() {
        $cUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $vUrl = str_replace("&", "&amp;", $cUrl);

        return $vUrl;
    }
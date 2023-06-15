<?php

namespace Includes;

Class Sessions
{
    function sessionStart($lifetime, $path, $domain, $security, $httpOnly){
        session_set_cookie_params($lifetime, $path, $domain, $security, $httpOnly);

        session_start();
    }
}
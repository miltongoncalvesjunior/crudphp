<?php
    /** Name database */
defined($name =  'crud');

    /**User mysql or db */
defined($user = 'x');

    /**password mysql or db */
defined($password = 'x);

    /**name host mysql */   
defined($host ='127.0.0.1');

    //caminho absoluto para pasta do sistema 
    if(!defined(ABSPATH) )
        define('ABSPATH', __DIR__. '/');

if ( !defined('BASEURL') )
    define('BASEURL', '/clientephp/');

    /**caminho no serer para o sistema */
if ( !defined('DBAPI') )
            define('DBAPI', ABSPATH . 'inc/database.php');

define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');

define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');


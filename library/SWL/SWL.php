<?php

//set SWL lib folder to include_path
defined('SWL_PATH') || define('SWL_PATH', __DIR__);
set_include_path(implode(PATH_SEPARATOR, array(
    SWL_PATH,    
    get_include_path(),
)));


defined('SWL') || define('SWL', 1);
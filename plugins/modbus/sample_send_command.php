<?php

//Call from command line only
if(php_sapi_name() != "cli") die("CLI ONLY!\n");

require_once('../../common/hag.php');

while(true) {
    hag::setDevice('MBMBus01:1', 'current_time', date("H:i:s"));
    sleep(10);
}
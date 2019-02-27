<?php
//Call from command line only
if(php_sapi_name() != "cli") die("CLI ONLY!\n");

//Clear screen and go home
echo "\033[2J";
echo "\033[1;1f";

//Load HAG
require_once('../../common/hag.php');
hag::setRemoteIp('10.0.3.1');

hag::subscribeToStatusUpdates('MBMBus01:1');

$fields = array('Active_Power_Total', 'Active_Power_L1', 'Active_Power_L2', 'Active_Power_L3');
$colored_fields = ['Active_Power_Total', 'Active_Net', 'Active_Power_L1', 'Active_Power_L2', 'Active_Power_L3'];
$data = array();
$positions = [];

$settings = [
    'timeout'               => -1, //No timeout; Wait until message arrives
    'device_data_handler'   => 'myDeviceStatusUpdateHandler',
];

while(true) {
    hag::waitForCommand($settings);
}

function myDeviceStatusUpdateHandler($e) {
    global $fields, $data, $positions, $colored_fields;
    //var_dump($e);
    if($e['device_data']['Type'] == 'Status' && isset($e['device_data']['Data'])) {
        foreach($e['device_data']['Data'] as $k=>$v) {
            if(!isset($positions[$k]['line'])) {
                $positions[$k]['line'] = count($positions)+1;
            }
            $col = 0;
            $line = $positions[$k]['line'];
            if($positions[$k]['line'] > 50) {
                $col = 60;
                $line = $line-50;
            }
            echo "\033[{$line};{$col}f";
            if(in_array($k, $colored_fields)) 
                $colored = true;
            else
                $colored = false;
            if($colored) echo "\033[1;32m";
            printf("%40s:", $e['device_data']['Device'] . ' ' . $k);
            if(is_numeric($v)) {
                printf("% 15.3f\n", floatval($v));
            } else {
                printf("%15s\n", $v);
            }
            if(in_array($k, $fields)) {
                $data[$k]=$v;
            }
            if($colored) echo "\033[0;37m";
        }
    }
}
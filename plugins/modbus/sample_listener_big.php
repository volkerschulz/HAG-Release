<?php
//Call from command line only
if(php_sapi_name() != "cli") die("CLI ONLY!\n");

//Load HAG
require_once('../../common/hag.php');

//Subscribe to Modbus device 
hag::subscribeToStatusUpdates('MBMBus01:1');
hag::subscribeToStatusUpdates('HMLEQ0529899:2');
hag::subscribeToStatusUpdates('HMMEQ0171034:2');

//Fields to display
$fieldset['MBMBus01:1'] = [
    'Active_Power_L1'       => ['row' => 1, 'unit' => 'W', 'value' => 0, 'max_value' => 0, 'description' => 'L1'],
    'Active_Power_L2'       => ['row' => 2, 'unit' => 'W', 'value' => 0, 'max_value' => 0, 'description' => 'L2'],
    'Active_Power_L3'       => ['row' => 3, 'unit' => 'W', 'value' => 0, 'max_value' => 0, 'description' => 'L3'],
    'Active_Power_Total'    => ['row' => 4, 'unit' => 'W', 'value' => 0, 'max_value' => 0, 'description' => 'Gesamt'],
];
$fieldset['HMLEQ0529899:2'] = [
    'POWER'                 => ['row' => 5, 'unit' => 'W', 'value' => 0, 'max_value' => 0, 'description' => 'Kühlschrank'],
];
$fieldset['HMMEQ0171034:2'] = [
    'POWER'                 => ['row' => 6, 'unit' => 'W', 'value' => 0, 'max_value' => 0, 'description' => 'Heizung'],
];

//Clear screen and go home
echo "\033[2J";
echo "\033[1;1f";
//Set up screen
foreach ($fieldset as $device_fieldset) {
    foreach ($device_fieldset as $k => $v) {
        echo "\033[{$v['row']};1f";
        echo $v['description'];
    }
}

$settings = [
    'timeout'               => -1, //No timeout; Wait until message arrives
    'device_data_handler'   => 'myDeviceStatusUpdateHandler',
];

while(true) {
    hag::waitForCommand($settings);
}

function myDeviceStatusUpdateHandler($e) {
    global $fieldset;
    $col = 13;
    foreach($e['device_data']['Data'] as $k=>$v) {
        if(array_key_exists($k, $fieldset[$e['device_data']['Device']])) {
            if($fieldset[$e['device_data']['Device']][$k]['max_value'] < floatval($v)) {
                $fieldset[$e['device_data']['Device']][$k]['max_value'] = floatval($v);
            }
            $row = $fieldset[$e['device_data']['Device']][$k]['row'];
            echo "\033[{$row};{$col}f";
            $fieldset[$e['device_data']['Device']][$k]['value'] = floatval($v);
            printf("% 9.2f {$fieldset[$e['device_data']['Device']][$k]['unit']}", floatval($v));
            printf(" (%.2f W)", $fieldset[$e['device_data']['Device']][$k]['max_value']);
        } 
    }
    //Calculate
    $net =  $fieldset['MBMBus01:1']['Active_Power_Total']['value'];
    $net -= $fieldset['HMLEQ0529899:2']['POWER']['value'];
    $net -= $fieldset['HMMEQ0171034:2']['POWER']['value'];
    echo "\033[7;1f";
    echo "NET";
    echo "\033[7;{$col}f";
    printf("% 9.2f W", floatval($net));
}
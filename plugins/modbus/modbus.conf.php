<?php

/**************************************************
Allgemeine Konfigurationsparameter
**************************************************/

//System-ID for Modbus Plugin
$conf['sys_id']			= 'MB';

//Ports
$conf['port'][0] = [
    'device'            => '/dev/ttyUSB0',
    'speed'             => 115200,
    'data_bits'         => 8,
    'stop_bits'         => 1,
    'parity'            => 'N',
    'bus_name'          => 'MBus01',
    'slaves'            => [
        1   => [
            'register_type' => 'abb',
        ],
    ],
    'requests'          => [
        [
            'slave' => 1,
            'start_reg' => 0x5000,
            'num_reg' => 56,
        ],
        [
            'slave' => 1,
            'start_reg' => 0x5170,
            'num_reg' => 112,
        ],
        [
            'slave' => 1,
            'start_reg' => 0x5460,
            'num_reg' => 108,
        ],
        [
            'slave' => 1,
            'start_reg' => 0x552C,
            'num_reg' => 16,
        ],
        [
            'slave' => 1,
            'start_reg' => 0x5B00,
            'num_reg' => 66,
        ],
        [
            'slave' => 1,
            'start_reg' => 0x8900,
            'num_reg' => 102,
        ],
        [
            'slave' => 1,
            'start_reg' => 0x8A00,
            'num_reg' => 88,
        ],
    ],
    'request_delay'     => .3,    
];

require_once('registers.conf.php');
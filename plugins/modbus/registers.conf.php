<?php

$reg['abb'][0x5000] = [
    'description'   => 'Active_Import',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5004] = [
    'description'   => 'Active_Export',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5008] = [
    'description'   => 'Active_Net',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x500C] = [
    'description'   => 'Reactive_Import',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5010] = [
    'description'   => 'Reactive_Export',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5014] = [
    'description'   => 'Reactive_Net',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5018] = [
    'description'   => 'Apparent_Import',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x501C] = [
    'description'   => 'Apparent_Export',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5020] = [
    'description'   => 'Apparent_Net',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5024] = [
    'description'   => 'Active_Import_CO2',
    'size'          => 4,
    'resolution'    => 0.001,
    'unit'          => 'kg',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5034] = [
    'description'   => 'Active_Import_Currency',
    'size'          => 4,
    'resolution'    => 0.001,
    'unit'          => 'EUR',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5170] = [
    'description'   => 'Active_Import_Tariff_1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5174] = [
    'description'   => 'Active_Import_Tariff_2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5178] = [
    'description'   => 'Active_Import_Tariff_3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x517C] = [
    'description'   => 'Active_Import_Tariff_4',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5190] = [
    'description'   => 'Active_Export_Tariff_1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5194] = [
    'description'   => 'Active_Export_Tariff_2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5198] = [
    'description'   => 'Active_Export_Tariff_3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x519C] = [
    'description'   => 'Active_Export_Tariff_4',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x51B0] = [
    'description'   => 'Reactive_Import_Tariff_1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x51B4] = [
    'description'   => 'Reactive_Import_Tariff_2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x51B8] = [
    'description'   => 'Reactive_Import_Tariff_3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x51BC] = [
    'description'   => 'Reactive_Import_Tariff_4',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x51D0] = [
    'description'   => 'Reactive_Export_Tariff_1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x51D4] = [
    'description'   => 'Reactive_Export_Tariff_2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x51D8] = [
    'description'   => 'Reactive_Export_Tariff_3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x51DC] = [
    'description'   => 'Reactive_Export_Tariff_4',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5460] = [
    'description'   => 'Active_Import_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5464] = [
    'description'   => 'Active_Import_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5468] = [
    'description'   => 'Active_Import_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x546C] = [
    'description'   => 'Active_Export_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5470] = [
    'description'   => 'Active_Export_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5474] = [
    'description'   => 'Active_Export_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5478] = [
    'description'   => 'Active_Net_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x547C] = [
    'description'   => 'Active_Net_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5480] = [
    'description'   => 'Active_Net_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5484] = [
    'description'   => 'Reactive_Import_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5488] = [
    'description'   => 'Reactive_Import_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x548C] = [
    'description'   => 'Reactive_Import_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5490] = [
    'description'   => 'Reactive_Export_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5494] = [
    'description'   => 'Reactive_Export_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5498] = [
    'description'   => 'Reactive_Export_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x549C] = [
    'description'   => 'Reactive_Net_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54A0] = [
    'description'   => 'Reactive_Net_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54A4] = [
    'description'   => 'Reactive_Net_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kvarh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54A8] = [
    'description'   => 'Apparent_Import_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54AC] = [
    'description'   => 'Apparent_Import_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54B0] = [
    'description'   => 'Apparent_Import_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54B4] = [
    'description'   => 'Apparent_Export_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54B8] = [
    'description'   => 'Apparent_Export_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54BC] = [
    'description'   => 'Apparent_Export_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54C0] = [
    'description'   => 'Apparent_Net_L1',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54C4] = [
    'description'   => 'Apparent_Net_L2',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x54C8] = [
    'description'   => 'Apparent_Net_L3',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kVAh',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x552C] = [
    'description'   => 'Resettable_Active_Import',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5530] = [
    'description'   => 'Resettable_Active_Export',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5534] = [
    'description'   => 'Resettable_Reactive_Import',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5538] = [
    'description'   => 'Resettable_Reactive_Export',
    'size'          => 4,
    'resolution'    => 0.01,
    'unit'          => 'kWh',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B00] = [
    'description'   => 'Voltage_L1-N',
    'size'          => 2,
    'resolution'    => 0.1,
    'unit'          => 'V',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B02] = [
    'description'   => 'Voltage_L2-N',
    'size'          => 2,
    'resolution'    => 0.1,
    'unit'          => 'V',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B04] = [
    'description'   => 'Voltage_L3-N',
    'size'          => 2,
    'resolution'    => 0.1,
    'unit'          => 'V',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B06] = [
    'description'   => 'Voltage_L1-L2',
    'size'          => 2,
    'resolution'    => 0.1,
    'unit'          => 'V',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B08] = [
    'description'   => 'Voltage_L3-L2',
    'size'          => 2,
    'resolution'    => 0.1,
    'unit'          => 'V',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B0A] = [
    'description'   => 'Voltage_L1-L3',
    'size'          => 2,
    'resolution'    => 0.1,
    'unit'          => 'V',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B0C] = [
    'description'   => 'Current_L1',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'A',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B0E] = [
    'description'   => 'Current_L2',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'A',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B10] = [
    'description'   => 'Current_L3',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'A',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B12] = [
    'description'   => 'Current_N',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'A',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B14] = [
    'description'   => 'Active_Power_Total',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'W',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B16] = [
    'description'   => 'Active_Power_L1',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'W',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B18] = [
    'description'   => 'Active_Power_L2',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'W',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B1A] = [
    'description'   => 'Active_Power_L3',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'W',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B1C] = [
    'description'   => 'Reactive_Power_Total',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'var',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B1E] = [
    'description'   => 'Reactive_Power_L1',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'var',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B20] = [
    'description'   => 'Reactive_Power_L2',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'var',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B22] = [
    'description'   => 'Reactive_Power_L3',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'var',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B24] = [
    'description'   => 'Apparent_Power_Total',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'VA',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B26] = [
    'description'   => 'Apparent_Power_L1',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'VA',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B28] = [
    'description'   => 'Apparent_Power_L2',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'VA',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B2A] = [
    'description'   => 'Apparent_Power_L3',
    'size'          => 2,
    'resolution'    => 0.01,
    'unit'          => 'VA',
    'type'          => 'signed',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B2C] = [
    'description'   => 'Frequency',
    'size'          => 1,
    'resolution'    => 0.01,
    'unit'          => 'Hz',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x5B2D] = [
    'description'   => 'Phase_Angle_Power_Total',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B2E] = [
    'description'   => 'Phase_Angle_Power_L1',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B2F] = [
    'description'   => 'Phase_Angle_Power_L2',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B30] = [
    'description'   => 'Phase_Angle_Power_L3',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B31] = [
    'description'   => 'Phase_Angle_Voltage_L1',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B32] = [
    'description'   => 'Phase_Angle_Voltage_L2',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B33] = [
    'description'   => 'Phase_Angle_Voltage_L3',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B37] = [
    'description'   => 'Phase_Angle_Current_L1',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B38] = [
    'description'   => 'Phase_Angle_Current_L2',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B39] = [
    'description'   => 'Phase_Angle_Current_L3',
    'size'          => 1,
    'resolution'    => 0.1,
    'unit'          => '�',
    'type'          => 'signed',
    'min_value'     => -180,
    'max_value'     => 180,
];

$reg['abb'][0x5B3A] = [
    'description'   => 'Power_Factor_Total',
    'size'          => 1,
    'resolution'    => 0.001,
    'unit'          => '',
    'type'          => 'signed',
    'min_value'     => -1,
    'max_value'     => 1,
];

$reg['abb'][0x5B3B] = [
    'description'   => 'Power_Factor_L1',
    'size'          => 1,
    'resolution'    => 0.001,
    'unit'          => '',
    'type'          => 'signed',
    'min_value'     => -1,
    'max_value'     => 1,
];

$reg['abb'][0x5B3C] = [
    'description'   => 'Power_Factor_L2',
    'size'          => 1,
    'resolution'    => 0.001,
    'unit'          => '',
    'type'          => 'signed',
    'min_value'     => -1,
    'max_value'     => 1,
];

$reg['abb'][0x5B3D] = [
    'description'   => 'Power_Factor_L3',
    'size'          => 1,
    'resolution'    => 0.001,
    'unit'          => '',
    'type'          => 'signed',
    'min_value'     => -1,
    'max_value'     => 1,
];

$reg['abb'][0x5B3E] = [
    'description'   => 'Current_Quadrant_Total',
    'size'          => 1,
    'resolution'    => 1,
    'unit'          => '',
    'type'          => 'unsigned',
    'min_value'     => 1,
    'max_value'     => 4,
];

$reg['abb'][0x5B3F] = [
    'description'   => 'Current_Quadrant_L1',
    'size'          => 1,
    'resolution'    => 1,
    'unit'          => '',
    'type'          => 'unsigned',
    'min_value'     => 1,
    'max_value'     => 4,
];

$reg['abb'][0x5B40] = [
    'description'   => 'Current_Quadrant_L2',
    'size'          => 1,
    'resolution'    => 1,
    'unit'          => '',
    'type'          => 'unsigned',
    'min_value'     => 1,
    'max_value'     => 4,
];

$reg['abb'][0x5B41] = [
    'description'   => 'Current_Quadrant_L3',
    'size'          => 1,
    'resolution'    => 1,
    'unit'          => '',
    'type'          => 'unsigned',
    'min_value'     => 1,
    'max_value'     => 4,
];

$reg['abb'][0x8900] = [
    'description'   => 'Serial_Number',
    'size'          => 2,
    'resolution'    => 1,
    'unit'          => '',
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8908] = [
    'description'   => 'Firmware_Version',
    'size'          => 8,
    'type'          => 'string',
];

$reg['abb'][0x8910] = [
    'description'   => 'Modbus_Mapping_Version',
    'size'          => 1,
    'type'          => 'version',
];

$reg['abb'][0x8960] = [
    'description'   => 'Type_Designation',
    'size'          => 6,
    'type'          => 'string',
];

$reg['abb'][0x8A00] = [
    'description'   => 'Date_Time',
    'size'          => 3,
    'type'          => 'datetime',
];

$reg['abb'][0x8A03] = [
    'description'   => 'Day_Of_Week',
    'size'          => 1,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => 1,
    'max_value'     => 7,
];

$reg['abb'][0x8A04] = [
    'description'   => 'DST_Active',
    'size'          => 1,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => 0,
    'max_value'     => 1,
];

$reg['abb'][0x8A05] = [
    'description'   => 'Day_Type',
    'size'          => 1,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => 0,
    'max_value'     => 3,
];

$reg['abb'][0x8A06] = [
    'description'   => 'Season',
    'size'          => 1,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => 0,
    'max_value'     => 3,
];

$reg['abb'][0x8A07] = [
    'description'   => 'Current_Tariff',
    'size'          => 1,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => 1,
    'max_value'     => 4,
];

$reg['abb'][0x8A13] = [
    'description'   => 'Error_Flags',
    'size'          => 4,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8A19] = [
    'description'   => 'Information_Flags',
    'size'          => 4,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8A1F] = [
    'description'   => 'Warning_Flags',
    'size'          => 4,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8A25] = [
    'description'   => 'Alarm_Flags',
    'size'          => 4,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8A2F] = [
    'description'   => 'Power_Fail_Counter',
    'size'          => 1,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8A39] = [
    'description'   => 'Power_Outage_Time',
    'size'          => 3,
    'resolution'    => 1,
    'type'          => 'duration',
];

$reg['abb'][0x8A48] = [
    'description'   => 'Reset_Counter_Active_Import',
    'size'          => 4,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8A4C] = [
    'description'   => 'Reset_Counter_Active_Export',
    'size'          => 4,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8A50] = [
    'description'   => 'Reset_Counter_Reactive_Import',
    'size'          => 4,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

$reg['abb'][0x8A54] = [
    'description'   => 'Reset_Counter_Reactive_Export',
    'size'          => 4,
    'resolution'    => 1,
    'type'          => 'unsigned',
    'min_value'     => null,
    'max_value'     => null,
];

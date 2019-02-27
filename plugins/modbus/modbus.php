<?php
//Call from command line only
if(php_sapi_name() != "cli") die("CLI ONLY!\n");


//Load plugin specific config file
require_once('modbus.conf.php');


//Load HAG
require_once('../../common/hag.php');

//Parse command line arguments into $_REQUEST
parse_str(implode('&', array_slice($argv, 1)), $_REQUEST);

//Set defaults for command line arguments
if(!isset($_REQUEST['p']) || !isset($conf['port'][$_REQUEST['p']])) 
    $_REQUEST['p'] = 0;


//Init port
$conf['port']['device']         = $conf['port'][$_REQUEST['p']]['device'];
$conf['port']['speed']          = $conf['port'][$_REQUEST['p']]['speed'];
$conf['port']['data_bits']      = $conf['port'][$_REQUEST['p']]['data_bits'];
$conf['port']['stop_bits']      = $conf['port'][$_REQUEST['p']]['stop_bits'];
$conf['port']['parity']         = $conf['port'][$_REQUEST['p']]['parity'];
$conf['port']['bus_name']       = $conf['port'][$_REQUEST['p']]['bus_name'];
$conf['port']['requests']       = $conf['port'][$_REQUEST['p']]['requests'];
$conf['port']['request_delay']  = $conf['port'][$_REQUEST['p']]['request_delay'];
$conf['port']['slaves']         = $conf['port'][$_REQUEST['p']]['slaves'];

//Subscribe to devices
$devices = [];
foreach($conf['port']['slaves'] as $k=>$v) {
    $devices[] = $conf['sys_id'] . $conf['port']['bus_name'] . ':' . $k;
}
hag::subscribeToCommands($devices);

//Load defaults
$out = '';
$ret = proc_exec("stty -F " . $conf['port']['device'] . " 0:4:8bf:0:3:1c:7f:15:4:0:0:0:11:13:1a:0:12:f:17:16:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0", $out);
var_dump($ret);
var_dump($out);

//Set baud rate
$out = '';
$ret = proc_exec("stty -F " . $conf['port']['device'] . " " . (int) $conf['port']['speed'], $out);
var_dump($ret);
var_dump($out);

//Set data bits
$out = '';
$ret = proc_exec("stty -F " . $conf['port']['device'] . " cs" . (int) $conf['port']['data_bits'], $out);
var_dump($ret);
var_dump($out);

//Set parity
$out = '';
$mode = '-parenb';
if($conf['port']['parity']=='E') {
    $mode = 'parenb -parodd';
} elseif($conf['port']['parity']=='O') {
    $mode = 'parenb parodd';
} 
$ret = proc_exec("stty -F " . $conf['port']['device'] . " " . $mode, $out);
var_dump($ret);
var_dump($out);

//Set stop bit
$out = '';
$ret = proc_exec("stty -F " . $conf['port']['device'] . " " . (($conf['port']['stop_bits'] == 1) ? "-" : "") . "cstopb", $out);
var_dump($ret);
var_dump($out);

//Disable flow control
$out = '';
$ret = proc_exec("stty -F " . $conf['port']['device'] . " clocal -crtscts -ixon -ixoff", $out);
var_dump($ret);
var_dump($out);

//Open device
$fp = @fopen($conf['port']['device'], 'r+b');
if ($fp !== false) {
    stream_set_blocking($fp, 0);
} else {
    die("Unable to open port\n");
}

$buffer = '';
$last_request['time'] = microtime(true);
$response_received = true;
$timeout = 10;
$expected_length = 5;
$i = 0;
$subscribed = false;
$not_subscribed_count = 0;
$requests_sent = 0;
$responses_received = 0;
while(true) {
	$bytes = stream_get_contents($fp, -1);
    $buffer = $buffer . $bytes;
    if(strlen($bytes)==0) {
        $buffer = '';
        if((microtime(true) - $last_request['time'])>$timeout) {
            echo date("H:i:s") . " Timeout\n";
            echo "{$requests_sent} requests sent; {$responses_received} responses received; ";
            printf("%.2f %% loss\n", (100-(100 / $requests_sent * $responses_received)));
            $response_received = true;
        }
        if((microtime(true) - $last_request['time'])>$conf['port']['request_delay'] && $response_received) {
            $i++;
            if($i >= count($conf['port']['requests'])) $i=0;
            $buffer='';
            $expected_length = ($conf['port']['requests'][$i]['num_reg'] * 2) + 5;
            //echo "Requesting " . dechex($conf['port']['requests'][$i]['start_reg']) . "\n";
            makeReadRequest($conf['port']['requests'][$i]['slave'], $conf['port']['requests'][$i]['start_reg'], $conf['port']['requests'][$i]['num_reg']);
            //$expected_length = 8;
            //makeWriteRequest($conf['port']['requests'][$i]['slave'], 0x8A00, chr(0x0A) . chr(0x0B) . chr(0x0B) . chr(0x0C) . chr(0x0D) . chr(0x0E));
            $last_request['time'] = microtime(true);
            $response_received = false;
            $requests_sent++;
        } 
    }
    if(!$response_received && strlen($buffer)>=$expected_length) {
        //echo "Buffer length: " . strlen($buffer) . "\n";
        //echo "Length expected: " . $expected_length . "\n";
        $response_received = true;
        $responses_received++;
        $ret = parseResponse($buffer, $conf['port']['requests'][$i]['start_reg']);
        //var_dump($ret);
        foreach ($ret['ptr'] as $k=>$v) {
            if(is_numeric($v)) {
                $entry = $ret['reg'][$v];
                if($entry['valid']) {
                    hag::reportValue($conf['port']['bus_name'] . ':' . $ret['slave_address'], $k, $entry['value'], $conf['port']['device']);
                }
            }
        }
        /*
        if(isset($ret['error']) && !$ret['error'] && isset($ret['ptr']['Active_Power_Total'])) {
            echo "-----------------------------\n";
            echo " Total Power\t" . getValueFormatted($ret, 'Active_Power_Total', "% 10.2f %unit%\n");
            echo " L1 Power\t" . getValueFormatted($ret, 'Active_Power_L1', "% 10.2f %unit%\n");
            echo " L2 Power\t" . getValueFormatted($ret, 'Active_Power_L2', "% 10.2f %unit%\n");
            echo " L3 Power\t" . getValueFormatted($ret, 'Active_Power_L3', "% 10.2f %unit%\n");
            echo "-----------------------------\n";
        }
        if(false && isset($ret['error']) && !$ret['error'] && isset($ret['ptr']['Active_Import'])) {
            echo "-----------------------------\n";
            echo " Total Import\t" . getValueFormatted($ret, 'Active_Import', "% 9.3f %unit%\n");
            echo " Total Export\t" . getValueFormatted($ret, 'Active_Export', "% 9.3f %unit%\n");
            echo " Total Net\t" . getValueFormatted($ret, 'Active_Net', "% 9.3f %unit%\n");
            echo "-----------------------------\n";
        }
         * 
         */
    }
    $settings = [
        'timeout'               => .1,
        'command_handler'       => 'myCommandHandler',
    ];
    hag::waitForCommand($settings);
}
fclose($fp);

function myCommandHandler($e) {
    echo "COMMAND RECEIVED: " . print_r($e, true) . "\n";
}

function getValueFormatted($ret, $desc, $format='% 10.2f %unit%') {
    if(!isset($ret['ptr'][$desc]) || !is_numeric($ret['ptr'][$desc])) return false;
    $ptr = $ret['ptr'][$desc];
    $entry = $ret['reg'][$ptr];
    foreach ($entry as $k=>$v) {
        $format = str_replace('%'.$k.'%', $v, $format);
    }
    return sprintf($format, $ret['reg'][$ptr]['value']);
}

function makeReadRequest($slave, $start_reg, $num_reg) {
    global $fp;
    $request = chr($slave) . chr(3);
    $ar = unpack("C*", pack("n", $start_reg));
    $request .= chr($ar[1]) . chr($ar[2]);
    $ar = unpack("C*", pack("n", $num_reg));
    $request .= chr($ar[1]) . chr($ar[2]);
    $crc = crc16($request, 0x8005, 0xFFFF);
    $ar = unpack("C*", pack("S", $crc));
    $request .= chr($ar[1]) . chr($ar[2]);
    if($fp) {
        if (fwrite($fp, $request) === false) {
            echo "Could not write to port\n";
        } else {
            return true;
        }
    }
    return false;
}

function makeWriteRequest($slave, $start_reg, $bytes) {
    global $fp;
    if(strlen($bytes)%2 != 0) return false;
    $num_reg = strlen($bytes) / 2;
    $request = chr($slave) . chr(16);
    $ar = unpack("C*", pack("n", $start_reg));
    $request .= chr($ar[1]) . chr($ar[2]);
    $ar = unpack("C*", pack("n", $num_reg));
    $request .= chr($ar[1]) . chr($ar[2]);
    $request .= chr(strlen($bytes));
    $request .= $bytes;
    $crc = crc16($request, 0x8005, 0xFFFF);
    $ar = unpack("C*", pack("S", $crc));
    $request .= chr($ar[1]) . chr($ar[2]);
    for($x=0; $x<strlen($request); $x++) {
        echo "-" . dechex(ord($request[$x])) . "-\n";
    }
    if($fp) {
        if (fwrite($fp, $request) === false) {
            echo "Could not write to port\n";
        } else {
            return true;
        }
    }
    return false;
}

function parseResponse($bytes, $first_register) {
    global $conf, $reg;
    $len = strlen($bytes);
    $ret['error'] = false;
    $ret['slave_address'] = ord($bytes[0]);
    //Load registers for that particular slave
    $slave_reg = $reg[$conf['port']['slaves'][$ret['slave_address']]['register_type']];
    $ret['function_code'] = ord($bytes[1]);
    echo "Function Code: {$ret['function_code']}\n";
    if($ret['function_code'] == (3+0x80) || $ret['function_code'] == (6+0x80) || $ret['function_code'] == (16+0x80)) {
        $ret['exception_code'] = ord($bytes[2]);
        $ret['crc_expected'] = unpack('S', $bytes[3].$bytes[4])[1];
        $ret['crc_calculated'] = crc16(substr($bytes, 0, 3), 0x8005, 0xFFFF);
        if($ret['crc_expected'] != $ret['crc_calculated']) {
            echo "CRC mismatch\n";
            return false;
        }
        switch($ret['exception_code']) {
            case 1:
                echo "Illegal function\n";
                break;
            case 2:
                echo "Illegal data address\n";
                break;
            case 3:
                echo "Illegal data value\n";
                break;
            case 4:
                echo "Slave device failure\n";
                break;
            default:
                echo "Unknown error\n";
                break;
        }
        $ret['error'] = true;
        return $ret;
    }
    $ret['bytes_expected'] = ord($bytes[2]);
    if($len >= $ret['bytes_expected']+5) {
        $ret['crc_expected'] = unpack('S', $bytes[$ret['bytes_expected']+3].$bytes[$ret['bytes_expected']+4])[1];
        $ret['crc_calculated'] = crc16(substr($bytes, 0, $ret['bytes_expected']+3), 0x8005, 0xFFFF);
        if($ret['crc_expected'] != $ret['crc_calculated']) {
            echo "CRC mismatch\n";
            return false;
        }
    } else {
        echo "Response incomplete for 0x" . dechex($first_register) . " ({$len}/" . ($ret['bytes_expected']+5) . " bytes received\n";
        return false;
    }
    $i = 0;
    $current_reg = $first_register;
    while($i < $ret['bytes_expected']) {
        //echo $i . "\n";
        if(!isset($slave_reg[$current_reg])) {
            $slave_reg[$current_reg] = [
                'description'   => sprintf("Unknown 0x%02X", $current_reg),
                'size'          => 1,
                'resolution'    => 1,
                'unit'          => '?',
                'type'          => 'unsigned',
                'min_value'     => null,
                'max_value'     => null,
            ];
        }
        
        $ret['reg'][$current_reg]['valid'] = true;
        switch($slave_reg[$current_reg]['type']) {
            case 'signed':
            case 'unsigned':
                if($slave_reg[$current_reg]['type'] == 'unsigned') $unsigned = true; else $unsigned=false;
                $ret['reg'][$current_reg]['value'] = convert(substr($bytes, (3+$i), ($slave_reg[$current_reg]['size']*2)), $unsigned, $slave_reg[$current_reg]['resolution']);
                $xand = 255;
                for($x=0; $x<($slave_reg[$current_reg]['size']*2); $x++) {
                    if($x==0 && !$slave_reg[$current_reg]['type']=='signed' && ord($bytes[3+$i+$x])==127) {
                        $xand = $xand & 255;
                    } else {
                        $xand = $xand & ord($bytes[3+$i+$x]);
                    }
                }
                if($xand==255) $ret['reg'][$current_reg]['valid'] = false;
                break;
            case 'string':
                $ret['reg'][$current_reg]['value'] = makeAsciiString(substr($bytes, (3+$i), ($slave_reg[$current_reg]['size']*2)));
                $ret['reg'][$current_reg]['value'] = trim($ret['reg'][$current_reg]['value']);
                if(empty($ret['reg'][$current_reg]['value'])) {
                    $ret['reg'][$current_reg]['valid'] = false;
                }
                break;
            case 'version':
                $ret['reg'][$current_reg]['value'] = makeAsciiVersion(substr($bytes, (3+$i), ($slave_reg[$current_reg]['size']*2)));
                break;
            case 'datetime':
                $ret['reg'][$current_reg]['value'] = makeDateTime(substr($bytes, (3+$i), ($slave_reg[$current_reg]['size']*2)));
                if($ret['reg'][$current_reg]['value']===false) {
                    $ret['reg'][$current_reg]['value'] = '---';
                    $ret['reg'][$current_reg]['valid'] = false;
                }
                break;
            case 'duration':
                $ret['reg'][$current_reg]['value'] = makeDuration(substr($bytes, (3+$i), ($slave_reg[$current_reg]['size']*2)));
                if($ret['reg'][$current_reg]['value']===false) {
                    $ret['reg'][$current_reg]['value'] = '---';
                    $ret['reg'][$current_reg]['valid'] = false;
                }
                break;
        }
        
        $ret['reg'][$current_reg] = array_merge($ret['reg'][$current_reg], $slave_reg[$current_reg]);
        $ret['ptr'][$slave_reg[$current_reg]['description']] = $current_reg;
        $i+=($slave_reg[$current_reg]['size']*2);
        $current_reg += $slave_reg[$current_reg]['size'];
    }
    return $ret;
}

function proc_exec($cmd, &$out = null) {
    $desc = array(
        1 => array("pipe", "w"),
        2 => array("pipe", "w")
    );
    $proc = proc_open($cmd, $desc, $pipes);
    $ret = stream_get_contents($pipes[1]);
    $err = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $retVal = proc_close($proc);
    if (func_num_args() == 2) $out = array($ret, $err);
    return $retVal;
}

function crc16($data, $generatorPolynomial, $seed = 0x0000)
{
    $reverseBitOrder = function ($data) {
        return bindec(
            strrev(
                str_pad(
                    decbin($data),
                    16,
                    '0',
                    STR_PAD_LEFT
                )
            )
        );
    };

    // Generator polynomial
    $gp = $reverseBitOrder($generatorPolynomial);

    // Remainder polynomial
    $rp = $seed;

    $len = strlen($data);

    for ($i = 0; $i < $len; $i++) {
        $rp ^= ord($data[$i]);

        for ($bit = 0; $bit <= 7; $bit++) {
            if ($rp & 0x0001) {
                $rp >>= 1;
                $rp ^= $gp;
            } else {
                $rp >>= 1;
            }
        }
    }

    return $rp;
}

function makeDateTime($bytes, $msb_first=true) {
    if(strlen($bytes) < 6) return false;
    for($x=0; $x<strlen($bytes); $x++) {
        echo "-" . dechex(ord($bytes[$x])) . "-\n";
    }
    $year = $month = $day = $hour = $minute = $second = 0;
    $year = convert(chr(0) . $bytes[0]);
    $month = convert(chr(0) . $bytes[1]);
    $day = convert(chr(0) . $bytes[2]);
    $hour = convert(chr(0) . $bytes[3]);
    $minute = convert(chr(0) . $bytes[4]);
    $second = convert(chr(0) . $bytes[5]);
    if($second == 0xFF) return false;
    return sprintf("%u-%02u-%02u %02u:%02u:%02u", $year, $month, $day, $hour, $minute, $second);
}

function makeDuration($bytes) {
    if(strlen($bytes) < 6) return false;
    $days = $hours = $minutes = $seconds = 0;
    $days = convert(chr(0) . $bytes[0] . $bytes[1] . $bytes[2]);
    $hours = convert(chr(0) . $bytes[3]);
    $minutes = convert(chr(0) . $bytes[4]);
    $seconds = convert(chr(0) . $bytes[5]);
    if($seconds == 0xFF) return false;
    return sprintf("%u %02u:%02u:%02u", $days, $hours, $minutes, $seconds);
}

function makeAsciiString($bytes, $msb_first=true) {
    $out = '';
    for($i=0; $i<strlen($bytes); $i++) {
        if(ord($bytes[$i])==0 && $msb_first) break;
        if($msb_first) {
            $out .= $bytes[$i];
        } else {
            $out = $bytes[$i] . $out;
        }
    }
    return trim($out);
}

function makeAsciiVersion($bytes, $msb_first=true) {
    $out = '';
    for($i=0; $i<strlen($bytes); $i++) {
        if($msb_first) {
            $out .= '.' . ord($bytes[$i]);
        } else {
            $out = ord($bytes[$i]) . '.' . $out;
        }
    }
    return trim($out, ' .');
}

function convert($val, $unsigned=true, $resolution=1) {
    if(strlen($val)==8) return convert64($val, $unsigned, $resolution);
    $hexstr = '';
    for($i=0; $i<strlen($val); $i++) {
        $hexstr .= sprintf("%02X", ord($val[$i]));
    }
    if(!$unsigned && ord($val[0])>0x7F)
        return (hexdec($hexstr) - pow(256, strlen($val)))*$resolution;
    else
        return hexdec($hexstr)*$resolution;
}

function convert64($val, $unsigned=true, $resolution=1) {
    $high = substr($val, 0, 4);
    $low = substr($val, 4);
    $high = sprintf("%s", convert($high));
    $low = sprintf("%s", convert($low));
    //var_dump($high);
    //var_dump($low);
    $total = bcmul($high, '4294967296');
    $total = bcadd($total, $low);
    //var_dump($total);
    if(!$unsigned && ord($val[0])>0x7F) {
        $total = bcsub($total, '18446744073709551616');
    }
    //var_dump($total);
    $total = bcmul($total, $resolution, 10);
    //var_dump($total);
    $parts = explode('.', $total);
    if(count($parts)==2) {
        $parts[1] = rtrim($parts[1], '0');
    }
    $total = implode('.', $parts);
    $total = rtrim($total, '.');
    //var_dump($total);
    if($total == (string) floatval($total)) {
        return floatval($total);
    } else {
        return $total;
    }
}

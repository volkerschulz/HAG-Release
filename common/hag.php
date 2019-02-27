<?php

class hag {

    private static $value_cache;
    private static $udp_socket_send = NULL;
    private static $tcp_ip_socket = NULL;
    private static $sys_id = '';
    private static $database;
    private static $status_subscriptions = NULL;
    private static $command_subscriptions = NULL;
    private static $server_ip = '127.0.0.1';
    private static $message_remainder = '';

    private function tcpConnect() {
        if (self::$status_subscriptions == NULL) {
            self::$status_subscriptions['none'] = 'none';
        }
        if (self::$command_subscriptions == NULL) {
            self::$command_subscriptions = [];
        }

        echo("CREATING TCP-IP SOCKET...\n");
        self::$tcp_ip_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option(self::$tcp_ip_socket, SOL_SOCKET, SO_REUSEADDR, 1);
        $result = socket_connect(self::$tcp_ip_socket, self::$server_ip, 12000);
        if ($result === false) {
            $error_code = socket_last_error(self::$tcp_ip_socket);
            $error_message = socket_strerror($error_code);
            echo("Could not connect to TCP-server\n");
            echo("Error #{$error_code}\n{$error_message}\n");
        } else {
            self::updateStatusSubscriptions();
            self::updateCommandSubscriptions();
        }
        return $result;
    }
    
    public static function setRemoteIp($ip) {
        self::$server_ip = $ip;
        //Reconnect socket if needed
        if (self::$tcp_ip_socket !== NULL) {
            self::$tcp_ip_socket = NULL;
            self::tcpConnect();
        }
    }

    public static function subscribeToCommands($devices) {
        if (!is_array($devices) && is_string($devices)) {
            $devices = [$devices];
        }
        if (is_array($devices)) {
            foreach ($devices as $device) {
                self::$command_subscriptions[$device] = $device;
            }
            self::updateCommandSubscriptions();
        }
    }

    public static function unsubscribeFromCommands($devices) {
        if (!is_array($devices) && is_string($devices)) {
            $devices = [$devices];
        }
        if (is_array($devices)) {
            foreach ($devices as $device) {
                unset(self::$command_subscriptions[$device]);
            }
            self::updateCommandSubscriptions();
        }
    }

    private static function updateCommandSubscriptions() {
        $command['Type'] = 'Command';
        $command['Device'] = 'XX';
        $command['Data'] = ['Action' => 'Devices', 'Devices' => array_values(self::$command_subscriptions)];
        self::sendCommand($command);
    }

    public static function subscribeToStatusUpdates($devices) {
        if (!is_array($devices) && is_string($devices)) {
            $devices = [$devices];
        }
        if (is_array($devices)) {
            foreach ($devices as $device) {
                self::$status_subscriptions[$device] = $device;
            }
            self::updateStatusSubscriptions();
        }
    }

    public static function unsubscribeFromStatusUpdates($devices) {
        if (!is_array($devices) && is_string($devices)) {
            $devices = [$devices];
        }
        if (is_array($devices)) {
            foreach ($devices as $device) {
                unset(self::$status_subscriptions[$device]);
            }
            self::updateStatusSubscriptions();
        }
    }

    private static function updateStatusSubscriptions() {
        $command['Type'] = 'Command';
        $command['Device'] = 'XX';
        if (!in_array('all', self::$status_subscriptions)) {
            $command['Data'] = ['Action' => 'Filter', 'Filter' => array_values(self::$status_subscriptions)];
        } else {
            $command['Data'] = ['Action' => 'Filter', 'Filter' => ['all']];
        }
        self::sendCommand($command);
        self::getDevices(array_values(self::$status_subscriptions));
    }

    private static function setDevice($device, $key, $value) {
        $command = array('Type' => 'Command', 'Device' => 'XX', 'Data' => array('Action' => 'Set', 'Device' => $device, 'Key' => $key, 'Value' => $value));
        self::sendCommand($command);

        return true;
    }

    private static function getDevice($device) {
        return self::getDevices([$device]);
    }

    private static function getDevices($devices) {
        $command = array('Type' => 'Command', 'Device' => 'XX', 'Data' => array('Action' => 'Get', 'Devices' => $devices));
        self::sendCommand($command);

        return true;
    }

    private static function sendCommand($cmd) {
        //Connect socket if needed
        if (self::$tcp_ip_socket === NULL) {
            self::tcpConnect();
        }

        //Check if socket is ok
        if (is_resource(self::$tcp_ip_socket)) {
            $cmd = json_encode($cmd);
            //echo("Sending {$cmd}\n");
            $ret = self::safe_socket_write(self::$tcp_ip_socket, $cmd);
            if ($ret === false) {
                sleep(5);
                self::tcpConnect();
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public static function waitForCommand($settings) {
        $default_settings = [
            'timeout' => 1.5,
            'force_wait' => true,
            'device_data_handler' => '',
            'command_handler' => '',
        ];
        $settings = array_merge($default_settings, $settings);

        //Calculate real timeout values
        if ($settings['timeout'] < 0) {
            //Blocking call
            $tv_sec = NULL;
            $tv_usec = 0;
        } elseif ($settings['timeout'] == 0) {
            $tv_sec = 0;
            $tv_usec = 0;
        } else {
            $tv_sec = (int) floor($settings['timeout']);
            $tv_usec = ($settings['timeout'] - $tv_sec) * 1000000;
        }
        $timeout = $tv_usec + ($tv_sec * 1000000);

        //Connect socket if needed
        if (self::$tcp_ip_socket === NULL) {
            self::tcpConnect();
        }

        //Check if socket is ok
        if (is_resource(self::$tcp_ip_socket)) {
            //If ok, add to monitoring
            $read[] = self::$tcp_ip_socket;
        } else {
            //If not, wait for timeout (if non-blocking) and return
            echo("Socket failed!\n");
            if ($tv_sec !== NULL) {
                usleep($timeout);
            }
            return false;
        }

        // Set up a blocking call to socket_select()
        //echo("Listening (" . count($read) . ")...\n");
        $start_time = microtime(true);
        $null = NULL;
        $ready = socket_select($read, $null, $null, $tv_sec, $tv_usec);

        //Read from socket
        if ($ready && is_array($read)) {
            foreach ($read as $k => $socket) {
                if ($socket == self::$tcp_ip_socket) {
                    $responses = @socket_read($socket, 8192, PHP_BINARY_READ);
                    if ($responses === false || $responses === '') {
                        echo("TCP-Server has gone away\n");
                        socket_close($socket);
                        sleep(5);
                        self::tcpConnect();
                    }
                    //echo("Received something from TCP:");
                    $responses = self::$message_remainder . $responses;
                    $responses = explode("\r\n\x00", $responses);
                    self::$message_remainder = $responses[count($responses)-1];
                    unset($responses[count($responses)-1]);
                    foreach ($responses as $response) {
                        if (!empty($response)) {
                            $decoded = json_decode($response, true);
                            if (isset($decoded['Device']) && isset($decoded['Type']) && $decoded['Type'] == 'Status') {
                                if (is_array(self::$status_subscriptions) && (in_array('all', self::$status_subscriptions) || in_array($decoded['Device'], self::$status_subscriptions))) {
                                    //echo("Packet:\n" . print_r($response, true) . "\n");
                                    if (!empty($settings['device_data_handler'])) {
                                        if (is_callable($settings['device_data_handler'])) {
                                            unset($data);
                                            //$data['caller'] = self;
                                            $data['device_data'] = $decoded;
                                            call_user_func($settings['device_data_handler'], $data);
                                        } else {
                                            echo('Device data handler not callable: ' . print_r($settings['device_data_handler'], true) . "\n");
                                        }
                                    }
                                }
                            } elseif (isset($decoded['Type']) && $decoded['Type'] == 'Command') {
                                //echo("Command received:\n" . print_r($response, true) . "\n");
                                if (!empty($settings['command_handler'])) {
                                    if (is_callable($settings['command_handler'])) {
                                        unset($data);
                                        //$data['caller'] = self;
                                        $data['device'] = $decoded['Device'];
                                        $data['key'] = $decoded['Key'];
                                        $data['value'] = $decoded['Value'];
                                        call_user_func($settings['command_handler'], $data);
                                    } else {
                                        echo('Command handler not callable: ' . print_r($settings['command_handler'], true) . "\n");
                                    }
                                }
                            } else {
                                var_dump($decoded);
                                if ($decoded === false || $decoded == NULL) {
                                    var_dump($response);
                                }
                            }
                        }
                    }
                }
            }
        }

        //Force sleep if force_wait is set to true
        $stop_time = microtime(true);
        if ($settings['force_wait']) {
            if ((($stop_time - $start_time) * 1000000) < $timeout) {
                usleep($timeout - ($stop_time - $start_time));
            }
        }
    }

    public static function setSysId($sys_id) {
        self::$sys_id = $sys_id;
    }

    public static function reportValue($device, $key, $value, $gateway) {
        if (isset(self::$value_cache[$device][$key][$value])) {
            if (self::$value_cache[$device][$key][$value] == $value) {
                self::$value_cache[$device][$key]['last_received'] = time();
                if (!isset(self::$value_cache[$device][$key]['last_send']) || (self::$value_cache[$device][$key]['last_received'] - self::$value_cache[$device][$key]['last_send']) < 3600) {
                    return;
                }
            }
        }
        $udp_data = array('Type' => 'Status', 'Device' => self::$sys_id . $device, 'Data' => array($key => $value), 'Via' => $gateway);
        self::sendUdpPacket($udp_data);
        self::$value_cache[$device][$key]['last_send'] = time();
        self::$value_cache[$device][$key][$value] = $value;
        //Devices Table
        $data = array('System' => self::$sys_id, 'Device' => $device, 'Key' => $key, 'Value' => $value, 'Gateway' => $gateway);
        //echo("Daten f�r Datenbank Update: " . print_r($data, true) . "\n");
        self::dbReplaceInto('devices', $data);
    }

    private static function dbConnect() {
        if (self::$database === false || !is_object(self::$database) || mysqli_ping(self::$database) === false) {
            if (self::$database !== NULL) {
                echo("ERROR: mySQLi-Ping failed!\n");
                mysqli_close(self::$database);
                self::$database = NULL;
            }
            if (self::$database === NULL) {
                if ((self::$database = mysqli_connect('localhost', 'piproxy', 'raspberry', 'piproxy'))) {
                    mysqli_set_charset(self::$database, "utf8");
                    echo("Erfolgreich mit der Datenbank verbunden\n");
                } else {
                    //Fehler beim Verbinden zur Datenbank
                    echo('ERROR: Fehler beim Verbinden zur Datenbank: ' . mysqli_error(self::$database) . "\n");
                    self::$database = NULL;
                }
            }
        } else {
            //echo("DB seems just fine\n");
        }
    }

    private static function dbReplaceInto($table, $data) {
        self::dbConnect();
        if (!is_string($table) || empty($table)) {
            echo('Falscher Parameter für $table' . "\n");
            return false;
        }
        if (!is_array($data) || count($data) < 1) {
            echo('Falscher Parameter für $data' . "\n");
            return false;
        }
        if (self::$database !== false) {
            $keys = '';
            $values = '';
            foreach ($data as $k => $v) {
                $keys .= "`{$k}`, ";
                if ($v === NULL) {
                    $values .= 'NULL, ';
                } else {
                    $values .= "'" . mysqli_real_escape_string(self::$database, $v) . "', ";
                }
            }
            $keys = rtrim($keys, ', ');
            $values = rtrim($values, ', ');
            $query = "REPLACE INTO `{$table}` ({$keys}) VALUES ({$values})";
            if (!mysqli_query(self::$database, $query)) {
                echo('Fehler (' . mysqli_errno(self::$database) . ') beim Ersetzen: ' . mysqli_error(self::$database) . ' für Query "' . $query . '"' . "\n");
                return false;
            } else {
                return mysqli_insert_id(self::$database);
            }
        } else {
            errlog("Fehler beim Hinzufügen: Keine Verbindung zum mySQL-Server\n");
        }
    }

    private static function sendUdpPacket($udp_data) {
        if (self::$udp_socket_send == NULL) {
            echo("CREATING UDP SOCKET\n");
            self::$udp_socket_send = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        }
        if (self::$udp_socket_send) {
            $broadcast_string = json_encode($udp_data);
            socket_sendto(self::$udp_socket_send, $broadcast_string, strlen($broadcast_string), 0, self::$server_ip, 11000);
            //echo("UDP-Data sent!\n");
        }
        return;
    }

    private static function safe_socket_write(&$socket, $message) {
        $iterations = 0;
        $message .= "\r\n\0";
        $length = strlen($message);
        $bytes_sent = 0;
        while ($bytes_sent < $length) {
            $ret = socket_write($socket, substr($message, $bytes_sent));
            if ($ret === false || !is_numeric($ret))
                return false;
            $bytes_sent += $ret;
            $iterations++;
            if ($iterations >= 10000)
                return false;
            if ($iterations % 1000 == 0)
                sleep(1);
        }
        return $bytes_sent;
    }

}

if (isset($conf['sys_id'])) {
    hag::setSysId($conf['sys_id']);
} else {
    hag::setSysId('PI');
}
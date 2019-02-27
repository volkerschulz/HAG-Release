<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$remainder = '';

$message = $remainder . "Test1\r\n\0Test2\r\n\0Test3\r\n\0Tes";
$messages = explode("\r\n\0", $message);

$remainder = $messages[count($messages)-1];
unset($messages[count($messages)-1]);

if(empty($remainder)) {
    echo "No remainder!\n";
} else {
    echo "Remainder is: {$remainder}\n";
}

var_dump($messages);

$message = $remainder . "t";
$messages = explode("\r\n\0", $message);

$remainder = $messages[count($messages)-1];
unset($messages[count($messages)-1]);

if(empty($remainder)) {
    echo "No remainder!\n";
} else {
    echo "Remainder is: {$remainder}\n";
}

var_dump($messages);

$message = $remainder . "4\r\n\0Test5\r\n\0Test6\r\n\0";
$messages = explode("\r\n\0", $message);

$remainder = $messages[count($messages)-1];
unset($messages[count($messages)-1]);

if(empty($remainder)) {
    echo "No remainder!\n";
} else {
    echo "Remainder is: {$remainder}\n";
}

var_dump($messages);
<?php
/*
 * Example20: MQTT-Subscriber
 * Subscribes Messages from MQTT-Server (Broker)
 *
 * @requires phpMQTTClient from https://github.com/bluerhinos/phpMQTT
 *
 * @author  Stefan Hupe
 * @version 2013-09-30
 */

// Import Library

    require("/vendor/bluerhinos/phpmqtt/phpmqtt.php");

// Title

    echo "<h1>MQTT Subscriber</h1>";

// Setup Connection to MQTT-Server

    $mqServer['host'] = "localhost";
    $mqServer['port'] = 1883;
    $mqClientID = "PHP MQTT Client";

// Start Connection to MQTT-Server

    $mqtt = new phpMQTT($mqServer['host'], $mqServer['port'], $mqClientID);

    if(!$mqtt->connect()){
        exit(1);
    } else {
        echo "MQTT Connection okay!<br/>";
    }

// Debugging

    $mqtt->debug = false;

// Setup Subscription

    $topics['#'] = array("qos"=>0, "function"=>"procmsg");

// Start Subscription

    $mqtt->subscribe($topics,0);

// Wait for a message

    while($mqtt->proc()){
    }; //endwhile

// Close Connection to MQTT-Server

    $mqtt->close();

/**
 * Display MQTT-Message
 *
 * @param string $topic
 * @param string $msg
 *
 */
function procmsg($topic,$msg){
    echo "Message Recieved: ".date("r")." > Topic: {$topic} Message: $msg<br/>";
}



?>
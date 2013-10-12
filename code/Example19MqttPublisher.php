<?php
/**
 * Example19: MQTT Publisher
 * Sends a Message to the MQTT Server
 *
 * @requires phpMQTTClient from https://github.com/bluerhinos/phpMQTT
 *
 * @author  Stefan Hupe
 * @version
 */

// Import Library

    require("/vendor/bluerhinos/phpmqtt/phpMQTT.php");

// Title

    echo "<h1>MQTT Publisher</h1>";

// Setup MQTT-Connection

    $mqServer['host'] = "localhost";
    $mqServer['port'] = 1883;
    $mqClientID = "PHP MQTT Client";

// Start MQTT-Connection

    $mqtt = new phpMQTT($mqServer['host'], $mqServer['port'], $mqClientID);

// Sending Messages if connected

    if ($mqtt->connect()) {

        echo "connected to server<br/>";

        // create message

            $mqMessage['topic'] = "test/message";
            $mqMessage['qos'] = 1;
            $mqMessage['message'] = "Hello World! at ".date("r");

        // send message

            echo $mqMessage['message'] . "<br/>";

            $mqtt->publish($mqMessage['topic'],$mqMessage['message'],$mqMessage['qos']);

        // close mqtt-connection

            $mqtt->close();

            echo "Done";

    }; //endif



?>
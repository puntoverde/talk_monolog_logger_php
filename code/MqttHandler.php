<?php

/*
 * Mqtt-Handler
 *
 * Handler for the MQTT-Protocol for Monolog-Logger to send Log Messages to an
 * MQTT-Server
 *
 * @require phpMQTT from https://github.com/bluerhinos/phpMQTT for MQTTHandler
 *
 * @author: Stefan Hupe
 * @since:  2013-10-04
 */

namespace Monolog\Handler;

use Monolog\Logger;
use phpMQTT;

require_once('vendor/bluerhinos/phpMQTT/phpMQTT.php');

/**
 * Sends Log Messages to an MQTT-Server
 *
 * @example  use Monolog\Handler\mqttHandler;
 *           $clientID = "PHP MQTT Client";
 *           $host = "localhost";
 *           $port = 1883;
 *           $level = Logger::DEBUG;
 *           $bubble = true;
 *           $handler = new MqttHandler($clientID, $host, $port);
 *           $logger->pushHandler($handler);
 *
 * @param string $clientId         ID of this MQTT-Client (Publisher)
 * @param string $host             IP-Adress of the MQTT-Server
 * @param string $port             Port of the MQTT-Server
 *
 * @return void
 */
class MqttHandler extends AbstractProcessingHandler
{
    protected $clientID;
    protected $host;
    protected $port;

    /**
     * @param string $clientId      ID of this MQTT-Client
     * @param string $host          IP-Adress of the MQTT-Server
     * @param string $port          Port of the MQTT-Server
     * @param integer $level        The minimum logging level at which this handler will be triggered
     * @param Boolean $bubble       Whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(
        $clientId,
        $host,
        $port = 1883,
        $level = Logger::DEBUG,
        $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->clientID = $clientId;
        $this->host = $host;
        $this->port = $port;

        $this->client = new phpMQTT($this->host, $this->port, $this->clientID);
        $this->client->connect();

    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        $this->client->close();
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        //    $record['message'] => (string) $message,
        //    $record['context'] => $context,
        //    $record['level'] => $level,
        //    $record['level_name'] => static::getLevelName($level),
        //    $record['channel'] => $this->name,
        //    $record['datetime'] => \DateTime::createFromFormat('U.u', sprintf('%.6F', microtime(true)), static::$timezone)->setTimezone(static::$timezone),
        //    $record['extra'] => array()

        $mqMessage['publisher'] = $this->clientID;
        $mqMessage['topic'] = $record['channel'] . "/" . $record['level_name'];
        $mqMessage['qos'] = 0;
        $mqMessage['message'] = (string)$record['formatted'];

        $this->client->publish($mqMessage['topic'], $mqMessage['message'], $mqMessage['qos']);

    }
}

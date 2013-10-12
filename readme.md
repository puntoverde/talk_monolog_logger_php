Debug-Messages and Logging with Monolog for PHP
===============================================

Slides and example code of my ViennaPHP-Talk in October 2013.

* Demonstration, how to collect all debug and log information/messages from PHP with the MONOLOG Logger. 
* Reintegration of this messages into PHP with PHP DebugBar.
* Message distribution with MQTT to a message server (MQ-Server).
+ Demonstration of a proof of concept for the MQ-System for remote debugging and logging.

Speacial Features
-----------------

The example code can be the missing cookbook for Monolog, because you can find there examples and descriptions for many many features of Monolog.

Requirements
------------

* Monolog Logger: https://github.com/Seldaek/monolog
* PHPDebugBar: http://phpdebugbar.com
* phpMQTT: https://github.com/bluerhinos/phpMQTT

* Composer: http://getcomposer.org
* MQTT-Server Mosca: http://mcollina.github.io/mosca/ (node.js)
* node.js for the MQTT-Server: http://nodejs.org
* MQTT-Client MQTT.app: https://itunes.apple.com/us/app/mqtt/id560697602?mt=12 for Mac OSX

Installation
------------

1. Create a project folder
2. Install Composer
3. Copy all files from code folder to your project folder
4. Run <code>composer.phar install</code>.
5. Move file <code>MqttHandler.php</code> to <code>/vendor/monolog/monolog/src/Monolog/Handler</code>. It is the missing MQTT-Handler for Monolog.
6. Run the examples in your browser or your IDE and enjoy it!

Copyright
---------

Feel free to share and use the code.
If you want to use the slides for commercial purpose please ask me.

Stefan


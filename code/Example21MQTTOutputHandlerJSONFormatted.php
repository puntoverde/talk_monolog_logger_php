<?php
/**
 * Debug Messages and Logging with Monolog
 * Example20: MQTT Output Handler JSON Formatted
 * Formatte Message into JSON
 * Send Messages to MQTT-Server (Broker)
 * 
 * @require	Monolog
 * @require Debugbar
 * @require phpMQTT from https://github.com/bluerhinos/phpMQTT for MQTTHandler
 *
 * @author	Stefan Hupe
 * @version	2013-09-30
 *
 * @todo %context% and %extra% have to be jsonfied in the formatter.
 */
	
// Variables for demonstration

	$var = "Hello, World!";
	$var_array = array('one', 'two', 'three');
		 
// ***** Debug messages and logging with Monolog *****

	// Setup -----------------------------------------------------------------------

		// Autoloading

			require __DIR__ . '\vendor\autoload.php';
			 
		// Create new Monolog Logger
		
			// First Channel
		  
				use Monolog\Logger;
				$channel = 'my_logger';
				$logger = new Logger($channel);

        // Log Output Handler

            // MQTT #

                use Monolog\Handler\mqttHandler;
                $clientID = "PHP MQTT Client";
                $host = "lavande.local";
                $port = 1883;
                $handler = new MqttHandler($clientID, $host, $port);

            // JSON Formatted

                // Formatter

                    use Monolog\Formatter\LineFormatter;

                // New date format instead "Y-m-d H:i:s"

                    $dateFormat = "Y-m-d\TH:i:s.uP";

                // Format Output

                    $output = '{
                        "publisher" : "' . $clientID . '"
                        "timestamp" : "%datetime%",
                        "topic" : "%channel%/%level_name%",
                        "message" : {
                            "channel" : "%channel%",
                            "level" : "%level_name%",
                            "message" : "%message%",
                            "context" : "%context%",
                            "extra" : "%extra%",
                        }
                    }';

                // Create a formatter

                    $formatter = new LineFormatter($output, $dateFormat);

                // Assign formatter to handler

                    $handler->setFormatter($formatter);

            // Push Handler to Logger

                $logger->pushHandler($handler);

    // DebugBar --------------------------------------------------------------------

        // Activate DebugBar

            use DebugBar\StandardDebugBar;
            session_start();
            $debugbar = new StandardDebugBar();
            $debugbarRenderer = $debugbar->getJavascriptRenderer();

        // Collect messages from Monolog and display them in the DebugBar

            $debugbar->addCollector(new DebugBar\Bridge\MonologCollector($logger));


    // Messages --------------------------------------------------------------------

        // Monolog Messages (PSR-3, RFC 5424)

            $logger->emergency('Emergency Message');
            $logger->alert('Alert Message');
            $logger->critical('Critical Message');
            $logger->error('Error Message');
            $logger->warning('Warning');
            $logger->notice('Notice');
            $logger->info('Info Message');
            $logger->debug('Debug Message');

    // ***** HTML-Output for DebugBar *****

        echo "
            <html>
                <head>
                    " . $debugbarRenderer->renderHead() . "
                </head>
                <body>
                    <content>
                        <h1>MQTT & Monolog & DebugBar</h1>
                        <p>DebugBar at the bottom of the page</p>
                    </content>
                    <footer>
                        " . $debugbarRenderer->render() . "
                    </footer>
                </body>
            </html>";

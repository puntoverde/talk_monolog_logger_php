<?php
/**
 * Debug Messages and Logging with Monolog
 * Example05: Multiple Loggers
 * 
 * @require	Monolog
 * @require Debugbar
 *
 * @author	Stefan Hupe
 * @version	2013-09-30
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

            // Second Channel

                $channel = 'security_logger';
                $securityLogger = new Logger($channel);

        // Log Output Handler

            // Logging to Screen

                use Monolog\Handler\StreamHandler;
                $target = "php://output";
                $level = "";
                $handler = new StreamHandler($target, $level);

            // Output Handler for First Channel

                $logger->pushHandler($handler);

            // Output Handler for Second Channel

                $securityLogger->pushHandler($handler);

	// Messages --------------------------------------------------------------------

		// Monolog Messages (PSR-3, RFC 5424)

            // Logging to Second Channel

                $securityLogger->emergency('Emergency Message');
                $securityLogger->alert('Alert Message');
                $securityLogger->critical('Critical Message');
                $securityLogger->error('Error Message');

            // Logging to First Channel

                $logger->warning('Warning');
                $logger->notice('Notice');
                $logger->info('Info Message');
                $logger->debug('Debug Message');

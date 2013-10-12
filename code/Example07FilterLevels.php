<?php
/**
 * Debug Messages and Logging with Monolog
 * Example07: Filter Levels of Messages
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

        // Log Output Handler

            // Logging to Screen

                 use Monolog\Handler\StreamHandler;
                 $target = "php://output";

            // Filter: Select only Messages from Level ERROR or up

                 $level = Logger::ERROR;
                 $handler = new StreamHandler($target, $level);

            // Ouput Handler for First Channel

                 $logger->pushHandler($handler);

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

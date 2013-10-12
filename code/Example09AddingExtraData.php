<?php
/**
 * Debug Messages and Logging with Monolog
 * Example09: Adding Extra Data
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
                $level = "";
                $handler = new StreamHandler($target, $level);

            // Ouput Handler for First Channel

                $logger->pushHandler($handler);

	// Messages --------------------------------------------------------------------

		// Adding extra data by using logging context

			$extraData = array(
                            "name" => "Jean",
                            "city" => "Paris",
                            "rate" => 4321
                         );

			$logger->info('Info Message', $extraData);

        // Adding extra data to all messages by using $record manipulated by Processors

            $logger->pushProcessor(function($record){
                $record['extra']['name'] = "Ron";
                $record['extra']['city'] = "London";
                $record['extra']['rate'] = "6574";

                return $record;
            });

        // Creating Messages with extra data by Processor

            $logger->warning('Warning');
            $logger->notice('Notice');
            $logger->info('Info Message');
            $logger->debug('Debug Message');


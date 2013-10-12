<?php
/**
 * Debug Messages and Logging with Monolog
 * Example12: Catch echo, print_r, var_dump, debug_backtrace
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

        // Use of "quick & dirty" (echo, print_r, var_dump)

            // echo

                $logger->debug('echo($var): ' . $var);

            // print_r

                $logger->debug('print_r($var_array): ' . print_r($var_array, true));

            // var_dump

                $logger->debug('var_dump($var_array): ' . var_export($var_array, true));

        // Backtrace Stack

            // debug_print_backtrace: Ablaufverfolgung ausgeben

                $logger->debug('print_debug_backtrace: ' . var_export(debug_backtrace(), true));

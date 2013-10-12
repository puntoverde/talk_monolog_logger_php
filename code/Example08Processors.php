<?php
/**
 * Debug Messages and Logging with Monolog
 * Example08: Processors
 *
 * Standard Processors are
 * - IntrospectionProcessor
 * - WebProcessor
 * - MemoryUsageProcessor
 * - MemoryPeakUsageProcessor
 * - ProcessIdProcessor
 * - UidProcessor
 *
 * For details how to use have a look at /test/monolog on github
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

            // Processor for Handler

                $processor = new \Monolog\Processor\IntrospectionProcessor();
                $handler->pushProcessor($processor);

            // Ouput Handler for First Channel

                $logger->pushHandler($handler);

            // Output Handler for Second Channel

                $securityLogger->pushHandler($handler);

             // Processor for Logger (Channel)

                $processor = new \Monolog\Processor\MemoryUsageProcessor();
                $securityLogger->pushProcessor($processor);

	// Messages --------------------------------------------------------------------

		// Monolog Messages (PSR-3, RFC 5424)

			$securityLogger->emergency('Emergency Message');
			$securityLogger->alert('Alert Message');
			$securityLogger->critical('Critical Message');
			$securityLogger->error('Error Message');
			$logger->warning('Warning');
			$logger->notice('Notice');
			$logger->info('Info Message');
			$logger->debug('Debug Message');

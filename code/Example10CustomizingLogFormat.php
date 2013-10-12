<?php
/**
 * Debug Messages and Logging with Monolog
 * Example10: Customizing Log Format with Formatter
 *
 * Standard Formatters:
 * - LineFormatter
 * - NormalizerFormatter
 * - JsonFormatter
 * - WildfireFormatter
 * - ChromePHPFormatter
 * - GelfFormatter
 * - LogstashFormatter
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

        // Log Output Handler

            // Logging to Screen

                use Monolog\Handler\StreamHandler;
                $target = "php://output";
                $level = "";
                $handler = new StreamHandler($target, $level);

            // Formatter

                use Monolog\Formatter\LineFormatter;

                // New date format instead "Y-m-d H:i:s"

                    $dateFormat = "Y-m-d\TH:i:s.uP";

                // Default output format is
                // "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"

                    $output = "Timestamp: %datetime% > Channel: %channel% > Level: %level_name% > Message: %message% > Context: %context% > Extra: %extra%\n";

                // Create a formatter

                    $formatter = new LineFormatter($output, $dateFormat);

                // Assign formatter to handler

                    $handler->setFormatter($formatter);

            // Ouput Handler for First Channel

                $logger->pushHandler($handler);

	// Messages --------------------------------------------------------------------

			$logger->info('1. Info Message');


    // JSON-Formatter --------------------------------------------------------------

        // Define Formatter

            use Monolog\Formatter\JsonFormatter;

            $formatter = new JsonFormatter();

            $handler->setFormatter($formatter);

        // Message

            $logger->info('2. Info Message');


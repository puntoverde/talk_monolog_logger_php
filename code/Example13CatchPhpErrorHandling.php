<?php
/**
 * Debug Messages and Logging with Monolog
 * Example13: Catch PHP Error Handling
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

    // Catch PHP Error Handling ----------------------------------------------------

        // Catch Normal Errors

            use Monolog\ErrorHandler;

            $errorHandler = new ErrorHandler($logger);
            $errorLevelMap = array (
                E_USER_NOTICE => Logger::EMERGENCY
            );
            $callPrevious = false;
            $errorHandler->registerErrorHandler($errorLevelMap, $callPrevious);

        // Catch Fatal Errors (Shutdown)

            $errorHandler->registerFatalHandler();

	// Messages --------------------------------------------------------------------

        // Normal Message

            $logger->info('Info Message: ' . $var);

        // Trigger PHP Error Message

            trigger_error('User Defined Error Message', E_USER_ERROR);
            trigger_error('User Defined Warning', E_USER_WARNING);
            trigger_error('User Defined Notice', E_USER_NOTICE);

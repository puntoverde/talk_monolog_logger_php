<?php
/**
 * Debug Messages and Logging with Monolog
 * Example14: Catch Exceptions
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

    // Catch Exceptions ------------------------------------------------------------

        // Exceptions

            use Monolog\ErrorHandler;

            $errorHandler = new ErrorHandler($logger);
            $errorHandler->registerExceptionHandler();

// Exceptions ----------------------------------------------------------------------

    // try/catch Exceptions

        try {
            // ...
        } //endtry

        catch (Exception $e) {
            echo "Exception Message " . $e->getMessage() . LF;
            echo "Exception Code " . $e->getCode() . LF;
            echo "Exception File " . $e->getFile() . LF;
            echo "Exception Line " . $e->getLine() . LF;
            echo "Stacktrace " . var_export($e->getTrace(), true) . LF;
        }; //endcatch

    // Exceptions

        throw new Exception("This should cause a fatal error and this message will be lost");

<?php
/**
 * Debug Messages and Logging with Monolog
 * Example16: PHPDebugBar All Messages
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

            // void

    // Catch PHP Error Handling & Fatal Errors & Exceptions ------------------------

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

        // Catch Exceptions

            $errorHandler->registerExceptionHandler();

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

        // Trigger PHP Error Message

            trigger_error('User Defined Error Message', E_USER_ERROR);
            trigger_error('User Defined Warning', E_USER_WARNING);
            trigger_error('User Defined Notice', E_USER_NOTICE);

        // Exceptions

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

                // throw new Exception("This should cause a fatal error and this message will be lost");

    // ***** HTML-Output for DebugBar *****

       echo "
            <html>
                <head>
                    " . $debugbarRenderer->renderHead() . "
                </head>
                <body>
                    <content>
                        <h1>Monolog & DebugBar</h1>
                        <p>DebugBar at the bottom of the page</p>
                    </content>
                    <footer>
                        " . $debugbarRenderer->render() . "
                    </footer>
                </body>
            </html>";



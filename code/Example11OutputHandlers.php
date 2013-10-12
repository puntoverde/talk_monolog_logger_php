<?php
/**
 * Debug Messages and Logging with Monolog
 * Example06: Output Handlers
 *
 * Standard Output Handlers are:
 * - StreamHandler
 * - RotatingFileHandler
 * - SyslogHandler
 * - ErrorLogHandler
 * - NativeMailerHandler
 * - SwiftMailerHanlder
 * - PushoverHandler
 * - HipchatHandler
 * - SocketHandler
 * - AmqpHandler
 * - GelfHandler
 * - CubeHandler
 * - RavenHandler
 * - ZendMonitorHandler
 * - NewRelicHandler
 * - FirePHPHandler
 * - ChromePHPHandler
 * - RedisHandler
 * - MongoDBHandler
 * - CouchDBHandler
 * - DoctrineCouchDBHandler
 * - PDOHandler (see /monolog/doc/extending)
 * - FingersCrossedHandler
 * - NullHandler
 * - BufferHandler
 * - GroupHandler
 * - TestHandler
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
                $screenHandler = new StreamHandler($target, $level);

            // Logging to File

                $target = "path/to/logfile.log";
                $level = "";
                $fileHandler = new StreamHandler($target, $level);

            // Syslog

                use Monolog\Handler\SyslogHandler;
                use Monolog\Formatter\LineFormatter;
                $ident = "myfacility";
                $facility = LOG_USER;
                $level = "";
                $syslogHandler = new SyslogHandler($ident, $facility, $level);
                $formatter = new LineFormatter("%channel%.%level_name%: %message% %extra%");
                $syslogHandler->setFormatter($formatter);

            // PHP ErrorLog

                use Monolog\Handler\ErrorLogHandler;
                $type = 0;
                $level = "";
                $errorLogHandler = new ErrorLogHandler();

            // Logging to Email

                use Monolog\Handler\NativeMailerHandler;
                $level = "Logger::ALERT";
                $email_from = "system@computer.local";
                $email_to = "admin@email.com";
                $subject = "Alert";
                $handler = new NativeMailerHandler($email_to, $subject, $email_from, $level );
                $logger->pushHandler($handler);

            // Sentry (using Raven) # https://github.com/getsentry/raven-php has to be installed

                use Monolog\Handler\RavenHandler;
                $apiKey="";
                $client = new Raven_Client($apiKey);
                $level = Logger::ERROR;
                $ravenHandler = new RavenHandler ($client, $level);
                $formatter = new LineFormatter("%message% %context% %extra%\n");
                $ravenHhandler->setFormatter($formatter);

            // Output Handler for First Channel

                $logger->pushHandler($screenHandler);

            // Output Handler for Second Channel

                $securityLogger->pushHandler($screenHandler);
                $securityLogger->pushHandler($fileHandler);

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

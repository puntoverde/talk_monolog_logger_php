<?php
/**
 * Debug Messages and Logging with Monolog
 * Excample18: Activation Flags
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
			 
		// Activate/Deactivate Logging
		  
			$UseMonologLogger = 'On';     // 'Off' : Deactivate Monolog-Logger    --> error_reporting
			$UseDebugBar = 'On';          // 'Off' : Deactivete / Hide Debugbar-Logger
			$DisplayLogOnScreen = 'On';   // 'On' : EchoHandler : Display Messages on Screen  -> ini_set(display_error), ini_set(display_startup_error)
			$LogToFile = 'On';            // 'On' : FileHandler : Log Messages to File        -> ini_set(log_error) -> ini_set(error_log);
			$LogToMqServer = 'On';        // 'On' : MqttHandler : Log Messages to MQTT-Server
			 
		// Create new Monolog Logger
		
			// ...
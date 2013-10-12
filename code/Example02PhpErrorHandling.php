<?php
/**
 * Debug Messages and Logging
 * Example02: PHP Error Handling
 *
 * @author	Stefan Hupe
 * @version 2013-09-30
 */
 
// Standard Definitions

	define('LF', "<br/>"); // Linefeed
	
// Variables for demonstration

	$var = "Hello, World!";
	$var_array = array('one', 'two', 'three');
		 
// ***** PHP Error Handling *****

	// Setup -----------------------------------------------------------------------
	
		// error_reporting - Sets which PHP errors are reported
		//		E_ALL                  E_COMPILE_WARNING     
		// 		E_ERROR                E_USER_ERROR
        //		E_WARNING			   E_USER_WARNING
        //		E_PARSE			       E_USER_NOTICE
        //		E_NOTICE               E_STRICT
        //		E_CORE_ERROR		   E_RECOVERABLE_ERROR
        //		E_CORE_WARNING         E_DEPRECATED
        //		E_COMPILE_ERROR		   E_USER_DEPRECATED
     
			error_reporting(E_ALL | E_STRICT); 
		 
		// Display Messages on Screen

			ini_set('display_errors', 'On'); // ini_set('display_errors' 1);

		// Display errors during start up

			ini_set('display_startup_errors', 'On'); // ini_set('display_startup_errors', 1);

		// Write Messages to Logfile

			ini_set('error_log', 'On');

		// Define Logfile

			ini_set ('log_error', '/path/to/logfile.log');

		// Ignore repeated Errors

			ini_set('ignore_repeated_errors', 1);

		// Don't display HTML errors

			ini_set('html_errors', 'Off'); //ini_set('html_errors' , 0);
			
	// User Defined Error Messages -------------------------------------------------
		 
		// Create User Defined Notice

			echo "trigger_error(): E_USER_NOTICE " . LF;
			trigger_error("message: " . $var, E_USER_NOTICE);
			echo LF . LF;

        // Create User Defined Warning
		 
			echo "trigger_error(): E_USER_WARNING " . LF;
			trigger_error("message: " . $var, E_USER_WARNING);
			echo LF . LF;

        // Create User Defined Error

			echo "trigger_error(): E_USER_ERROR " . LF;
			trigger_error("message: " . $var, E_USER_ERROR);
			echo LF . LF;

    // Show Stack ------------------------------------------------------------------

		// debug_backtrace: Generate a Backtrace

			echo "debug_print_backtrace: " . LF;
			debug_print_backtrace(); 
			echo LF . LF;

    // Logging to File etc . -------------------------------------------------------

		// error_log: sends error-message to
		// 		0 : php error_log file
		// 		1 : Email
		// 		2 : void
		// 		3 : to File
		// 		4 : to SAPI-Logging-Handler

			echo "error_log(): " . LF;

        // Send to PHP Logfile

			error_log("Write this message to PHP-Logfile: " . $var, 0);

        // Send by Mail

			error_log("Send this message as Email : " . $var, 1, "admin@domain.tdl");

        // Write to File

			error_log("Write this message to file : " . $var, 3, "/path/to/logfile.log");
			echo LF . LF;

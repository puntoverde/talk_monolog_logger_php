<?php
/**
 * Debus-Messages and Logging
 * Example01: Quick and Dirty
 *
 * @author	Stefan Hupe
 * @version	2013-09-30

*/
 
// Standard Definitions

	define('LF', "<br/>"); // Linefeed
	
// Variables for demonstration

	$var = "Hello, World!";
	$var_array = array('one', 'two', 'three');
 
// ***** Quick & Dirty *****

	// Display ---------------------------------------------------------------------

		// echo: Displays variable value on screen
  
			echo "echo \$var" . LF;
			echo $var;
			echo LF . LF;
  
		// print_r: Displays information about a variable (array, object) in a way 
		// that's readable by humans
	  
			echo "print_r(\$var_array)" . LF;
			print_r($var_array);
			echo LF . LF;
		 
		// var_dump: Dumps information about a variable
	  
			echo "var_dump(\$var_array)" . LF;
			var_dump($var_array);
			echo LF . LF;
			
		// Toggle Message On with comment
		
			echo "Debug Message Toggled On";
			
		// Toggle Message Off with comment
		
			//echo "Debug Message";
		 
	// Log to File -----------------------------------------------------------------
	
		// Logfile Definition
		
			$logfile = "path/to/logfile.log";
	
		// echo
	 
			file_put_contents($logfile, $var, FILE_APPEND | LOCK_EX);
			
		// print_r
			
			file_put_contents($logfile, print_r($var_array, true), FILE_APPEND | LOCK_EX);
			
		// var_dump
		
			file_put_contents($logfile, var_export($var_array, true), FILE_APPEND | LOCK_EX);
			
	
	
	
	
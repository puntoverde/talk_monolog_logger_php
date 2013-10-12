<?php
/**
 * Debug Messages and Logging
 * Example03: Exceptions
 *
 * @author	Stefan Hupe
 * @version 2013-09-30
 */
 
// Standard Definitions

	define('LF', "<br/>"); // Linefeed
	
// Variables for demonstration

	$var = "Hello, World!";
	$var_array = array('one', 'two', 'three');
		 
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
			
			
			
			

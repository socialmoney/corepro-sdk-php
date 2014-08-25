<?php

class ApiException extends Exception {
public $errorCollection;
    // Redefine the exception so message isn't optional
/*
    public function __construct($message, $code = 0, Exception $previous = null) {
        // some code
    
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }
*/
    public function __construct($errorCollection){
$this->errorCollection=$errorCollection;
    parent::__construct("An API Error has occurred.");
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
 
function GetAllErrorInfo(){

	$errorMessage="";
	foreach($this->errorCollection as $key=>$value){
		$error= $this->objectToObject($this->errorCollection[$key], 'Error');
		$errorMessage=$errorMessage.$error->message;
	}
	return $errorMessage;
}

//http://stackoverflow.com/a/3243949
function objectToObject($instance, $className) {
    return unserialize(sprintf(
        'O:%d:"%s"%s',
        strlen($className),
        $className,
        strstr(strstr(serialize($instance), '"'), ':')
    ));
}

}

?>
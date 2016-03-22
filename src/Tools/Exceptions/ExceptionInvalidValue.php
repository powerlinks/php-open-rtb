<?php
/**
 * ExceptionInvalidValue.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 09:44
 */

namespace PowerLinks\OpenRtb\Tools\Exceptions;

use Exception;

class ExceptionInvalidValue extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = $message.' - '.$this->formatTrace();
    }

    private function formatTrace()
    {
        return
            $this->retriveValue(1,'class').'::'.
            $this->retriveValue(1, 'function').'::'.
            $this->retriveValue(0, 'line').
            '['.$this->retriveValue(0, 'function').']';
    }

    private function retriveValue($index, $subIndex)
    {
        $trace = $this->getTrace();
        return isset($trace[$index][$subIndex]) ? $trace[$index][$subIndex] : 'null';
    }
}
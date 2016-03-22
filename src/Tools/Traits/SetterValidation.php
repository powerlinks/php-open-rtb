<?php
/**
 * SetterValidation.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 03/09/15 - 09:45
 */

namespace PowerLinks\OpenRtb\Tools\Traits;

use PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue;

trait SetterValidation
{
    /**
     * @param mixed $string
     * @param string $line
     * @return string
     * @throws ExceptionInvalidValue
     */
    protected function validateVersion($string, $line = '')
    {
        if (is_numeric($string)) {
            $string = (string) $string;
        }

        if ( ! is_string($string)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a string - %s : %s',
                    $this->argumentsForError($string, $line)
                )
            );
        }
        return $string;
    }

    /**
     * @param string $string
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateString($string, $line = '')
    {
        if ( ! is_string($string)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a string - %s : %s',
                    $this->argumentsForError($string, $line)
                )
            );
        }
        return true;
    }

    /**
     * @param int $int
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateInt($int, $line = '')
    {
        if (is_numeric($int) && ! is_float($int)) {
            $int = (int) $int;
        }

        if ( ! is_int($int)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not an integer - %s : %s',
                    $this->argumentsForError($int, $line)
                )
            );
        }
        return $int;
    }

    /**
     * @param int $int
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validatePositiveInt($int, $line = '')
    {
        if (is_numeric($int) && ! is_float($int)) {
            $int = (int) $int;
        }

        if ( ! is_int($int) || $int < 0) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a valid integer - %s : %s',
                    $this->argumentsForError($int, $line)
                )
            );
        }
        return $int;
    }

    /**
     * @param float|int $float
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateNumericToFloat($float, $line = '')
    {
        if (is_numeric($float)) {
            $float = (float) $float;
        }

        if ( ! is_float($float)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a float - %s : %s',
                    $this->argumentsForError($float, $line)
                )
            );
        }
        return $float;
    }

    /**
     * @param float $float
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validatePositiveFloat($float, $line = '')
    {
        if (is_numeric($float)) {
            $float = (float) $float;
        }

        if ( ! is_float($float) || $float < 0) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a positive float - %s : %s',
                    $this->argumentsForError($float, $line)
                )
            );
        }
        return $float;
    }

    /**
     * @param mixed $value
     * @param array $values
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateIn($value, array $values, $line = '')
    {
        if ( ! in_array($value, $values)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not allowed - %s : %s',
                    $this->argumentsForError($value, $line)
                )
            );
        }
        return true;
    }

    /**
     * @param string $md5
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateMd5($md5, $line = '')
    {
        if ( ! is_string($md5) || ! (bool) preg_match('/^[0-9a-f]{32}$/i', $md5)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not MD5 - %s : %s',
                    $this->argumentsForError($md5, $line)
                )
            );
        }
        return true;
    }

    /**
     * @param string $sha1
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateSha1($sha1, $line = '')
    {
        if ( ! is_string($sha1) || ! (bool) preg_match('/^[0-9a-f]{40}$/i', $sha1)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not SHA1 - %s : %s',
                    $this->argumentsForError($sha1, $line)
                )
            );
        }
        return true;
    }

    /**
     * @param string $ip
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateIp($ip, $line = '')
    {
        if ( ! is_string($ip) || ! (bool) preg_match('/^[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}$/', $ip)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a valid IP - %s : %s',
                    $this->argumentsForError($ip, $line)
                )
            );
        }
        return true;
    }

    /**
     * @param mixed $variable
     * @param int $line
     * @return array
     */
    private function argumentsForError($variable, $line)
    {
        return [
            is_scalar($variable) ? $variable : get_class($variable),
            gettype($variable),
            __CLASS__,
            $line
        ];
    }
}
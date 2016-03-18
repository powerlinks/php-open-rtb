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
     * @param string $string
     * @param string $line
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateNumericString($string, $line = '')
    {
        if (is_numeric($string)) {
            $string = (string)$string;
        }

        if ( ! is_string($string)) {
            throw new ExceptionInvalidValue(
                sprintf('Argument\'s value (%s of type %s) is not a string - %s : %s', $string, gettype($string), __CLASS__, $line)
            );
        }
        return true;
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
                sprintf('Argument\'s value (%s of type %s) is not a string - %s : %s', $string, gettype($string), __CLASS__, $line)
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
        if (is_numeric($int)) {
            $int = (int)$int;
        }

        if ( ! is_int($int)) {
            throw new ExceptionInvalidValue(
                sprintf('Argument\'s value (%s of type %s) is not an integer - %s : %s', $int, gettype($int), __CLASS__, $line)
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
    protected function validatePositiveInt($int, $line = '')
    {
        if (is_numeric($int)) {
            $int = (int)$int;
        }

        if ( ! is_int($int) || $int < 0) {
            throw new ExceptionInvalidValue(
                sprintf('Argument\'s value (%s of type %s) is not a valid integer - %s : %s', $int, gettype($int), __CLASS__, $line)
            );
        }
        return true;
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
                sprintf('Argument\'s value (%s of type %s) is not a float - %s : %s', $float, gettype($float), __CLASS__, $line)
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
    protected function validateFloat($float, $line = '')
    {
        if ( ! is_float($float)) {
            throw new ExceptionInvalidValue(
                sprintf('Argument\'s value (%s of type %s) is not a float - %s : %s', $float, gettype($float), __CLASS__, $line)
            );
        }
        return true;
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
                sprintf('Argument\'s value (%s of type %s) is not a positive float - %s : %s', $float, gettype($float), __CLASS__, $line)
            );
        }
        return true;
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
                sprintf('Argument\'s value (%s of type %s) is not allowed - %s : %s : %s', $value, gettype($value), __CLASS__, __METHOD__, $line)
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
                sprintf('Argument\'s value (%s) is not an MD5 - %s : %s', $md5, __CLASS__, $line)
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
                sprintf('Argument\'s value (%s) is not a SHA1 - %s : %s', $sha1, __CLASS__, $line)
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
                sprintf('Argument\'s value (%s) is not a valid IP - %s : %s', $ip, __CLASS__, $line)
            );
        }
        return true;
    }
}
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
     * @return string
     * @throws ExceptionInvalidValue
     */
    protected function validateVersion($string)
    {
        if (is_numeric($string)) {
            $string = (string) $string;
        }

        if ( ! is_string($string)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a string',
                    $this->argumentsForError($string)
                )
            );
        }
        return $string;
    }

    /**
     * @param string $string
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateString($string)
    {
        if ( ! is_string($string)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a string',
                    $this->argumentsForError($string)
                )
            );
        }
        return true;
    }

    /**
     * @param int $int
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateInt($int)
    {
        if (is_numeric($int) && ! is_float($int)) {
            $int = (int) $int;
        }

        if ( ! is_int($int)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not an integer',
                    $this->argumentsForError($int)
                )
            );
        }
        return $int;
    }

    /**
     * @param int $int
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validatePositiveInt($int)
    {
        if (is_numeric($int) && ! is_float($int)) {
            $int = (int) $int;
        }

        if ( ! is_int($int) || $int < 0) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a valid integer',
                    $this->argumentsForError($int)
                )
            );
        }
        return $int;
    }

    /**
     * @param float|int $float
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateNumericToFloat($float)
    {
        if (is_numeric($float)) {
            $float = (float) $float;
        }

        if ( ! is_float($float)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a float',
                    $this->argumentsForError($float)
                )
            );
        }
        return $float;
    }

    /**
     * @param float $float
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validatePositiveFloat($float)
    {
        if (is_numeric($float)) {
            $float = (float) $float;
        }

        if ( ! is_float($float) || $float < 0) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a positive float',
                    $this->argumentsForError($float)
                )
            );
        }
        return $float;
    }

    /**
     * @param mixed $value
     * @param array $values
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateIn($value, array $values)
    {
        if ( ! in_array($value, $values)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not allowed',
                    $this->argumentsForError($value)
                )
            );
        }
        return true;
    }

    /**
     * @param mixed $value
     * @param array $values
     * @return bool
     * @throws ExceptionInvalidValue
     * Taking into account custom 500+ values, which are legal according to the spec, though
     * we may not have a representation of them
     */
    protected function validateInWithCustom500Values($value, array $values)
    {
        if ( ! in_array($value, $values) && ! (is_numeric($value) && $value >= 500) ) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not allowed',
                    $this->argumentsForError($value)
                )
            );
        }
        return true;
    }

    /**
     * @param string $md5
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateMd5($md5)
    {
        if ( ! is_string($md5) || ! (bool) preg_match('/^[0-9a-f]{32}$/i', $md5)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not MD5',
                    $this->argumentsForError($md5)
                )
            );
        }
        return true;
    }

    /**
     * @param string $sha1
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateSha1($sha1)
    {
        if ( ! is_string($sha1) || ! (bool) preg_match('/^[0-9a-f]{40}$/i', $sha1)) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not SHA1',
                    $this->argumentsForError($sha1)
                )
            );
        }
        return true;
    }

    /**
     * @param string $ip
     * @return bool
     * @throws ExceptionInvalidValue
     */
    protected function validateIp($ip)
    {
        /**
         * TODO According to the spec, if the regs.coppa field is set to 1, then the IP's last octet should be
         * truncated. So we may receive a valid IP like 192.168.1. Handle this edge case.
         */
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            throw new ExceptionInvalidValue(
                vsprintf(
                    'Argument\'s value (%s of type %s) is not a valid IP',
                    $this->argumentsForError($ip)
                )
            );
        }
        return true;
    }

    /**
     * @param mixed $variable
     * @return array
     */
    private function argumentsForError($variable)
    {
        return [
            is_scalar($variable) ? $variable : get_class($variable),
            gettype($variable)
        ];
    }
}
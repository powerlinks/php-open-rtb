<?php
/**
 * AccessProtectedMethod.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 05/08/15 - 10:58
 */

namespace PowerLinks\OpenRtb\Tests;

use ReflectionClass;

class AccessProtectedMethod
{
    public static function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
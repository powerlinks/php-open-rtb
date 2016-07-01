<?php
/**
 * GetConstants.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 03/09/15 - 10:24
 */

namespace PowerLinks\OpenRtb\Tools\Traits;

use ReflectionClass;

trait GetConstants
{
    use Cache;

    /**
     * @return array
     */
    public static function getAll()
    {
        $className = md5('const'.__CLASS__);
        if (self::cacheHas($className)) {
            return apcu_fetch($className);
        }

        $constants = self::getConstants();
        self::cacheStore($className, $constants);
        return $constants;
    }

    private static function getConstants()
    {
        $self = new ReflectionClass(__CLASS__);
        return $self->getConstants();
    }
}
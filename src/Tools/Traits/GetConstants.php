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
    /**
     * @return array
     */
    public static function getAll()
    {
        $self = new ReflectionClass(__CLASS__);
        return $self->getConstants();
    }
}
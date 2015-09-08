<?php
/**
 * LocationType.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 10:10
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class LocationType
{
    use GetConstants;

    const GPS = 1;
    const IP_ADDRESS = 2;
    const USER_PROVIDED = 3;
}
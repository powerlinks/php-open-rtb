<?php
/**
 * DeviceType.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 10:40
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class DeviceType
{
    use GetConstants;

    const MOBILE_TABLET = 1;
    const PERSONAL_COMPUTER = 2;
    const CONNECTED_TV = 3;
    const PHONE = 4;
    const TABLET = 5;
    const CONNECTED_DEVICE = 6;
    const SET_TOP_BOX = 7;
}
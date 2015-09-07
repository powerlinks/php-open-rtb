<?php
/**
 * ConnectionType.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 11:08
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\BidRequest\Specification\CommonMethods\GetConstants;

class ConnectionType
{
    use GetConstants;

    const UNKNOWN = 0;
    const ETHERNET = 1;
    const WIFI = 2;
    const CELLULAR_NETWORK_UNKNOWN = 3;
    const CELLULAR_NETWORK_2G = 4;
    const CELLULAR_NETWORK_3G = 5;
    const CELLULAR_NETWORK_4G = 6;
}
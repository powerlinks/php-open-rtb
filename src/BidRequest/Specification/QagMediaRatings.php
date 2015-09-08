<?php
/**
 * QagMediaRatings.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 16:50
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class QagMediaRatings
{
    use GetConstants;

    const ALL_AUDIENCES = 1;
    const EVERYONE_OVER_12 = 2;
    const MATURE_AUDIENCES = 3;
}
<?php
/**
 * VastCompanionTypes.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/09/15 - 09:10
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class VastCompanionTypes
{
    use GetConstants;

    const STATIC_RESOURCE = 1;
    const HTML_RESOURCE = 2;
    const IFRAME_RESOURCE = 3;
}
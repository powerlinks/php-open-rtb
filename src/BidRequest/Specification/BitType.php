<?php
/**
 * BitType.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 03/09/15 - 11:52
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\BidRequest\Specification\CommonMethods\GetConstants;

class BitType
{
    use GetConstants;

    const NO = 0;
    const YES = 1;
}
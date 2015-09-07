<?php
/**
 * ContentDeliveryMethods.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/09/15 - 09:44
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\BidRequest\Specification\CommonMethods\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.13
 * Class ContentDeliveryMethods
 * @package PowerLinks\OpenRtb\BidRequest\Specification
 */
class ContentDeliveryMethods
{
    use GetConstants;

    const STREAMING = 1;
    const PROGRESSIVE = 2;
}
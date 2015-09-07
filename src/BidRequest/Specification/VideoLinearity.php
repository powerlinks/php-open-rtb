<?php
/**
 * VideoLinearity.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/09/15 - 09:29
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\BidRequest\Specification\CommonMethods\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.7
 * Class VideoLinearity
 * @package PowerLinks\OpenRtb\BidRequest\Specification
 */
class VideoLinearity
{
    use GetConstants;

    const LINEAR_IN_STREAM = 1;
    const NON_LINEAR_OVERLAY = 2;
}
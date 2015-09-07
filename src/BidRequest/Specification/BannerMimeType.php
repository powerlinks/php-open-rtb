<?php
/**
 * BannerMimeType.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 03/09/15 - 17:59
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\BidRequest\Specification\CommonMethods\GetConstants;

class BannerMimeType
{
    use GetConstants;

    const MIME_FLASH = 'application/x-shockwave-flash';
    const MIME_JPEG = 'image/jpg';
    const MIME_GIF = 'image/gif';
}
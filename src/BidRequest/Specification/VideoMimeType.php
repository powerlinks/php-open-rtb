<?php
/**
 * VideoMimeType.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 04/09/15 - 17:55
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;


use PowerLinks\OpenRtb\BidRequest\Specification\CommonMethods\GetConstants;

class VideoMimeType
{
    use GetConstants;

    const MIME_MS_WMV = 'video/x-ms-wmv';
    const MIME_FLV = 'video/x-flv';
}
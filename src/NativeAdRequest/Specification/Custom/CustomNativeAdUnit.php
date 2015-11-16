<?php
/**
 * CustomNativeAdUnit.php
 * 
 * @copyright PowerLinks
 * @author David Chippington <david@powerlinks.com>
 * Date: 28/10/15 - 12:00
 */

namespace PowerLinks\OpenRtb\NativeAdRequest\Specification\Custom;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class CustomNativeAdUnit
{
    use GetConstants;

    //500+ Reserved for Exchange specific formats.
    const IN_FEED = 501;
    const END_OF_POST = 502;
    const IN_ARTICLE = 503;
    const IN_IMAGE = 504;
    const IN_VIDEO = 505;
    const IN_TEXT = 506;
}

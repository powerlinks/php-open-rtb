<?php
/**
 * ImageAssetType.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 10:19
 */

namespace PowerLinks\OpenRtb\NativeAdRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class ImageAssetType
{
    use GetConstants;

    const ICON = 1;
    const LOGO = 2;
    const MAIN = 3;
    // 500+ XXX Reserved for Exchange specific usage numbered above 500
}
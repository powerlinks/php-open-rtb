<?php
/**
 * DataAssetType.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 11:15
 */

namespace PowerLinks\OpenRtb\NativeAdRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class DataAssetType
{
    use GetConstants;

    const SPONSORED = 1;
    const DESC = 2;
    const RATING = 3;
    const LIKES = 4;
    const DOWNLOADS = 5;
    const PRICE = 6;
    const SALE_PRICE = 7;
    const PHONE = 8;
    const ADDRESS = 9;
    const DESC2 = 10;
    const DISPLAY_URL = 11;
    const CTATEXT = 12;
    //500+ XXX Reserved for Exchange specific usage numbered above 500
}
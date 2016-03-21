<?php
/**
 * NativeAdUnit.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 08/09/15 - 10:39
 */

namespace PowerLinks\OpenRtb\NativeAdRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class NativeAdUnit
{
    use GetConstants;

    const PAID_SEARCH_UNITS = 1;
    const RECOMMENDATION_WIDGETS = 2;
    const PROMOTED_LISTINGS = 3;
    const IN_AD_WITH_NATIVE_ELEMENT_UNITS = 4;
    const CUSTOM_CANT_BE_CONTAINED = 5;

    //500+ Reserved for Exchange specific formats.
    const UNSPECIFIED = 500;
    const IN_FEED = 501;
    const END_OF_POST = 502;
    const IN_ARTICLE = 503;
    const IN_IMAGE = 504;
    const IN_VIDEO = 505;
    const IN_TEXT = 506;
}
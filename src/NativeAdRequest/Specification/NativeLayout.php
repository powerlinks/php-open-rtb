<?php
/**
 * NativeLayout.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 08/09/15 - 10:39
 */

namespace PowerLinks\OpenRtb\NativeAdRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class NativeLayout
{
    use GetConstants;

    const CONTENT_WALL = 1;
    const APP_WALL = 2;
    const NEWS_FEED = 3;
    const CHAT_LIST = 4;
    const CAROUSEL = 5;
    const CONTENT_STREAM = 6;
    const GRID_ADJOINING_THE_CONTENT = 7;

    //500+ Reserved for Exchange specific layouts.
    const UNSPECIFIED = 500;
}
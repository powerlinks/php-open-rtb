<?php
/**
 * AdPosition.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/09/15 - 09:16
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;


use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class AdPosition
{
    use GetConstants;

    const UNKNOWN = 0;
    const ABOVE_THE_FOLD = 1;
    const DEPRECATED = 2; // May or may not be initially visible depending on screen size/resolution.
    const BELOW_THE_FOLD = 3;
    const HEADER = 4;
    const FOOTER = 5;
    const SIDEBAR = 6;
    const FULL_SCREEN = 7;
}
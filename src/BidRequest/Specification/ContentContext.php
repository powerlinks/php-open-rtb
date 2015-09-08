<?php
/**
 * ContentContext.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 16:35
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class ContentContext
{
    use GetConstants;

    const VIDEO = 1;
    const GAME = 2;
    const MUSIC = 3;
    const APPLICATION = 4;
    const TEXT = 5;
    const OTHER = 6;
    const UNKNOWN = 7;
}
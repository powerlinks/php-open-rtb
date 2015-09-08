<?php
/**
 * VideoPlaybackMethods.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/09/15 - 09:41
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.9
 * Class VideoPlaybackMethods
 * @package PowerLinks\OpenRtb\BidRequest\Specification
 */
class VideoPlaybackMethods
{
    use GetConstants;

    const AUTO_PLAY_SOUND_ON = 1;
    const AUTO_PLAY_SOUND_OFF = 2;
    const CLICK_TO_PLAY = 3;
    const MOUSE_OVER = 4;
}
<?php
/**
 * CreativeAttributes.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 04/09/15 - 10:26
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;

use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

/**
 * http://www.iab.net/media/file/OpenRTB-API-Specification-Version-2-3.pdf - 5.3
 * Class CreativeAttributes
 * @package PowerLinks\OpenRtb\BidRequest\Specification
 */
class CreativeAttributes
{
    use GetConstants;

    const AUDIO_AD_AUTO_PLAY = 1;
    const AUDIO_AD_USER_INITIATED = 2;
    const EXPANDABLE_AUTOMATIC = 3;
    const EXPANDABLE_USER_INITIATED_CLICK = 4;
    const EXPANDABLE_USER_INITIATED_ROLLOVER = 5;
    const IN_BANNER_VIDEO_AD_AUTO_PLAY = 6;
    const IN_BANNER_VIDEO_AD_USER_INITIATED = 7;
    const POP = 8;
    const PROVOCATIVE_OR_SUGGESTIVE_IMAGERY = 9;
    const SHAKY_FLASHING_FLICKERING_EXTREME_ANIMATION_SMILEYS = 10;
    const SURVEYS = 11;
    const TEXT_ONLY = 12;
    const USER_INTERACTIVE = 13;
    const WINDOWS_DIALOG_OR_ALERT_STYLE = 14;
    const HAS_AUDIO_ON_OFF_BUTTON = 15;
    const AD_CAN_BE_SKIPPED = 16;
}
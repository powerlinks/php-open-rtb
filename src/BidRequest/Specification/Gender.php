<?php
/**
 * Gender.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 03/09/15 - 16:32
 */

namespace PowerLinks\OpenRtb\BidRequest\Specification;


use PowerLinks\OpenRtb\BidRequest\Specification\CommonMethods\GetConstants;

class Gender
{
    use GetConstants;

    const MALE = 'M';
    const FEMALE = 'F';
    const KNOWN_TO_BE_OTHER = 'O';
    const UNKNOWN = null;
}
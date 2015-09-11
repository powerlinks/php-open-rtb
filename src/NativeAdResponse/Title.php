<?php
/**
 * Title.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 11/09/15 - 16:52
 */

namespace PowerLinks\OpenRtb\NativeAdResponse;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Title implements Arrayable
{
    use SetterValidation;
    use ToArray;

    protected $text required String - The text associated with the text
element.
    protected $ext
}
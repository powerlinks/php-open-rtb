<?php
/**
 * Image.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 11/09/15 - 16:52
 */

namespace PowerLinks\OpenRtb\NativeAdResponse;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Image implements Arrayable
{
    use SetterValidation;
    use ToArray;

    protected $url required string - URL of the image asset.
    protected $w recommended integer - Width of the image in pixels.
    protected $h recommended integer Height of the image in pixels.
    protected $ext
}
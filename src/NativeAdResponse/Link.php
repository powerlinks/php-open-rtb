<?php
/**
 * Link.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 11/09/15 - 14:31
 */

namespace PowerLinks\OpenRtb\NativeAdResponse;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Link implements Arrayable
{
    use SetterValidation;
    use ToArray;

    protected $url required string - Landing URL of the clickable link.
    protected $clicktrackers[] optional array of
strings
- List of third-party tracker URLs to
be fired on click of the URL.
    protected $fallback optional string
(URL)
- Fallback URL for deeplink. To be
used if the URL given in url is not
supported by the device.
    protected $ext
}
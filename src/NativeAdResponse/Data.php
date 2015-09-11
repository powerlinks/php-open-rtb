<?php
/**
 * Data.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 11/09/15 - 16:52
 */

namespace PowerLinks\OpenRtb\NativeAdResponse;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Data implements Arrayable
{
    use SetterValidation;
    use ToArray;

    protected $label optional string - The optional formatted string
name of the data type to be
displayed.
    protected $value required string - The formatted string of data to
be displayed. Can contain a
formatted value such as “5 stars”
or “$10” or “3.4 stars out of 5”.
    protected $ext
}
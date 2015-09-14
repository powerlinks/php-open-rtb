<?php
/**
 * NativeAdResponse.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 11/09/15 - 13:29
 */

namespace PowerLinks\OpenRtb\NativeAdResponse;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class NativeAdResponse implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @required
     * @var Native
     */
    protected $native;

    /**
     * @return Native
     */
    public function getNative()
    {
        return $this->native;
    }

    /**
     * @param Native $native
     * @return $this
     */
    public function setNative(Native $native)
    {
        $this->native = $native;
        return $this;
    }
}
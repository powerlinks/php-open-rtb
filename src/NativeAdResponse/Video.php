<?php
/**
 * Video.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 11/09/15 - 16:51
 */

namespace PowerLinks\OpenRtb\NativeAdResponse;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Video implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * VAST xml
     * @required
     * @var string
     */
    protected $vasttag;

    /**
     * @return string
     */
    public function getVasttag()
    {
        return $this->vasttag;
    }

    /**
     * @param string $vasttag
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setVasttag($vasttag)
    {
        $this->validateString($vasttag, __LINE__);
        $this->vasttag = $vasttag;
        return $this;
    }
}
<?php
/**
 * NativeAdRequest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 08/09/15 - 10:06
 */

namespace PowerLinks\OpenRtb\NativeAdRequest;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class NativeAdRequest implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @default 1
     * @var string
     */
    protected $ver;

    /**
     * Valid values in NativeLayout
     * @recommended
     * @var int
     */
    protected $layout;

    /**
     * @recommended
     * @var
     */
    protected $adunit;

    /**
     * @default 1
     * @var int
     */
    protected $plcmtcnt;

    /**
     * @default 0
     * @var int
     */
    protected $seq;

    /**
     * Array of Asset
     * @required
     * @var ArrayCollection
     */
    protected $assets;

    /**
     * @var
     */
    protected $ext;


}
<?php
/**
 * NativeAdRequest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 08/09/15 - 10:06
 */

namespace PowerLinks\OpenRtb\NativeAdRequest;

use PowerLinks\OpenRtb\NativeAdRequest\Specification\NativeAdUnit;
use PowerLinks\OpenRtb\Tools\Classes\ArrayCollection;
use PowerLinks\OpenRtb\NativeAdRequest\Specification\NativeLayout;
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
     * @var int
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

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->setAssets(new ArrayCollection());
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return json_encode(['native' => $this->toArray()]);
    }

    /**
     * @return string
     */
    public function getVer()
    {
        return $this->ver;
    }

    /**
     * @param string $ver
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setVer($ver)
    {
        $this->ver = $this->validateVersion($ver, __LINE__);
        return $this;
    }

    /**
     * @return int
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param int $layout
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLayout($layout)
    {
        $this->validateIn($layout, NativeLayout::getAll(), __LINE__);
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdunit()
    {
        return $this->adunit;
    }

    /**
     * @param int $adunit
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAdunit($adunit)
    {
        $this->validateIn($adunit, NativeAdUnit::getAll(), __LINE__);
        $this->adunit = $adunit;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlcmtcnt()
    {
        return $this->plcmtcnt;
    }

    /**
     * @param int $plcmtcnt
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPlcmtcnt($plcmtcnt)
    {
        $this->plcmtcnt = $this->validateInt($plcmtcnt, __LINE__);
        return $this;
    }

    /**
     * @return int
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * @param int $seq
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSeq($seq)
    {
        $this->seq = $this->validateInt($seq, __LINE__);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @param Assets $assets
     * @return $this
     */
    public function addAssets(Assets $assets)
    {
        $this->assets->add($assets);
        return $this;
    }

    /**
     * @param ArrayCollection $assets
     * @return $this
     */
    public function setAssets(ArrayCollection $assets)
    {
        $this->assets = $assets;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param $ext
     * @return $this
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }
}
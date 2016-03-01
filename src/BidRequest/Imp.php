<?php
/**
 * Imp.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 28/08/15 - 14:32
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Specification\BitType;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Imp implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @required
     * @var string
     */
    protected $id;

    /**
     * @var Banner
     */
    protected $banner;

    /**
     * @var Video
     */
    protected $video;

    /**
     * @var Native
     */
    protected $native;

    /**
     * @var string
     */
    protected $displaymanager;

    /**
     * @var string
     */
    protected $displaymanagerver;

    /**
     * 1 = the ad is interstitial or full screen, 0 = not interstitial
     * @default 0
     * @var int
     */
    protected $instl;

    /**
     * @var string
     */
    protected $tagid;

    /**
     * @default 0
     * @var float
     */
    protected $bidfloor;

    /**
     * @default USD
     * @var string
     */
    protected $bidfloorcur;

    /**
     *  where 0 = non-secure, 1 = secure. If omitted the secure state is unknown
     * @var int
     */
    protected $secure;

    /**
     * Array of strings
     * @var array
     */
    protected $iframebuster;

    /**
     * @var Pmp
     */
    protected $pmp;

    /**
     * @var Ext
     */
    protected $ext;

    public function __construct()
    {
        $this->initialize();
    }

    public function initialize()
    {
        $this->setPmp(new Pmp());
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setId($id)
    {
        $this->validateString($id, __LINE__);
        $this->id = $id;
        return $this;
    }

    /**
     * @return Banner
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param Banner $banner
     * @return $this
     */
    public function setBanner(Banner $banner)
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return $this
     */
    public function setVideo(Video $video)
    {
        $this->video = $video;
        return $this;
    }

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

    /**
     * @return string
     */
    public function getDisplaymanager()
    {
        return $this->displaymanager;
    }

    /**
     * @param string $displaymanager
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setDisplaymanager($displaymanager)
    {
        $this->validateString($displaymanager, __LINE__);
        $this->displaymanager = $displaymanager;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplaymanagerver()
    {
        return $this->displaymanagerver;
    }

    /**
     * @param string $displaymanagerver
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setDisplaymanagerver($displaymanagerver)
    {
        $this->validateString($displaymanagerver, __LINE__);
        $this->displaymanagerver = $displaymanagerver;
        return $this;
    }

    /**
     * @return int
     */
    public function getInstl()
    {
        return $this->instl;
    }

    /**
     * @param int $instl
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setInstl($instl)
    {
        $this->validateIn($instl, BitType::getAll(), __LINE__);
        $this->instl = $instl;
        return $this;
    }

    /**
     * @return string
     */
    public function getTagid()
    {
        return $this->tagid;
    }

    /**
     * @param string $tagid
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTagid($tagid)
    {
        $this->validateString($tagid, __LINE__);
        $this->tagid = $tagid;
        return $this;
    }

    /**
     * @return float
     */
    public function getBidfloor()
    {
        return $this->bidfloor;
    }

    /**
     * @param float $bidfloor
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBidfloor($bidfloor)
    {
        $this->validateNumericToFloat($bidfloor, __LINE__);
        $this->bidfloor = $bidfloor;
        return $this;
    }

    /**
     * @return string
     */
    public function getBidfloorcur()
    {
        return $this->bidfloorcur;
    }

    /**
     * @param string $bidfloorcur
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBidfloorcur($bidfloorcur)
    {
        $this->validateString($bidfloorcur, __LINE__);
        $this->bidfloorcur = $bidfloorcur;
        return $this;
    }

    /**
     * @return int
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param int $secure
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSecure($secure)
    {
        $this->validateIn($secure, BitType::getAll(), __LINE__);
        $this->secure = $secure;
        return $this;
    }

    /**
     * @return array
     */
    public function getIframebuster()
    {
        return $this->iframebuster;
    }

    /**
     * @param string $iframebuster
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addIframebuster($iframebuster)
    {
        $this->validateString($iframebuster, __LINE__);
        $this->iframebuster[] = $iframebuster;
        return $this;
    }

    /**
     * @param array $iframebuster
     * @return $this
     */
    public function setIframebuster(array $iframebuster)
    {
        $this->iframebuster = $iframebuster;
        return $this;
    }

    /**
     * @return Pmp
     */
    public function getPmp()
    {
        return $this->pmp;
    }

    /**
     * @param Pmp $pmp
     * @return $this
     */
    public function setPmp(Pmp $pmp)
    {
        $this->pmp = $pmp;
        return $this;
    }

    /**
     * @return Ext
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param Ext $ext
     * @return $this
     */
    public function setExt(Ext $ext)
    {
        $this->ext = $ext;
        return $this;
    }
}
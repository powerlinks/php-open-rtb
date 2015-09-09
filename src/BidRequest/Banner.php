<?php
/**
 * Banner.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 28/08/15 - 14:39
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Specification\BannerMimeType;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Banner implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @recommended
     * @var int
     */
    protected $w;

    /**
     * @recommended
     * @var int
     */
    protected $h;

    /**
     * @var int
     */
    protected $wmax;

    /**
     * @var int
     */
    protected $hmax;

    /**
     * @var int
     */
    protected $wmin;

    /**
     * @var int
     */
    protected $hmin;

    /**
     * @var string
     */
    protected $id;

    /**
     * Array of Integers
     * @var array
     */
    protected $btype;

    /**
     * Array of Integers
     * @var array
     */
    protected $battr;

    /**
     * @var int
     */
    protected $pos;

    /**
     * Array of Strings
     * Values allow: 'application/x-shockwave-flash', 'image/jpg', 'image/gif'
     * @var array
     */
    protected $mimes;

    /**
     * Values allow: 0 = no, 1 = yes
     * @var int
     */
    protected $topframe;

    /**
     * Array of integers
     * @var array
     */
    protected $expdir;

    /**
     * Array of integers
     * @var array
     */
    protected $api;

    /**
     * @var Ext
     */
    protected $ext;

    /**
     * @return int
     */
    public function getW()
    {
        return $this->w;
    }

    /**
     * @param int $w
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setW($w)
    {
        $this->validatePositiveInt($w, __LINE__);
        $this->w = $w;
        return $this;
    }

    /**
     * @return int
     */
    public function getH()
    {
        return $this->h;
    }

    /**
     * @param int $h
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setH($h)
    {
        $this->validatePositiveInt($h, __LINE__);
        $this->h = $h;
        return $this;
    }

    /**
     * @return int
     */
    public function getWmax()
    {
        return $this->wmax;
    }

    /**
     * @param int $wmax
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setWmax($wmax)
    {
        $this->validatePositiveInt($wmax, __LINE__);
        $this->wmax = $wmax;
        return $this;
    }

    /**
     * @return int
     */
    public function getHmax()
    {
        return $this->hmax;
    }

    /**
     * @param int $hmax
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setHmax($hmax)
    {
        $this->validatePositiveInt($hmax, __LINE__);
        $this->hmax = $hmax;
        return $this;
    }

    /**
     * @return int
     */
    public function getWmin()
    {
        return $this->wmin;
    }

    /**
     * @param int $wmin
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setWmin($wmin)
    {
        $this->validatePositiveInt($wmin, __LINE__);
        $this->wmin = $wmin;
        return $this;
    }

    /**
     * @return int
     */
    public function getHmin()
    {
        return $this->hmin;
    }

    /**
     * @param int $hmin
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setHmin($hmin)
    {
        $this->validatePositiveInt($hmin, __LINE__);
        $this->hmin = $hmin;
        return $this;
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
     * @return array
     */
    public function getBtype()
    {
        return $this->btype;
    }

    /**
     * @param int $btype
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBtype($btype)
    {
        $this->validateInt($btype, __LINE__);
        $this->btype[] = $btype;
        return $this;
    }

    /**
     * @param array $btype
     * @return $this
     */
    public function setBtype(array $btype)
    {
        $this->btype = $btype;
        return $this;
    }

    /**
     * @return array
     */
    public function getBattr()
    {
        return $this->battr;
    }

    /**
     * @param int $battr
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addBattr($battr)
    {
        $this->validateInt($battr, __LINE__);
        $this->battr[] = $battr;
        return $this;
    }

    /**
     * @param array $battr
     * @return $this
     */
    public function setBattr(array $battr)
    {
        $this->battr = $battr;
        return $this;
    }

    /**
     * @return int
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * @param int $pos
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPos($pos)
    {
        $this->validateInt($pos, __LINE__);
        $this->pos = $pos;
        return $this;
    }

    /**
     * @return array
     */
    public function getMimes()
    {
        return $this->mimes;
    }

    /**
     * @param string $mimes
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addMimes($mimes)
    {
        $this->validateIn($mimes, BannerMimeType::getAll(), __LINE__);
        $this->mimes[] = $mimes;
        return $this;
    }

    /**
     * @param array $mimes
     * @return $this
     */
    public function setMimes(array $mimes)
    {
        $this->mimes = $mimes;
        return $this;
    }

    /**
     * @return int
     */
    public function getTopframe()
    {
        return $this->topframe;
    }

    /**
     * @param int $topframe
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setTopframe($topframe)
    {
        $this->validateInt($topframe, __LINE__);
        $this->topframe = $topframe;
        return $this;
    }

    /**
     * @return array
     */
    public function getExpdir()
    {
        return $this->expdir;
    }

    /**
     * @param int $expdir
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addExpdir($expdir)
    {
        $this->validateInt($expdir, __LINE__);
        $this->expdir[] = $expdir;
        return $this;
    }

    /**
     * @param array $expdir
     * @return $this
     */
    public function setExpdir(array $expdir)
    {
        $this->expdir = $expdir;
        return $this;
    }

    /**
     * @return array
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param int $api
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addApi($api)
    {
        $this->validateInt($api, __LINE__);
        $this->api[] = $api;
        return $this;
    }

    /**
     * @param array $api
     * @return $this
     */
    public function setApi(array $api)
    {
        $this->api = $api;
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
<?php
/**
 * Bid.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 11/09/15 - 10:07
 */

namespace PowerLinks\OpenRtb\BidResponse;

use PowerLinks\OpenRtb\BidRequest\Specification\CreativeAttributes;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Bid implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Bidder generated bid ID to assist with logging/tracking
     * @required
     * @var string
     */
    protected $id;

    /**
     * required ID of the Imp object in the related bid request
     * @required
     * @var string
     */
    protected $impid;

    /**
     * Bid price expressed as CPM although the actual transaction is for a unit impression only
     * @required
     * @var float
     */
    protected $price;

    /**
     * ID of a preloaded ad to be served if the bid wins
     * @var string
     */
    protected $adid;

    /**
     * Win notice URL called by the exchange if the bid wins; optional means of serving ad markup
     * @var string
     */
    protected $nurl;

    /**
     * @var string
     */
    protected $adm;

    /**
     * Advertiser domain for block list checking (e.g., “ford.com”)
     * Array of strings
     * @var array
     */
    protected $adomain;

    /**
     * intended to be a unique ID across exchanges
     * @var string
     */
    protected $bundle;

    /**
     * URL without cache-busting to an image that is representative of the content of the campaign for ad quality/safety checking
     * @var string
     */
    protected $iurl;

    /**
     * Campaign ID to assist with ad quality checking; the collection of creatives for which iurl should be representative
     * @var string
     */
    protected $cid;

    /**
     * Creative ID to assist with ad quality checking
     * @var string
     */
    protected $crid;

    /**
     * IAB content categories of the creative
     * Array of strings
     * @var array
     */
    protected $cat;

    /**
     * Set of attributes describing the creative (CreativeAttributes)
     * Array of integers
     * @var array
     */
    protected $attr;

    /**
     * Reference to the deal.id from the bid request if this bid pertains to a private marketplace direct deal
     * @var string
     */
    protected $dealid;

    /**
     * Height of the creative in pixels
     * @var int
     */
    protected $h;

    /**
     * Width of the creative in pixels
     * @var int
     */
    protected $w;

    /**
     * @var Ext
     */
    protected $ext;

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
        $this->validateString($id);
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getImpid()
    {
        return $this->impid;
    }

    /**
     * @param string $impid
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setImpid($impid)
    {
        $this->validateString($impid);
        $this->impid = $impid;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPrice($price)
    {
        $this->price = $this->validateNumericToFloat($price);
        return $this;
    }

    /**
     * @return string
     */
    public function getAdid()
    {
        return $this->adid;
    }

    /**
     * @param string $adid
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAdid($adid)
    {
        $this->validateString($adid);
        $this->adid = $adid;
        return $this;
    }

    /**
     * @return string
     */
    public function getNurl()
    {
        return $this->nurl;
    }

    /**
     * @param string $nurl
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setNurl($nurl)
    {
        $this->validateString($nurl);
        $this->nurl = $nurl;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdm()
    {
        return $this->adm;
    }

    /**
     * @param string $adm
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setAdm($adm)
    {
        $this->validateString($adm);
        $this->adm = $adm;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdomain()
    {
        return $this->adomain;
    }

    /**
     * @param string $adomain
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addAdomain($adomain)
    {
        $this->validateString($adomain);
        $this->adomain[] = $adomain;
        return $this;
    }

    /**
     * @param array $adomain
     * @return $this
     */
    public function setAdomain(array $adomain)
    {
        $this->adomain = $adomain;
        return $this;
    }

    /**
     * @return string
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    /**
     * @param string $bundle
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBundle($bundle)
    {
        $this->validateString($bundle);
        $this->bundle = $bundle;
        return $this;
    }

    /**
     * @return string
     */
    public function getIurl()
    {
        return $this->iurl;
    }

    /**
     * @param string $iurl
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setIurl($iurl)
    {
        $this->validateString($iurl);
        $this->iurl = $iurl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @param string $cid
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCid($cid)
    {
        $this->validateString($cid);
        $this->cid = $cid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCrid()
    {
        return $this->crid;
    }

    /**
     * @param string $crid
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCrid($crid)
    {
        $this->validateString($crid);
        $this->crid = $crid;
        return $this;
    }

    /**
     * @return array
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param string $cat
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addCat($cat)
    {
        $this->validateString($cat);
        $this->cat = $cat;
        return $this;
    }

    /**
     * @param array $cat
     * @return $this
     */
    public function setCat(array $cat)
    {
        $this->cat = $cat;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttr()
    {
        return $this->attr;
    }

    /**
     * @param int $attr
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function addAttr($attr)
    {
        $this->validateIn($attr, CreativeAttributes::getAll());
        $this->attr = $attr;
        return $this;
    }

    /**
     * @param array $attr
     * @return $this
     */
    public function setAttr(array $attr)
    {
        $this->attr = $attr;
        return $this;
    }

    /**
     * @return string
     */
    public function getDealid()
    {
        return $this->dealid;
    }

    /**
     * @param string $dealid
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setDealid($dealid)
    {
        $this->validateString($dealid);
        $this->dealid = $dealid;
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
        $this->h = $this->validateInt($h);
        return $this;
    }

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
        $this->w = $this->validateInt($w);
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
     * @param $ext
     * @return $this
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
        return $this;
    }
}
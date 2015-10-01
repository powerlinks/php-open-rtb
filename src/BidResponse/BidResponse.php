<?php
/**
 * BidResponse.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 28/08/15 - 13:34
 */

namespace PowerLinks\OpenRtb\BidResponse;

use PowerLinks\OpenRtb\BidResponse\Specification\NoBidReason;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;
use PowerLinks\OpenRtb\Tools\Classes\ArrayCollection;

class BidResponse implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * ID of the bid request to which this is a response
     * @required
     * @var string
     */
    protected $id;

    /**
     * Array of Seatbid objects
     * @var ArrayCollection
     */
    protected $seatbid;

    /**
     * Bidder generated response ID to assist with logging/tracking
     * @var string
     */
    protected $bidid;

    /**
     * Bid currency using ISO-4217 alpha codes
     * @default USD
     * @var string
     */
    protected $cur;

    /**
     * Proper JSON encoding must be used to include “escaped” quotation marks
     * @var string
     */
    protected $customdata;

    /**
     * Reason for not bidding (NoBidReason)
     * @var int
     */
    protected $nbr;

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
        $this->setSeatbid(new ArrayCollection());
    }

    /**
     * @return string
     */
    public function getBidResponse()
    {
        return json_encode($this->toArray());
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
     * @return ArrayCollection
     */
    public function getSeatbid()
    {
        return $this->seatbid;
    }

    /**
     * @param Seatbid $seatbid
     * @return $this
     */
    public function addSeatbid(Seatbid $seatbid)
    {
        $this->seatbid->add($seatbid);
        return $this;
    }

    /**
     * @param ArrayCollection $seatbid
     * @return $this
     */
    public function setSeatbid(ArrayCollection $seatbid)
    {
        $this->seatbid = $seatbid;
        return $this;
    }

    /**
     * @return string
     */
    public function getBidid()
    {
        return $this->bidid;
    }

    /**
     * @param string $bidid
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBidid($bidid)
    {
        $this->validateString($bidid, __LINE__);
        $this->bidid = $bidid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCur()
    {
        return $this->cur;
    }

    /**
     * @param string $cur
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCur($cur)
    {
        $this->validateString($cur, __LINE__);
        $this->cur = $cur;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomdata()
    {
        return $this->customdata;
    }

    /**
     * @param string $customdata
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCustomdata($customdata)
    {
        $this->validateString($customdata, __LINE__);
        $this->customdata = $customdata;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbr()
    {
        return $this->nbr;
    }

    /**
     * @param int $nbr
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setNbr($nbr)
    {
        $this->validateIn($nbr, NoBidReason::getAll(), __LINE__);
        $this->nbr = $nbr;
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
<?php
/**
 * Seatbid.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 10/09/15 - 17:00
 */

namespace PowerLinks\OpenRtb\BidResponse;

use PowerLinks\OpenRtb\BidResponse\Specification\BitType;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;
use PowerLinks\OpenRtb\Tools\Classes\ArrayCollection;

class Seatbid implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Array of Bid objects
     * @required
     * @var ArrayCollection
     */
    protected $bid;

    /**
     * ID of the bidder seat on whose behalf this bid is made
     * @var string
     */
    protected $seat;

    /**
     * 0 = impressions can be won individually; 1 = impressions must be won or lost as a group
     * @default 0
     * @var int
     */
    protected $group;

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
        $this->setBid(new ArrayCollection());
    }

    /**
     * @return ArrayCollection
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * @param Bid $bid
     * @return $this
     */
    public function addBid(Bid $bid)
    {
        $this->bid->add($bid);
        return $this;
    }

    /**
     * @param ArrayCollection $bid
     * @return $this
     */
    public function setBid(ArrayCollection $bid)
    {
        $this->bid = $bid;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setSeat($seat)
    {
        $this->validateString($seat, __LINE__);
        $this->seat = $seat;
        return $this;
    }

    /**
     * @return int
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param int $group
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setGroup($group)
    {
        $this->validateIn($group, BitType::getAll(), __LINE__);
        $this->group = $group;
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
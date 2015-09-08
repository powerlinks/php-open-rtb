<?php
/**
 * Pmp.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 09:29
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Specification\BitType;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;
use PowerLinks\OpenRtb\Collection\ArrayCollection;

class Pmp implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * where: 0 = all bids are accepted, 1 = bids are restricted to the deals specified and the terms thereof
     * @var int
     */
    protected $private_auction;

    /**
     * Array of Deal
     * @var ArrayCollection
     */
    protected $deals;

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
        $this->setDeals(new ArrayCollection());
    }

    /**
     * @return int
     */
    public function getPrivateAuction()
    {
        return $this->private_auction;
    }

    /**
     * @param int $private_auction
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setPrivateAuction($private_auction)
    {
        $this->validateIn($private_auction, BitType::getAll(), __LINE__);
        $this->private_auction = $private_auction;
        return $this;
    }

    /**
     * @return array
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * @param Deal $deals
     * @return $this
     */
    public function addDeals(Deal $deals)
    {
        $this->deals->add($deals);
        return $this;
    }

    /**
     * @param ArrayCollection $deals
     * @return $this
     */
    public function setDeals(ArrayCollection $deals)
    {
        $this->deals = $deals;
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
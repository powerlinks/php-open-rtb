<?php
/**
 * User.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 09:51
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Specification\Gender;
use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;
use PowerLinks\OpenRtb\Tools\Classes\ArrayCollection;

class User implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @recommended
     * @var string
     */
    protected $id;

    /**
     * @recommended
     * @var string
     */
    protected $buyeruid;

    /**
     * Year of birth
     * @var int
     */
    protected $yob;

    /**
     * where “M” = male, “F” = female, “O” = known to be other (i.e., omitted is unknown)
     * @var string
     */
    protected $gender;

    /**
     * Comma separated list of keywords, interests, or intent
     * @var string
     */
    protected $keywords;

    /**
     * Proper JSON encoding must be used to include “escaped” quotation marks.
     * @var string
     */
    protected $customdata;

    /**
     * @var Geo
     */
    protected $geo;

    /**
     * Additional user data - array of Data
     * @var ArrayCollection
     */
    protected $data;

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
        $this->setGeo(new Geo());
        $this->setData(new ArrayCollection());
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
        $this->validateString($id);
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuyeruid()
    {
        return $this->buyeruid;
    }

    /**
     * @param string $buyeruid
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setBuyeruid($buyeruid)
    {
        $this->validateString($buyeruid);
        $this->buyeruid = $buyeruid;
        return $this;
    }

    /**
     * @return int
     */
    public function getYob()
    {
        return $this->yob;
    }

    /**
     * @param int $yob
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setYob($yob)
    {
        $this->yob = $this->validatePositiveInt($yob);
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setGender($gender)
    {
        $this->validateIn($gender, Gender::getAll());
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setKeywords($keywords)
    {
        $this->validateString($keywords);
        $this->keywords = $keywords;
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
        $this->validateString($customdata);
        $this->customdata = $customdata;
        return $this;
    }

    /**
     * @return Geo
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @param Geo $geo
     * @return $this
     */
    public function setGeo(Geo $geo)
    {
        $this->geo = $geo;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param Data $data
     * @return $this
     */
    public function addData(Data $data = null)
    {
        if (is_null($data)) {
            $data = new Data();
        }
        $this->data->add($data);
        return $this;
    }

    /**
     * @param ArrayCollection $data
     * @return $this
     */
    public function setData(ArrayCollection $data)
    {
        $this->data = $data;
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
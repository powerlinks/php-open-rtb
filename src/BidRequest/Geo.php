<?php
/**
 * Geo.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 09:57
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Specification\LocationType;
use PowerLinks\OpenRtb\Tools\Traits\SetterValidation;
use PowerLinks\OpenRtb\Tools\Traits\ToArray;

class Geo implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * Latitude from -90.0 to +90.0, where negative is south
     * @var float
     */
    protected $lat;

    /**
     * Longitude from -180.0 to +180.0, where negative is west
     * @var float
     */
    protected $lon;

    /**
     * PowerLinks\OpenRtb\BidRequest\Specification\LocationType
     * @var int
     */
    protected $type;

    /**
     * Country code using ISO-3166-1-alpha-3
     * @var string
     */
    protected $country;

    /**
     * Region code using ISO-3166-2; 2-letter state code if USA
     * @var string
     */
    protected $region;

    /**
     * Region of a country using FIPS 10-4 notation
     * @var string
     */
    protected $regionfips104;

    /**
     * Google metro code
     * @var string
     */
    protected $metro;

    /**
     * City using United Nations Code for Trade & Transport Locations
     * @var string
     */
    protected $city;

    /**
     * Zip or postal code
     * @var string
     */
    protected $zip;

    /**
     * Local time as the number +/- of minutes from UTC
     * @var int
     */
    protected $utcoffset;

    /**
     * @var
     */
    protected $ext;

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lat
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLat($lat)
    {
        $this->validateFloat($lat, __LINE__);
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param float $lon
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setLon($lon)
    {
        $this->validateFloat($lon, __LINE__);
        $this->lon = $lon;
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setType($type)
    {
        $this->validateIn($type, LocationType::getAll(), __LINE__);
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCountry($country)
    {
        $this->validateString($country, __LINE__);
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setRegion($region)
    {
        $this->validateString($region, __LINE__);
        $this->region = $region;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegionfips104()
    {
        return $this->regionfips104;
    }

    /**
     * @param string $regionfips104
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setRegionfips104($regionfips104)
    {
        $this->validateString($regionfips104, __LINE__);
        $this->regionfips104 = $regionfips104;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetro()
    {
        return $this->metro;
    }

    /**
     * @param string $metro
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setMetro($metro)
    {
        $this->validateString($metro, __LINE__);
        $this->metro = $metro;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setCity($city)
    {
        $this->validateString($city, __LINE__);
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setZip($zip)
    {
        $this->validateString($zip, __LINE__);
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return int
     */
    public function getUtcoffset()
    {
        return $this->utcoffset;
    }

    /**
     * @param int $utcoffset
     * @return $this
     * @throws \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     */
    public function setUtcoffset($utcoffset)
    {
        $this->validateInt($utcoffset, __LINE__);
        $this->utcoffset = $utcoffset;
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
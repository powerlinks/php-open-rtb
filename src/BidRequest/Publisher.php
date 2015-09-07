<?php
/**
 * Publisher.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 15:38
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Validation\SetterValidation;
use PowerLinks\OpenRtb\BidRequest\Validation\ToArray;

class Publisher implements Arrayable
{
    use SetterValidation;
    use ToArray;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * Array of strings
     * @var array
     */
    protected $cat;

    /**
     * Highest level domain of the publisher (e.g., “publisher.com”)
     * @var string
     */
    protected $domain;

    /**
     * @var
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
     */
    public function setId($id)
    {
        $this->validateString($id, __LINE__);
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->validateString($name, __LINE__);
        $this->name = $name;
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
     */
    public function addCat($cat)
    {
        $this->validateString($cat, __LINE__);
        $this->cat[] = $cat;
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
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->validateString($domain, __LINE__);
        $this->domain = $domain;
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
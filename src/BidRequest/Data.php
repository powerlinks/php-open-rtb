<?php
/**
 * Data.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 09:48
 */

namespace PowerLinks\OpenRtb\BidRequest;

use PowerLinks\OpenRtb\BidRequest\Interfaces\Arrayable;
use PowerLinks\OpenRtb\BidRequest\Validation\SetterValidation;
use PowerLinks\OpenRtb\BidRequest\Validation\ToArray;
use PowerLinks\OpenRtb\Collection\ArrayCollection;

class Data implements Arrayable
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
     * Array of Segment
     * @var ArrayCollection
     */
    protected $segment;

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
        $this->setSegment(new ArrayCollection());
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
     * @throws Exception\ExceptionInvalidValue
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
     * @throws Exception\ExceptionInvalidValue
     */
    public function setName($name)
    {
        $this->validateString($name, __LINE__);
        $this->name = $name;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * @param Segment $segment
     * @return $this
     */
    public function addSegment(Segment $segment = null)
    {
        if (is_null($segment)) {
            $segment = new Segment();
        }
        $this->segment->add($segment);
        return $this;
    }

    /**
     * @param ArrayCollection $segment
     * @return $this
     */
    public function setSegment(ArrayCollection $segment)
    {
        $this->segment = $segment;
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
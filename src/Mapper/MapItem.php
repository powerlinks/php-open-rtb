<?php
/**
 * MapItem.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 21/09/15 - 14:33
 */

namespace PowerLinks\NonStandardExchange\Mapper;


class MapItem
{
    /**
     * @var string
     */
    protected $objectPath;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array
     */
    protected $tags = [
        'required' => false,
        'uuid' => false,
        'default' => null
    ];

    /**
     * @param $objectPath
     * @param $value
     * @param $tags
     */
    public function __construct($objectPath, $value, $tags = [])
    {
        $this->objectPath = $objectPath;
        $this->value = $value;
        $this->setTags($tags);
    }

    /**
     * @return mixed
     */
    public function getObjectPath()
    {
        return $this->objectPath;
    }

    /**
     * @param string $objectPath
     * @return $this
     */
    public function setObjectPath($objectPath)
    {
        $this->objectPath = $objectPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param $tags
     * @return $this
     */
    public function setTags(array $tags)
    {
        $this->tags = array_replace($this->tags, $tags);
        return $this;
    }

    public function setTag($tag, $value)
    {
        if ( ! in_array($tag, array_keys($this->tags))) {
            return false;
        }
        $this->tags[$tag] = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return (bool) $this->tags['required'];
    }

    /**
     * @return bool
     */
    public function isUuid()
    {
        return (bool) $this->tags['uuid'];
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->tags['default'];
    }

    /**
     * @return bool
     */
    public function isDefaultValueNull()
    {
        return is_null($this->tags['default']);
    }

}
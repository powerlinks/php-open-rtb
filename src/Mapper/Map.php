<?php
/**
 * Map.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 18/09/15 - 16:36
 */

namespace PowerLinks\NonStandardExchange\Mapper;

use Countable;
use IteratorAggregate;
use ArrayIterator;

class Map implements Countable, IteratorAggregate
{
    /**
     * @var array
     */
    protected $map = [];

    /**
     * @param MapItem $mapItem
     */
    public function add(MapItem $mapItem)
    {
        $this->map[$mapItem->getObjectPath()] = $mapItem;
    }

    /**
     * @return array
     */
    public function getObjectPaths()
    {
        return array_keys($this->map);
    }

    /**
     * @param string $objectPath
     * @return bool
     */
    public function containsObjectPath($objectPath)
    {
        return isset($this->map[$objectPath]) || array_key_exists($objectPath, $this->map);
    }

    /**
     * @param string $objectPath
     * @return MapItem/null
     */
    public function get($objectPath)
    {
        return isset($this->map[$objectPath]) ? $this->map[$objectPath] : null;
    }

    /**
     * @param string $objectPath
     * @return bool
     */
    public function removeObjectPath($objectPath)
    {
        if ( ! $this->containsObjectPath($objectPath)) {
            return false;
        }
        unset($this->map[$objectPath]);
        return true;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->map);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->map);
    }
}
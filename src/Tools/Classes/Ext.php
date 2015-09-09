<?php
/**
 * Ext.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 15:32
 */

namespace PowerLinks\OpenRtb\Tools\Classes;

use PowerLinks\OpenRtb\Tools\Interfaces\Arrayable;

abstract class Ext implements Arrayable
{
    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->parameters[$key];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->parameters;
    }
}
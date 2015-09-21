<?php
/**
 * Mapper.php
 *
 * @copyright PowerLinks
 * @author Ollie Finn <ollie@powerlinks.com>
 * Date: 17/09/2015 - 11:44
 */
namespace PowerLinks\OpenRtb\Mapper;

class Mapper
{
    /**
     * @param Map $map
     * @param object $object
     * @return array
     */
    public function mapTo(Map $map, $object)
    {
        $result = [];

        return $result;
    }

    /**
     * @param Map $map
     * @param object $object
     * @param array $source
     * @return object
     */
    public function mapFromArray(Map $map, $object, array $source)
    {
        return $object;
    }

    /**
     * @param Map $map
     * @param object $object
     * @return object
     */
    public function mapFromValues(Map $map, $object)
    {
        return $object;
    }
}
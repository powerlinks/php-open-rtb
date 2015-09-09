<?php
/**
 * Hydrator.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 11:52
 */

namespace PowerLinks\OpenRtb;

class Hydrator
{
    /**
     * @param array $data
     * @param $object
     * @return object
     */
    public static function hydrate(array $data, $object)
    {
        $object;
        foreach ($data as $key => $value) {

        }
        return $object;
    }

    /**
     * @return array
     */
    private function getProperties()
    {
        $result = [];
        $self = new ReflectionClass(__CLASS__);
        $properties = $self->getProperties();
        foreach ($properties as $property) {
            $required = false;
            if (preg_match_all('/@(required)/', $property->getDocComment())) {
                $required = true;
            };
            $result[$property->getName()] = $required;
        }
        return $result;
    }
}
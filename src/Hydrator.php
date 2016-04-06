<?php
/**
 * Hydrator.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 11:52
 */

namespace PowerLinks\OpenRtb;

use PowerLinks\OpenRtb\Tools\ObjectAnalyzer\ObjectDescriber;

class Hydrator
{
    /**
     * @param array $data
     * @param $object
     * @return mixed
     * @throws \Exception
     */
    public static function hydrate(array $data, $object)
    {
        $objectDescriptor = ObjectDescriber::factory($object);
        $data = self::checkFirstArrayKey($data, $objectDescriptor);

        foreach ($data as $key => $value) {
            if (
                is_array($value) &&
                $objectDescriptor->properties->has($key) &&
                $objectDescriptor->properties->get($key)->isObject() &&
                $objectDescriptor->properties->get($key)->get('var') == 'ArrayCollection'
            ) {
                self::set($object, $key, self::getDependencyObject($objectDescriptor, $key));
                $method = 'add'.ucfirst($key);
                if ( ! $objectDescriptor->methods->has($method)) {
                    throw new \Exception(sprintf('Method %s does not exist', $method));
                }
                foreach ($value as $item) {
                    $object->$method(self::hydrate($item, self::getDependencyObject($objectDescriptor, ucfirst($key), false)));
                }
            } elseif (
                is_array($value) &&
                $objectDescriptor->properties->has($key) &&
                $objectDescriptor->properties->get($key)->isObject()
            ) {
                self::set($object, $key, self::hydrate($value, self::getDependencyObject($objectDescriptor, $key)));
            } elseif ($objectDescriptor->properties->has($key)) {
                self::set($object, $key, $value);
            }
        }
        return $object;
    }

    /**
     * @param array $data
     * @param ObjectDescriber $objectDescriptor
     * @return array
     */
    protected static function checkFirstArrayKey(array $data, $objectDescriptor)
    {
        if (strtolower(current(array_keys($data))) == strtolower($objectDescriptor->getClassNameWithoutNamespace())) {
            return current($data);
        }
        return $data;
    }

    /**
     * @param ObjectDescriber $objectDescriptor
     * @param string $key
     * @param bool $getClassNameFromAnnotation
     * @return mixed
     * @throws \Exception
     */
    protected static function getDependencyObject($objectDescriptor, $key, $getClassNameFromAnnotation = true)
    {
        $newClassName = self::getDependencyClassName($objectDescriptor, $key, $getClassNameFromAnnotation);
        $classExists = false;
        if ( ! class_exists($newClassName)) {
            if (substr($newClassName, -1) === 's' && class_exists(substr($newClassName, 0, -1))) {
                $classExists = true;
                $newClassName = substr($newClassName, 0, -1);
            }
        } else {
            $classExists = true;
        }
        if( ! $classExists) {
            throw new \Exception(sprintf('Class %s does not exist', $newClassName));
        }

        return new $newClassName;
    }

    /**
     * @param ObjectDescriber $objectDescriptor
     * @param string $key
     * @param bool $getClassNameFromAnnotation
     * @return string
     */
    protected static function getDependencyClassName($objectDescriptor, $key, $getClassNameFromAnnotation = true)
    {
        if ($getClassNameFromAnnotation) {
            $key = $objectDescriptor->properties->get($key)->get('var');
        }
        if ($key == 'ArrayCollection') {
            return 'PowerLinks\OpenRtb\Tools\Classes\ArrayCollection';
        }
        return $objectDescriptor->getNamespace().'\\'.$key;
    }

    /**
     * @param object $object
     * @param string $key
     * @param mixed $value
     * @throws \Exception
     */
    protected static function set($object, $key, $value)
    {
        $method = 'set'.ucfirst($key);
        if ( ! method_exists($object, $method)) {
            throw new \Exception(sprintf('Method %s does not exist', $method));
        }
        $object->$method($value);
    }
}
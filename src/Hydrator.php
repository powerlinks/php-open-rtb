<?php
/**
 * Hydrator.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 11:52
 */

namespace PowerLinks\OpenRtb;

use PowerLinks\OpenRtb\Tools\ObjectAnalyzer\ObjectDescriberFactory;
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
        $objectDescriptor = ObjectDescriberFactory::create($object);
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
            } elseif ($object instanceof \PowerLinks\OpenRtb\Tools\Classes\Ext) {
                $object->set($key, $value);
            }
        }
        return $object;
    }

    /**
     * @param array $data
     * @param ObjectDescriber $objectDescriber
     * @return array
     */
    protected static function checkFirstArrayKey(array $data, ObjectDescriber $objectDescriber)
    {
        if (strtolower(current(array_keys($data))) == strtolower($objectDescriber->getClassNameWithoutNamespace())) {
            return current($data);
        }
        return $data;
    }

    /**
     * @param ObjectDescriber $objectDescriber
     * @param string $key
     * @param bool $getClassNameFromAnnotation
     * @return mixed
     * @throws \Exception
     */
    protected static function getDependencyObject(ObjectDescriber $objectDescriber, $key, $getClassNameFromAnnotation = true)
    {
        $newClassName = self::getDependencyClassName($objectDescriber, $key, $getClassNameFromAnnotation);
        if ( ! class_exists($newClassName)) {
            $newClassName = self::tryPluralDependencyObject($newClassName);
        }
        return new $newClassName;
    }

    /**
     * @param $newClassName
     * @return string
     * @throws \Exception
     */
    protected static function tryPluralDependencyObject($newClassName)
    {
        if ( ! substr($newClassName, -1) === 's' || ! class_exists($pluralClassName = substr($newClassName, 0, -1))) {
            throw new \Exception(sprintf('Class %s does not exist', $newClassName));
        }
        return $pluralClassName;
    }

    /**
     * @param ObjectDescriber $objectDescriber
     * @param string $key
     * @param bool $getClassNameFromAnnotation
     * @return string
     */
    protected static function getDependencyClassName(ObjectDescriber $objectDescriber, $key, $getClassNameFromAnnotation = true)
    {
        if ($getClassNameFromAnnotation) {
            $key = $objectDescriber->properties->get($key)->get('var');
        }
        if ($key == 'ArrayCollection') {
            return 'PowerLinks\OpenRtb\Tools\Classes\ArrayCollection';
        }
        return $objectDescriber->getNamespace().'\\'.$key;
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
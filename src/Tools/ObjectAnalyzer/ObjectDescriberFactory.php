<?php
/**
 * ObjectDescriberFactory.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 12:56
 */

namespace PowerLinks\OpenRtb\Tools\ObjectAnalyzer;

use PowerLinks\OpenRtb\Tools\Traits\Cache;
use ReflectionClass;
use ReflectionProperty;

class ObjectDescriberFactory
{
    use Cache;

    /**
     * @param $className
     * @return ObjectDescriber
     * @throws \Exception
     */
    public static function create($className)
    {
        $className = self::checkClassName($className);
        if (self::cacheHas($className)) {
            return apcu_fetch($className);
        }

        $reflectionClass = new ReflectionClass($className);
        $objectDescriber = new ObjectDescriber();
        $objectDescriber->name = $reflectionClass->getName();
        $objectDescriber->properties->add(self::createPropertiesBag($reflectionClass));
        $objectDescriber->methods->add(self::createMethodsBag($reflectionClass));

        self::cacheStore($className, $objectDescriber);
        return $objectDescriber;
    }

    /**
     * @param $className
     * @return string
     * @throws \Exception
     */
    private static function checkClassName($className)
    {
        if (is_object($className)) {
            $className = get_class($className);
        }
        if ( ! class_exists($className)) {
            throw new \Exception('Class does not exist');
        }
        return $className;
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return ParametersBag
     */
    private static function createPropertiesBag(ReflectionClass $reflectionClass)
    {
        $result = [];
        foreach ($reflectionClass->getProperties() as $property) {
            $result[$property->getName()] = self::createPropertyAnnotationsBag($property);
        }
        return $result;
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return ParametersBag
     */
    private static function createMethodsBag(ReflectionClass $reflectionClass)
    {
        $result = [];
        foreach ($reflectionClass->getMethods() as $method) {
            $result[$method->getName()] = $method->isPublic();
        }
        return $result;
    }

    /**
     * @param ReflectionProperty $reflectionProperty
     * @return AnnotationsBag
     */
    private static function createPropertyAnnotationsBag(ReflectionProperty $reflectionProperty)
    {
        $annotationsBag = new AnnotationsBag();
        return $annotationsBag
            ->set('name', $reflectionProperty->getName())
            ->initializeDoc($reflectionProperty->getDocComment());
    }
}
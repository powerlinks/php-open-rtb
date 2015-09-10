<?php
/**
 * ObjectDescriber.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 12:56
 */

namespace PowerLinks\OpenRtb\Tools\ObjectAnalyzer;

use ReflectionClass;

class ObjectDescriber
{
    /**
     * @var ReflectionClass
     */
    protected $reflectionClass;

    /**
     * @var ParametersBag
     */
    public $properties;

    /**
     * @var ParametersBag
     */
    public $methods;

    public function __construct($className)
    {
        $this->initialize($className);
    }

    public function initialize($className)
    {

        $this->reflectionClass = new ReflectionClass($className);
        $this->properties = $this->createPropertiesBag($this->reflectionClass);
        $this->methods = $this->createMethodsBag($this->reflectionClass);
    }

    public function getNamespace()
    {
        return $this->reflectionClass->getNamespaceName();
    }

    public function getClassName()
    {
        return $this->reflectionClass->getName();
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return ParametersBag
     */
    public static function createPropertiesBag($reflectionClass)
    {
        $properties = new ParametersBag();
        foreach ($reflectionClass->getProperties() as $property) {
            $properties->set(
                $property->getName(),
                new AnnotationsBag($property)
            );
        }
        return $properties;
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return ParametersBag
     */
    public static function createMethodsBag($reflectionClass)
    {
        $methods = new ParametersBag();
        foreach ($reflectionClass->getMethods() as $method) {
            $methods->set(
                $method->getName(),
                $method
            );
        }
        return $methods;
    }

    public static function factory($className)
    {
        if (is_object($className)) {
            $className = get_class($className);
        }
        if ( ! class_exists($className)) {
            throw new \Exception('Class does not exist');
        }
        return new self($className);
    }
}
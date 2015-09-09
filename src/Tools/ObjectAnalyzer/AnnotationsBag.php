<?php
/**
 * AnnotationsBag.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 13:49
 */

namespace PowerLinks\OpenRtb\Tools\ObjectAnalyzer;

use ReflectionProperty;

class AnnotationsBag extends ParametersBag
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var ReflectionProperty
     */
    protected $reflectionProperty;

    /**
     * @var array
     */
    private $noObjectTypes = [
        'int',
        'float',
        'string',
        'array'
    ];

    /**
     * @param ReflectionProperty $reflectionProperty
     */
    public function __construct(ReflectionProperty $reflectionProperty = null)
    {
        if ( ! is_null($reflectionProperty)) {
            $this->reflectionProperty = $reflectionProperty;
            $this->initialize($reflectionProperty);
        }
    }

    /**
     * @param ReflectionProperty $reflectionProperty
     * @return $this
     */
    public function initialize(ReflectionProperty $reflectionProperty)
    {
        $doc = $reflectionProperty->getDocComment();
        $this->set('name', $reflectionProperty->getName());
        preg_match_all('/@(.*)/', $doc, $matches);
        foreach ($matches[1] as $annotation) {
            $annotation = trim($annotation);
            if (strpos($annotation, ' ') === false) {
                $this->set($annotation, true);
            } else {
                list($key, $value) = explode(' ', $annotation);
                $this->set($key, $value);
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        if ( ! $this->has('required')) {
            return false;
        }
        return $this->parameters['required'];
    }

    /**
     * @return bool
     */
    public function isRecommended()
    {
        if ( ! $this->has('recommended')) {
            return false;
        }
        return $this->parameters['recommended'];
    }

    /**
     * @return bool
     */
    public function isOptional()
    {
        if ( ! $this->has('recommended') && ! $this->has('required')) {
            return false;
        }
        return true;
    }

    public function isObject()
    {
        if ( ! $this->has('var')) {
            throw new \Exception('Impossible to identify the type');
        }
        if (in_array($this->get('var'), $this->noObjectTypes)) {
            return false;
        }
        return true;
    }
}
<?php
/**
 * AnnotationsBag.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 13:49
 */

namespace PowerLinks\OpenRtb\Tools\ObjectAnalyzer;

class AnnotationsBag extends ParametersBag
{
    /**
     * @var array
     */
    protected $parameters;

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
     * @param string $doc
     * @return $this
     */
    public function initializeDoc($doc)
    {
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
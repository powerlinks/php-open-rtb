<?php
/**
 * ObjectDescriber.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 12:56
 */

namespace PowerLinks\OpenRtb\Tools\ObjectAnalyzer;

class ObjectDescriber
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var ParametersBag
     */
    public $properties;

    /**
     * @var ParametersBag
     */
    public $methods;

    /**
     * ObjectDescriber constructor.
     */
    public function __construct()
    {
        $this->properties = new ParametersBag();
        $this->methods = new ParametersBag();
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        $nameSpaceExploded = explode('\\', $this->name);
        array_pop($nameSpaceExploded);
        return implode('\\', $nameSpaceExploded);
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getClassNameWithoutNamespace()
    {
        return current(array_reverse(explode('\\', $this->name)));
    }
}
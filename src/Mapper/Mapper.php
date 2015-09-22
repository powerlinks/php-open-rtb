<?php
/**
 * Mapper.php
 *
 * @copyright PowerLinks
 * @author Ollie Finn <ollie@powerlinks.com>
 * Date: 17/09/2015 - 11:44
 */
namespace PowerLinks\OpenRtb\Mapper;

use PowerLinks\OpenRtb\Tools\ObjectAnalyzer\ObjectDescriber;

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
     * @param array $source
     * @return array
     */
    public function mapFromArray(Map $map, array $source)
    {
        $result = [];
        foreach ($map as $item) {
            $result = array_merge_recursive(
                $result,
                $this->processPath($item->getObjectPath(), $source[$item->getValue()])
            );
        }
        return $result;
    }

    /**
     * @param Map $map
     * @return array
     */
    public function mapFromValues(Map $map)
    {
        $result = [];
        foreach ($map as $item) {
            $result = array_merge_recursive(
                $result,
                $this->processPath($item->getObjectPath(), $item->getValue())
            );
        }
        return $result;
    }

    /**
     * @param string $path
     * @param mixed $value
     * @return array
     */
    protected function processPath($path, $value)
    {
        $result = [];
        $path = array_reverse(explode('.', $path));
        foreach ($path as $node) {
            $matches = $this->parseNode($node);
            if (empty($result)) {
                $result[strtolower($matches['key'])] = $value;
                continue;
            }
            $result = $this->createNode($node, $result);
        }
        return $result;
    }

    /**
     * @param string $node
     * @param mixed $value
     * @return array
     */
    protected function createNode($node, $value)
    {
        $matches = $this->parseNode($node);
        $result = [];
        if (isset($matches['array'])) {
            if (isset($matches['arrayKey'])) {
                $result[strtolower($matches['key'])] = [strtolower($matches['arrayKey']) => $value];
            } else {
                $result[strtolower($matches['key'])] = [$value];
            }
        } else {
            $result[strtolower($matches['key'])] = $value;
        }

        return $result;
    }

    /**
     * @param string $node
     * @return array
     */
    public function parseNode($node)
    {
        $regex = "/(?<key>[\\w]+)(?<array>\\[(?<arrayKey>.*)\\])?/i";
        preg_match($regex, $node, $matches);
        return $matches;
    }


}
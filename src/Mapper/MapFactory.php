<?php
/**
 * MapFactory.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 21/09/15 - 14:40
 */

namespace PowerLinks\OpenRtb\Mapper;


class MapFactory
{
    /**
     * @var array
     */
    protected static $allowedTags = [
        'required',
        'uuid',
        'default'
    ];

    /**
     * @param array $mapSchema
     * @return Map
     */
    public static function create(array $mapSchema)
    {
        $map = new Map();
        foreach ($mapSchema as $key => $value) {
            $tags = [];
            if (strpos($key, ':') !== false) {
                list($key, $tags) = explode(':', $key);
                $tags = self::normaliseTags($tags);
            }
            $map->add(new MapItem($key, $value, $tags));
        }
        return $map;
    }

    /**
     * @param string/array $tags
     * @return array
     * @throws \Exception
     */
    protected static function normaliseTags($tags)
    {
        if (is_string($tags)) {
            $tags = self::tagsFromString($tags);
        }
        if ( ! is_array($tags)) {
            throw new \Exception('Invalid tags');
        }
        return self::validateTags($tags);
    }

    /**
     * @param array $tags
     * @return array
     */
    protected static function validateTags(array $tags)
    {
        $result = [];
        if (empty($tags)) {
            return $result;
        }
        foreach ($tags as $tag => $value) {
            if ( ! self::isValidTag($tag)) {
                continue;
            }
            $result[$tag] = $value;
        }
        return $result;
    }

    /**
     * @param string $tags
     * @return array
     */
    protected static function tagsFromString($tags)
    {
        $result = [];
        $tags = explode('@', $tags);
        foreach ($tags as $tag) {
            if (empty($tag)) {
                continue;
            }
            if (strpos($tag, ' ') !== false) {
                list($tag, $value) = explode(' ', $tag);
            }
            $result[$tag] = isset($value) ? $value : true;
        }
        return $result;
    }

    /**
     * @param $tag
     * @return bool
     */
    protected static function isValidTag($tag)
    {
        if ( ! in_array($tag, self::$allowedTags)) {
            return false;
        }
        return true;
    }
}
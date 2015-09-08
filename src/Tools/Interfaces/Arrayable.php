<?php
/**
 * Arrayable.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/09/15 - 13:26
 */

namespace PowerLinks\OpenRtb\Tools\Interfaces;

interface Arrayable
{
    /**
     * @return array
     */
    public function toArray();
}
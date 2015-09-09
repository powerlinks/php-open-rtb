<?php
/**
 * HydratorTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 12:14
 */

namespace PowerLinks\OpenRtb\Tests;

use PHPUnit_Framework_TestCase;
use PowerLinks\OpenRtb\BidRequest\BidRequest;
use PowerLinks\OpenRtb\Hydrator;

class HydratorTest extends PHPUnit_Framework_TestCase
{
    public function testHydrate()
    {
        $this->markTestSkipped();
        $array = [
            'id' => 'aaa',
            'imp' => [
                ['id' => 'bbb']
            ]
        ];

        $object = new BidRequest();

        $result = Hydrator::hydrate($array, $object);
    }
}
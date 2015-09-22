<?php
/**
 * MapperTest.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 22/09/15 - 09:30
 */

namespace PowerLinks\OpenRtb\Tests\Mapper;

use PHPUnit_Framework_TestCase;
use PowerLinks\OpenRtb\BidRequest\BidRequest;
use PowerLinks\OpenRtb\Hydrator;
use PowerLinks\OpenRtb\Mapper\MapFactory;
use PowerLinks\OpenRtb\Mapper\Mapper;

class MapperTest extends PHPUnit_Framework_TestCase
{
    public function testMapFromValues()
    {
        $demoMap = [
            'BidRequest.Imp[].Native.Request:@required' => 'native',
            'BidRequest.Imp[].Id' => 'id'
        ];

        $map = MapFactory::create($demoMap);

        $mapper = new Mapper();
        $arrayMapped = $mapper->mapFromValues($map, new BidRequest());

        $myObject = new BidRequest();
        Hydrator::hydrate($arrayMapped, $myObject);

        $this->assertEquals(1, $myObject->getImp()->count());
        $this->assertEquals('id', $myObject->getImp()->current()->getId());
        $this->assertEquals('native', $myObject->getImp()->current()->getNative()->getRequest());
    }

    public function testMapFromArray()
    {
        $demoMap = [
            'BidRequest.Imp[].Native.Request:@required' => 'request',
            'BidRequest.Imp[].Id' => 'id'
        ];
        $map = MapFactory::create($demoMap);

        $source = [
            'request' => 'native',
            'id' => '123'
        ];

        $mapper = new Mapper();
        $arrayMapped = $mapper->mapFromArray($map, $source);

        $myObject = new BidRequest();
        Hydrator::hydrate($arrayMapped, $myObject);

        $this->assertEquals(1, $myObject->getImp()->count());
        $this->assertEquals('123', $myObject->getImp()->current()->getId());
        $this->assertEquals('native', $myObject->getImp()->current()->getNative()->getRequest());
    }
}
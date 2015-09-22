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


        var_dump(json_encode($arrayMapped));

        $myObject = new BidRequest();

        Hydrator::hydrate($arrayMapped, $myObject);

        var_dump($myObject->getImp()->count());
        var_dump($myObject->getImp()->current()->getId());
        var_dump($myObject->getImp()->current()->getNative()->getRequest());

    }
}
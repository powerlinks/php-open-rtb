<?php
/**
 * ObjectDescriberTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 09/09/15 - 14:54
 */

namespace PowerLinks\OpenRtb\Tests\Tools\ObjectAnalyzer;

use PHPUnit_Framework_TestCase;
use PowerLinks\OpenRtb\Tools\ObjectAnalyzer\ObjectDescriber;
use PowerLinks\OpenRtb\Tools\ObjectAnalyzer\ObjectDescriberFactory;

class ObjectDescriberTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $descriptor = ObjectDescriberFactory::create('PowerLinks\OpenRtb\BidRequest\BidRequest');

        $this->assertEquals('PowerLinks\OpenRtb\BidRequest\BidRequest', $descriptor->getClassName());
        $this->assertEquals('PowerLinks\OpenRtb\BidRequest', $descriptor->getNamespace());

        $this->assertEquals(16, $descriptor->properties->count());
        $this->assertInstanceOf('Traversable', $descriptor->properties);

        foreach ($descriptor->properties as $propertyName => $property) {
            $this->assertTrue(is_string($propertyName));
            $this->assertEquals($propertyName, $property->get('name'));
            $this->assertInstanceOf('PowerLinks\OpenRtb\Tools\ObjectAnalyzer\AnnotationsBag', $property);
        }

        $this->assertTrue($descriptor->properties->get('id')->isRequired());
        $this->assertFalse($descriptor->properties->get('id')->isObject());
        $this->assertEquals('string', $descriptor->properties->get('id')->get('var'));

        $this->assertInstanceOf('Traversable', $descriptor->methods);
        $this->assertTrue($descriptor->methods->has('setId'));
        $this->assertTrue($descriptor->methods->has('getId'));
    }
}
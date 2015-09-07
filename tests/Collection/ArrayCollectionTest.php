<?php
/**
 * ArrayCollectionTest.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 01/09/15 - 15:01
 */

namespace PowerLinks\OpenRtb\Tests\Collection;

use PHPUnit_Framework_TestCase;
use PowerLinks\OpenRtb\Collection\ArrayCollection;

class ArrayCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayCollection
     */
    private $collection;

    protected function setUp()
    {
        $this->collection = new ArrayCollection();
    }

    public function testIssetAndUnset()
    {
        $this->assertFalse(isset($this->collection[0]));
        $this->collection->add('testing');
        $this->assertTrue(isset($this->collection[0]));
        unset($this->collection[0]);
        $this->assertFalse(isset($this->collection[0]));
    }

    public function testToString()
    {
        $this->collection->add('testing');
        $this->assertTrue(is_string((string) $this->collection));
    }

    public function testRemovingNonExistentEntryReturnsNull()
    {
        $this->assertEquals(null, $this->collection->remove('testing_does_not_exist'));
    }

    public function testFirstAndLast()
    {
        $this->collection->add('one');
        $this->collection->add('two');
        $this->assertEquals($this->collection->first(), 'one');
        $this->assertEquals($this->collection->last(), 'two');
    }

    public function testArrayAccess()
    {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->assertEquals($this->collection[0], 'one');
        $this->assertEquals($this->collection[1], 'two');
        unset($this->collection[0]);
        $this->assertEquals($this->collection->count(), 1);
    }

    public function testContainsKey()
    {
        $this->collection[5] = 'five';
        $this->assertTrue($this->collection->containsKey(5));
    }

    public function testContains()
    {
        $this->collection[0] = 'test';
        $this->assertTrue($this->collection->contains('test'));
    }

    public function testSearch()
    {
        $this->collection[0] = 'test';
        $this->assertEquals(0, $this->collection->indexOf('test'));
    }

    public function testGet()
    {
        $this->collection[0] = 'test';
        $this->assertEquals('test', $this->collection->get(0));
    }

    public function testGetKeys()
    {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->assertEquals(array(0, 1), $this->collection->getKeys());
    }

    public function testGetValues()
    {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->assertEquals(array('one', 'two'), $this->collection->getValues());
    }

    public function testCount()
    {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->assertEquals($this->collection->count(), 2);
        $this->assertEquals(count($this->collection), 2);
    }

    public function testClear()
    {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->collection->clear();
        $this->assertEquals($this->collection->isEmpty(), true);
    }

    public function testRemove()
    {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $el = $this->collection->remove(0);
        $this->assertEquals('one', $el);
        $this->assertEquals($this->collection->contains('one'), false);
        $this->assertNull($this->collection->remove(0));
    }

    public function testRemoveElement()
    {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->assertTrue($this->collection->removeElement('two'));
        $this->assertFalse($this->collection->contains('two'));
        $this->assertFalse($this->collection->removeElement('two'));
    }

    public function testSlice()
    {
        $this->collection[] = 'one';
        $this->collection[] = 'two';
        $this->collection[] = 'three';
        $slice = $this->collection->slice(0, 1);
        $this->assertInternalType('array', $slice);
        $this->assertEquals(array('one'), $slice);
        $slice = $this->collection->slice(1);
        $this->assertEquals(array(1 => 'two', 2 => 'three'), $slice);
        $slice = $this->collection->slice(1, 1);
        $this->assertEquals(array(1 => 'two'), $slice);
    }

    public function fillMatchingFixture()
    {
        $std1 = new \stdClass();
        $std1->foo = "bar";
        $this->collection[] = $std1;
        $std2 = new \stdClass();
        $std2->foo = "baz";
        $this->collection[] = $std2;
    }

    public function testCanRemoveNullValuesByKey()
    {
        $this->collection->add(null);
        $this->collection->remove(0);
        $this->assertTrue($this->collection->isEmpty());
    }
    public function testCanVerifyExistingKeysWithNullValues()
    {
        $this->collection->set('key', null);
        $this->assertTrue($this->collection->containsKey('key'));
    }
}
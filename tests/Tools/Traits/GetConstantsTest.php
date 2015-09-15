<?php
/**
 * GetConstantsTest.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 15/09/15 - 16:58
 */

namespace PowerLinks\OpenRtb\Tests\Tools\Traits;

use PHPUnit_Framework_TestCase;
use PowerLinks\OpenRtb\Tools\Traits\GetConstants;

class TraitImplementation
{
    use GetConstants;

    const TEST = 1;
    const STRING_TEST = 'test';
}

class GetConstantsTest extends PHPUnit_Framework_TestCase
{
    public function testGetAll()
    {
        $result = TraitImplementation::getAll();
        $expected = [
            'TEST' => 1,
            'STRING_TEST' => 'test'
        ];
        $this->assertEquals($expected, $result);
    }
}
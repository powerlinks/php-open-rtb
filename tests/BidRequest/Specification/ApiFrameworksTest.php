<?php
/**
 * ApiFrameworksTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 03/09/15 - 10:34
 */

namespace PowerLinks\OpenRtb\Tests\BidRequest\Specification;

use PowerLinks\OpenRtb\BidRequest\Specification\ApiFrameworks;
use PHPUnit_Framework_TestCase;

class ApiFrameworksTest extends PHPUnit_Framework_TestCase
{
    public function testGetAll()
    {
        $result = ApiFrameworks::getAll();
        $this->assertTrue(is_array($result));
    }
}
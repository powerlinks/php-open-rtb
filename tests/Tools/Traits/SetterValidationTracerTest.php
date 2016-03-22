<?php
/**
 * SetterValidationTracerTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 22/03/16 - 12:22
 */

namespace PowerLinks\OpenRtb\Tests\Tools\Traits;

use PHPUnit_Framework_TestCase;
use PowerLinks\OpenRtb\BidRequest\BidRequest;

class SetterValidationTracerTest extends PHPUnit_Framework_TestCase
{
    public function testTracer()
    {
        try {
            $bidRequest = new BidRequest();
            $bidRequest->addCur(1);
        } catch (\Exception $e) {
            $this->assertContains(
                'PowerLinks\OpenRtb\BidRequest\BidRequest::addCur::416[validateString]',
                $e->getMessage()
            );
        }
    }
}
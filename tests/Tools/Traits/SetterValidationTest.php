<?php
/**
 * SetterValidationTest.php
 * 
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 15/09/15 - 15:39
 */

namespace PowerLinks\OpenRtb\Tests\Tools\Traits;

use PHPUnit_Framework_TestCase;
use PowerLinks\OpenRtb\Tests\AccessProtectedMethod;

class SetterValidationTest extends PHPUnit_Framework_TestCase
{
    private $setterValidation;

    public function setUp()
    {
        $this->setterValidation =  $this->getMockForTrait('PowerLinks\OpenRtb\Tools\Traits\SetterValidation');
    }

    public function testValidateString()
    {
        $this->assertTrue(AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateString', ['test', 1]));
    }

    /**
     * @expectedException \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     * @dataProvider ValidateStringExceptionProvider
     */
    public function testValidateStringException($value)
    {
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateString', [$value]);
    }

    public function ValidateStringExceptionProvider()
    {
        return [
            [1],
            [1.234],
            [new \stdClass],
            [null]
        ];
    }

    public function testValidateInt()
    {
        $this->assertEquals(1, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateInt', [1]));
        $this->assertEquals(-1, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateInt', [-1]));
        $this->assertEquals(0, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateInt', [0]));
    }

    /**
     * @expectedException \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     * @dataProvider ValidateIntExceptionProvider
     */
    public function testValidateIntException($value)
    {
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateInt', [$value, 1]);
    }

    public function ValidateIntExceptionProvider()
    {
        return [
            ['test'],
            [1.234],
            [new \stdClass],
            [null]
        ];
    }

    public function testValidatePositiveInt()
    {
        $this->assertEquals(1, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveInt', [1, 1]));
        $this->assertEquals(0, AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveInt', [0, 1]));
    }

    /**
     * @expectedException \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     * @dataProvider ValidatePositiveIntExceptionProvider
     */
    public function testValidatePositiveIntException($value)
    {
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveInt', [$value, 1]);
    }

    public function ValidatePositiveIntExceptionProvider()
    {
        return [
            ['test'],
            [1.234],
            [-1],
            [new \stdClass],
            [null]
        ];
    }

    public function testValidatePositiveFloat()
    {
        $this->assertEquals(
            0.0,
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [0.0, 1])
        );
        $this->assertEquals(
            1.2,
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [1.2, 1])
        );
        $this->assertEquals(
            0.0,
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [0, 1])
        );
        $this->assertEquals(
            1.0,
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [1, 1])
        );
    }

    /**
     * @expectedException \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     * @dataProvider ValidatePositiveFloatExceptionProvider
     */
    public function testValidatePositiveFloatException($value)
    {
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validatePositiveFloat', [$value, 1]);
    }

    public function ValidatePositiveFloatExceptionProvider()
    {
        return [
            ['test'],
            [-1],
            [-1.2],
            [new \stdClass],
            [null]
        ];
    }

    public function testValidateIn()
    {
        $this->assertTrue(
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateIn', [1, [1 ,2, 3], 1])
        );
        $this->assertTrue(
            AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateIn', ['alpha', ['alpha', 'bravo'], 1])
        );
    }

    /**
     * @expectedException \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     * @dataProvider ValidateInExceptionProvider
     */
    public function testValidateInException($value, $validValues)
    {
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateIn', [$value, $validValues, 1]);
    }

    public function ValidateInExceptionProvider()
    {
        return [
            ['test', ['alpha', 'bravo']],
            [1, [2, 3]],
            [null, [1, 2, 3]]
        ];
    }

    public function testValidateInWithCustom500Values()
    {
        $this->assertTrue(
            AccessProtectedMethod::invokeMethod(
                $this->setterValidation,
                'validateInWithCustom500Values',
                [501, [1 ,2, 3], 1]
            )
        );
        $this->assertTrue(
            AccessProtectedMethod::invokeMethod(
                $this->setterValidation,
                'validateInWithCustom500Values',
                [599, [1 ,2, 3], 1]
            )
        );
    }

    /**
     * @expectedException \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     * @dataProvider ValidateInWithCustom500ValuesExceptionProvider
     */
    public function testValidateInWithCustom500ValuesException($value, $validValues)
    {
        AccessProtectedMethod::invokeMethod(
            $this->setterValidation,
            'validateInWithCustom500Values',
            [$value, $validValues, 1]
        );
    }

    public function ValidateInWithCustom500ValuesExceptionProvider()
    {
        return [
            [99, [1, 2, 3]],
            [499, [1, 2, 3]]
        ];
    }

    public function testValidateMd5()
    {
        $this->assertTrue(AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateMd5', [md5(1), 1]));
    }

    /**
     * @expectedException \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     * @dataProvider ValidateMd5ExceptionProvider
     */
    public function testValidateMd5Exception($value)
    {
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateMd5', [$value, 1]);
    }

    public function ValidateMd5ExceptionProvider()
    {
        return [
            ['g4ca4238a0b923820dcc509a6f75849b'],
            ['cc4ca4238a0b923820dcc509a6f75849b'],
            ['4ca4238a0b923820dcc509a6f75849b'],
            [1],
            [1.234],
            [new \stdClass],
            [null]
        ];
    }

    public function testValidateSha1()
    {
        $this->assertTrue(AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateSha1', [sha1(1), 1]));
    }

    /**
     * @expectedException \PowerLinks\OpenRtb\Tools\Exceptions\ExceptionInvalidValue
     * @dataProvider ValidateSha1ExceptionProvider
     */
    public function testValidateSha1Exception($value)
    {
        AccessProtectedMethod::invokeMethod($this->setterValidation, 'validateSha1', [$value, 1]);
    }

    public function ValidateSha1ExceptionProvider()
    {
        return [
            ['g4ca4238a0b923820dcc509a6f75849b509a6f75'],
            ['cc4ca4238a0b923820dcc509a6f75849b509a6f75'],
            ['4ca4238a0b923820dcc509a6f75849b509a6f75'],
            [1],
            [1.234],
            [new \stdClass],
            [null]
        ];
    }
}
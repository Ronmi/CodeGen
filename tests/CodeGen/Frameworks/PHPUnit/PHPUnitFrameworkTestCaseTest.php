<?php
use CodeGen\Testing\CodeGenTestCase;
use CodeGen\LicenseBlock;
use CodeGen\Raw;
use CodeGen\Frameworks\PHPUnit\PHPUnitFrameworkTestCase;
use CodeGen\Frameworks\PHPUnit\Assertions;

class PHPUnitFrameworkTestCaseTest extends CodeGenTestCase
{
    public function testGeneratingTestCase()
    {
        $testCase = new PHPUnitFrameworkTestCase('MyAppTest');
        $testCase->addTest('arrayIsNotEmpty');
        $this->assertCodeEqualsFile('tests/data/frameworks/phpunit/phpunit_testcase.fixture', $testCase);
    }


    public function testGeneratingTestCaseWithAssertions()
    {
        $testCase = new PHPUnitFrameworkTestCase('MyAppSimpleTest');
        $method = $testCase->addTest('simple');
        $method->getBlock()->appendLine(Assertions::assertEquals(10, 10));
        $method->getBlock()->appendLine(Assertions::assertEquals(10, new Raw(10)));
        $this->assertCodeEqualsFile('tests/data/frameworks/phpunit/phpunit_testcase_simple.fixture', $testCase);
    }
}


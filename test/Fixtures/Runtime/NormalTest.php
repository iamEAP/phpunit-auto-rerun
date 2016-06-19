<?php

    namespace Alorel\PHPUnitRetryRunner\Fixtures\Runtime;

    use Alorel\PHPUnitRetryRunner\RetriableTestCase;

    /**
     * These are just normal test cases - testing to see that they don't interfere
     *
     * @sleepTime  0
     * @retryCount 0
     */
    class NormalTest extends RetriableTestCase {

        private $curr = null;
        private $_curr = null;

        function setUp() {
            $this->curr = $this->getName(false);
        }

        /** @before */
        function _setUp() {
            $this->_curr = $this->getName(false);
        }

        private function checkCurr() {
            $this->assertEquals($this->getName(true), $this->curr);
            $this->assertEquals($this->getName(true), $this->curr);

            return $this;
        }

        function testNormalAssertions() {
            $this->assertEquals(1, 1);
            $this->assertTrue(true);
            $this->assertFalse(false);
            $this->assertContains('foo', ['foo']);

            $this->checkCurr();
        }

        /**
         * @expectedException \Exception
         * @expectedExceptionMessage foo
         * @expectedExceptionCode    5
         */
        function testExpectedException() {
            $this->checkCurr();

            throw new \Exception('foo', 5);
        }

    }
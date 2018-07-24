<?php
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase {
  public function testTrueAssertsTrue() {
    $this->assertFalse(false);
  }
}
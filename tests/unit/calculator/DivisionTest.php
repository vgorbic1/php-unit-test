<?php
use PHPUnit\Framework\TestCase;

class DivisionTest extends TestCase {

  /** @test */
  public function dividesGivenOperands() {
    $division = new \App\Calculator\Division;
    $division->SetOperands([100, 2]);
    $this->assertEquals(50, $division->calculate());
  }

  /** @test */
  public function ingnoreDivisionByZero() {
    $division = new \App\Calculator\Division;
    $division->SetOperands([10, 0, 0, 5]);
    $this->assertEquals(2, $division->calculate());
  }

  /** @test */
  public function throwNoOperandsException() {
    $this->expectException(\App\Calculator\Exceptions\NoOperandsException::class);
    $addition = new \App\Calculator\Division;
    $addition->calculate();
  }
}
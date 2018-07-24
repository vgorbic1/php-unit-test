<?php
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase {

  /** @test */
  public function canSetSingleOperation() {
    $addition = new \App\Calculator\Addition;
    $addition->setOperands([5, 10]);
    $calculator = new \App\Calculator\Calculator;
    $calculator->setOperation($addition);
    $this->assertCount(1, $calculator->getOperations());
  }

 
  /** @test */
  public function canSetMultipleOperations() {
    $addition1 = new \App\Calculator\Addition;
    $addition2 = new \App\Calculator\Addition;
    $addition1->setOperands([5, 10]);
    $addition2->setOperands([2, 2]);
    $calculator = new \App\Calculator\Calculator;
    $calculator->setOperations([$addition1, $addition2]);
    $this->assertCount(2, $calculator->getOperations());
  }

  /** @test */
  public function ignoredIfNotInstanceOfOperationInterface() {
    $addition = new \App\Calculator\Addition;
    $addition->setOperands([5, 10]);
    $calculator = new \App\Calculator\Calculator;
    $calculator->setOperations([$addition, 'cats', 'dogs']);
    $this->assertCount(1, $calculator->getOperations());
  }

  /** @test */
  public function canCalculateResult() {
    $addition = new \App\Calculator\Addition;
    $addition->setOperands([5, 10]);
    $calculator = new \App\Calculator\Calculator;
    $calculator->setOperation($addition);
    $this->assertEquals(15, $calculator->calculate());
  }

  /** @test */
  public function calculateReturnsMultipleResults() {
    $addition = new \App\Calculator\Addition;
    $addition->setOperands([5, 10]);
    $division = new \App\Calculator\Division;
    $division->setOperands([50, 2]);
    $calculator = new \App\Calculator\Calculator;
    $calculator->setOperations([$addition, $division]);

    $this->assertInternalType('array', $calculator->calculate());
    $this->assertEquals(15, $calculator->calculate()[0]);
    $this->assertEquals(25, $calculator->calculate()[1]);
  }

}
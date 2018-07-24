<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

  protected $user;

  // This method runs before each test
  public function setUp() {
    $this->user = new \App\Models\User;
  }

  /** @test */  // add this line if you want the name of the test function start without "test" in the beginning.
  public function getFirstName() {
    $this->user->setFirstName('Billy');
    $this->assertEquals($this->user->getFirstName(), 'Billy');
  }

  public function testGetLastName() {
    $this->user->setLastName('Bones');
    $this->assertEquals($this->user->getLastName(), 'Bones');
  }

  public function testFullNameIsReturned() {
    $this->user->setFirstName('Billy');
    $this->user->setLastName('Bones');
    $this->assertEquals($this->user->getFullName(), 'Billy Bones');
  }

  public function testFirstAndLastNameTrimmed() {
    $this->user->setFirstName('   Billy  ');
    $this->user->setLastName('    Bones');
    $this->assertEquals($this->user->getFirstName(), 'Billy');
    $this->assertEquals($this->user->getLastName(), 'Bones');
  }

  public function testEmailAddressCanBeSet() {
    $this->user->setEmail('billybones@gmail.com');
    $this->assertEquals($this->user->getEmail(), 'billybones@gmail.com');
  }

  public function testEmailVariablesContainCorrectValues() {
    $this->user->setFirstName('Billy');
    $this->user->setLastName('Bones');
    $this->user->setEmail('billybones@gmai.com');
    $emailVariables = $this->user->getEmailVariables();
    $this->assertArrayHasKey('full_name', $emailVariables);
    $this->assertArrayHasKey('email', $emailVariables);
    $this->assertEquals($emailVariables['full_name'], 'Billy Bones');
    $this->assertEquals($emailVariables['email'], 'billybones@gmai.com');
  }
}
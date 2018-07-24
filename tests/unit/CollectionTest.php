<?php
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase {

  /** @test */
  public function emptyInstantiatedCollctionNoItems() {
    $collection = new \App\Support\Collection([]);
    $this->assertEmpty($collection->get());
  }

  /** @test */
  public function countCorrectForPassedInItems() {
    $collection = new \App\Support\Collection(['one', 'two', 'three']);
    $this->assertEquals($collection->count(), 3);
  }

  /** @test */
  public function itemsPassedMatchItemsReturned() {
    $collection = new \App\Support\Collection(['one']);
    $this->assertCount(1, $collection->get());
    $this->assertEquals($collection->get()[0], 'one');
  }

  /** @test */
  public function collectionIsInstanceOfIteratorAggregate() {
    $collection = new \App\Support\Collection([]);
    $this->assertInstanceOf(IteratorAggregate::class, $collection);
  }

  /** @test */
  public function collectionCanBeIterated() {
    $collection = new \App\Support\Collection(['one', 'two', 'three']);
    $items = [];
    foreach ($collection as $item) {
      $items[] = $item;
    }
    $this->assertCount(3, $items);
    $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
  }

  /** @test */
  public function collectionsCanBeMerged() {
    $collection1 = new \App\Support\Collection(['one', 'two']);
    $collection2 = new \App\Support\Collection(['three', 'four', 'five']);
    $collection1->merge($collection2);
    $this->assertCount(5, $collection1->get());
    $this->assertEquals(5, $collection1->count());
  }

  /** @test */
  public function canAddToExistingCollection() {
    $collection = new \App\Support\Collection(['one','two']);
    $collection->add(['three']);
    $this->assertEquals(3, $collection->count());
    $this->assertCount(3, $collection->get());
  }

  /** @test */
  public function returnJSONencodedItems() {
    $collection = new \App\Support\Collection([['firstName' => 'Billy'], ['lastName' => 'Bones']]);
    $this->assertInternalType('string', $collection->toJSON());
    $this->assertEquals('[{"firstName":"Billy"},{"lastName":"Bones"}]', 
      $collection->toJSON());
  }

  /** @test */
  public function collectionReturnsJSON() {
    $collection = new \App\Support\Collection([['firstName' => 'Billy'], ['lastName' => 'Bones']]);
    $encoded = json_encode($collection);
    $this->assertInternalType('string', $encoded);
    $this->assertEquals('[{"firstName":"Billy"},{"lastName":"Bones"}]', $encoded);
  }
}
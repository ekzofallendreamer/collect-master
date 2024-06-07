<?php

use PHPUnit\Framework\TestCase;

class CollectTest extends TestCase
{
    public function testKeys()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame(['a', 'b', 'c'], $collect->keys()->toArray());

        $collect = new Collect\Collect([]);
        $this->assertSame([], $collect->keys()->toArray());

        $collect = new Collect\Collect([1 => 'a', 2 => 'b', 3 => 'c']);
        $this->assertSame([1, 2, 3], $collect->keys()->toArray());
    }

    public function testValues()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame([1, 2, 3], $collect->values()->toArray());

        $collect = new Collect\Collect([]);
        $this->assertSame([], $collect->values()->toArray());

        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame([1, 2, 3], $collect->values()->toArray());
    }

    public function testGet()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame(2, $collect->get('b'));
    }

    public function testExcept()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collect->except('a');
        $this->assertInstanceOf(Collect\Collect::class, $result);

        $resultArray = $result->toArray();
        $this->assertCount(2, $resultArray);

        $this->assertArrayNotHasKey('a', $resultArray);
        $this->assertArrayHasKey('b', $resultArray);
        $this->assertArrayHasKey('c', $resultArray);

        $result = $collect->except('a', 'b', 'c');
        $this->assertCount(0, $result->toArray());
    }

    public function testOnly()
    {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new Collect\Collect($data);

        $filtered = $collect->only('a', 'b');

        $this->assertSame(['a' => 1, 'b' => 2], $filtered->toArray());

        $this->assertSame($data, $collect->toArray());
    }


    public function testFirst()
    {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new Collect\Collect($data);

        $firstElement = $collect->first();

        $this->assertSame(1, $firstElement);

        $this->assertSame($data, $collect->toArray());
    }


    public function testCount()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame(3, $collect->count());
    }

    public function testToArray()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $this->assertSame(['a' => 1, 'b' => 2, 'c' => 3], $collect->toArray());
    }

    public function testPush()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $collect->push(4);
        $this->assertSame(['a' => 1, 'b' => 2, 'c' => 3, 4], $collect->toArray());
    }

    public function testUnshift()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $collect->unshift(0);
        $this->assertSame([0, 'a' => 1, 'b' => 2, 'c' => 3], $collect->toArray());
    }

    public function testShift()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $collect->shift();
        $this->assertSame(['b' => 2, 'c' => 3], $collect->toArray());
    }

    public function testPop()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $collect->pop();
        $this->assertSame(['a' => 1, 'b' => 2], $collect->toArray());
    }

    public function testSplice()
    {
        $collect = new Collect\Collect(['a' => 1, 'b' => 2, 'c' => 3]);
        $collect->splice(1, 1);
        $this->assertSame(['a' => 1, 'c' => 3], $collect->toArray());
    }
}

<?php

/**
 * @see       https://github.com/laminas/laminas-tag for the canonical source repository
 * @copyright https://github.com/laminas/laminas-tag/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-tag/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Tag;

use Laminas\Tag;

/**
 * @group      Laminas_Tag
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $tag = new Tag\Item(array(
            'title' => 'foo',
            'weight' => 10,
            'params' => array(
                'bar' => 'baz'
            )
        ));

        $this->assertEquals('foo', $tag->getTitle());
        $this->assertEquals(10, $tag->getWeight());
        $this->assertEquals('baz', $tag->getParam('bar'));
    }

    public function testSetOptions()
    {
        $tag = new Tag\Item(array('title' => 'foo', 'weight' => 1));
        $tag->setOptions(array(
            'title' => 'bar',
            'weight' => 10,
            'params' => array(
                'bar' => 'baz'
            )
        ));

        $this->assertEquals('bar', $tag->getTitle());
        $this->assertEquals(10, $tag->getWeight());
        $this->assertEquals('baz', $tag->getParam('bar'));
    }

    public function testSetParam()
    {
        $tag = new Tag\Item(array('title' => 'foo', 'weight' => 1));
        $tag->setParam('bar', 'baz');

        $this->assertEquals('baz', $tag->getParam('bar'));
    }

    public function testSetTitle()
    {
        $tag = new Tag\Item(array('title' => 'foo', 'weight' => 1));
        $tag->setTitle('baz');

        $this->assertEquals('baz', $tag->getTitle());
    }

    public function testInvalidTitle()
    {
        $this->setExpectedException('\Laminas\Tag\Exception\InvalidArgumentException', 'Title must be a string');
        $tag = new Tag\Item(array('title' => 10, 'weight' => 1));
    }

    public function testSetWeight()
    {
        $tag = new Tag\Item(array('title' => 'foo', 'weight' => 1));
        $tag->setWeight('10');

        $this->assertEquals(10.0, $tag->getWeight());
        $this->assertInternalType('float', $tag->getWeight());
    }

    public function testInvalidWeight()
    {
        $this->setExpectedException('\Laminas\Tag\Exception\InvalidArgumentException', 'Weight must be numeric');
        $tag = new Tag\Item(array('title' => 'foo', 'weight' => 'foobar'));
    }

    public function testSkipOptions()
    {
        $tag = new Tag\Item(array('title' => 'foo', 'weight' => 1, 'param' => 'foobar'));
        // In case would fail due to an error
    }

    public function testInvalidOptions()
    {
        $this->setExpectedException('\Laminas\Tag\Exception\InvalidArgumentException', 'Invalid options provided to constructor');
        $tag = new Tag\Item('test');
    }

    public function testMissingTitle()
    {
        $this->setExpectedException('\Laminas\Tag\Exception\InvalidArgumentException', 'Title was not set');
        $tag = new Tag\Item(array('weight' => 1));
    }

    public function testMissingWeight()
    {
        $this->setExpectedException('\Laminas\Tag\Exception\InvalidArgumentException', 'Weight was not set');
        $tag = new Tag\Item(array('title' => 'foo'));
    }

    public function testConfigOptions()
    {
        $tag = new Tag\Item(new \Laminas\Config\Config(array('title' => 'foo', 'weight' => 1)));

        $this->assertEquals($tag->getTitle(), 'foo');
        $this->assertEquals($tag->getWeight(), 1);
    }

    public function testGetNonSetParam()
    {
        $tag = new Tag\Item(array('title' => 'foo', 'weight' => 1));

        $this->assertNull($tag->getParam('foo'));
    }
}

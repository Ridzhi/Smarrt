<?php

use Smarrt\Dot;

class DotTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ReflectionClass
     */
    protected static $inst;

    /**
     * @var Dot
     */
    protected $obj;

    protected $data;

    public static function setUpBeforeClass()
    {
        self::$inst = new ReflectionClass('\Smarrt\Dot');
    }

    protected function setUp()
    {
        $this->data = [
            'users' => [
                'admin' => [
                    'user_1',
                    'user_2',
                    'root' => [
                        'root_1',
                        'root_2'
                    ]
                ]
            ],
            [
                ['Sergey', 'Alexander'],
                ['Natalya', 'Katerina']
            ]
        ];

        $this->obj = Dot::with($this->data);
    }

    public function testGetAssocKey()
    {
        $actual = $this->obj->get('users.admin.root');
        $this->assertEquals($this->data['users']['admin']['root'], $actual);
    }

    public function testGetIndexKey()
    {
        $actual = $this->obj->get('0.1.1');
        $this->assertEquals($this->data[0][1][1], $actual);
    }

    public function testGetAssocIndexKey()
    {
        $actual = $this->obj->get('users.admin.1');
        $this->assertEquals($this->data['users']['admin'][1], $actual);
    }

    public function testGetDefault()
    {
        $actual = $this->obj->get('users.some_not_exists', 'default');
        $this->assertEquals('default', $actual);
    }

    public function testSetAssocKey()
    {
        $expected = $this->data;
        $this->obj->set('users.admin.root', 'root_upd');
        $expected['users']['admin']['root'] = 'root_upd';
        $this->assertEquals($expected, $this->data);
    }

    public function testSetIndexKey()
    {
        $expected = $this->data;
        $this->obj->set('0.1.1', 'Katerina_upd');
        $expected[0][1][1] = 'Katerina_upd';
        $this->assertEquals($expected, $this->data);
    }

    public function testSetAssocIndexKey()
    {
        $expected = $this->data;
        $this->obj->set('users.admin.root.1', 'root_upd');
        $expected['users']['admin']['root'][1] = 'root_upd';
        $this->assertEquals($expected, $this->data);
    }

    public function testSetIfKeyNotExists()
    {
        $expected = $this->data;
        $this->obj->set('users.moderator.male.2', 'moder');
        $expected['users']['moderator'] = [];
        $expected['users']['moderator']['male'] = [];
        $expected['users']['moderator']['male'][2] = 'moder';
        $this->assertEquals($expected, $this->data);
    }

    public function testSetIfKeyNotExistsForEmpty()
    {
        $expected = $actual = [];
        Dot::with($actual)->set('users.moderator', 'moder');
        $expected['users'] = [];
        $expected['users']['moderator'] = 'moder';
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider parseKeyProvider
     */
    public function testParseKey($key, $expected)
    {
        $method = self::$inst->getMethod('parseKey');
        $method->setAccessible(true);
        $actual = $method->invoke(null, $key);
        $this->assertEquals($expected, $actual);
    }

    public function parseKeyProvider()
    {
        return [
            'empty' => ['', []],
            'one' => ['users', ['users']],
            'few' => ['users.admin.root', ['users', 'admin', 'root']],
            'withIndex' => ['users.0.admin.0.1', ['users', '0', 'admin', '0', '1']]
        ];
    }

}
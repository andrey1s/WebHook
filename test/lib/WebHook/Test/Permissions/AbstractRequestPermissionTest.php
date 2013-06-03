<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 6/4/13
 * @version 1.0.0
 */

namespace WebHook\Test\Permissions;

use Symfony\Component\HttpFoundation\Request;
use WebHook\Test\Base;

class AbstractRequestPermissionTest extends Base
{
    /**
     * @var AbstractRequestPermission
     */
    protected $class;

    protected function setUp()
    {
        $this->class = $this->getMockForAbstractClass('WebHook\Permissions\AbstractRequestPermission');
    }

    public function testInit()
    {
        $this->assertNull($this->class->init(new Request()));
    }

    public function testSetValue()
    {
        $this->assertNull($this->class->setCheckValue(true));
    }
}
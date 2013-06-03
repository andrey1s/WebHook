<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 6/3/13
 * @version 1.0.0
 */

namespace WebHook\Test\Permissions;


use Symfony\Component\HttpFoundation\Request;
use WebHook\Permissions\MethodRequestPermission;
use WebHook\Test\Base;

class MethodRequestPermissionTest extends Base
{
    public function testInterface()
    {
        $mrp = new MethodRequestPermission();
        $this->assertInstanceOf('WebHook\Permissions\PermissionInterface', $mrp);
        $this->assertInstanceOf('WebHook\Permissions\AbstractRequestPermission', $mrp);
    }

    public function testCheck()
    {
        $request = new Request();
        $request->setMethod('POST');
        $mrp = new MethodRequestPermission();
        $mrp->init($request);
        $this->assertTrue($mrp->check());
        $mrp->setCheckValue(null);
        $this->assertTrue($mrp->check('POST'));
        $mrp->setCheckValue(null);
        $this->assertFalse($mrp->check('GET'));
        $mrp->setCheckValue('POST');
        $this->assertTrue($mrp->check());
        $mrp->setCheckValue('GET');
        $this->assertFalse($mrp->check());
    }
}
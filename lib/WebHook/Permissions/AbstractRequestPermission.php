<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 6/3/13
 * @version 1.0.0
 */

namespace WebHook\Permissions;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRequestPermission implements PermissionInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var mixed
     */
    protected $checkValue = null;

    /**
     * init Permission
     *
     * @param Request $request
     * @return $this
     */
    public function init($request)
    {
        $this->request = $request;
    }

    /**
     * set Check Value
     *
     * @param $value
     */
    public function setCheckValue($value)
    {
        $this->checkValue = $value;
    }

}
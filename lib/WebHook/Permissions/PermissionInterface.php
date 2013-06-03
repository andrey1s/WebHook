<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/29/13
 * @version 1.0.0
 */
namespace WebHook\Permissions;

interface PermissionInterface
{
    /**
     * init Permission
     *
     * @param mixed $value
     * @return $this
     */
    public function init($value);

    /**
     * check Permission
     *
     * @param mixed $value
     * @return boolean
     */
    public function check($value = null);
}
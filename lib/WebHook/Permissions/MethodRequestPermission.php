<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/29/13
 * @version 1.0.0
 */

namespace WebHook\Permissions;

use Symfony\Component\HttpFoundation\Request;

class MethodRequestPermission extends AbstractRequestPermission
{
    /**
     * {@inheritdoc}
     */
    public function check($method = "POST")
    {
        if (!$this->checkValue) {
            $this->setCheckValue($method);
        }

        return $this->request->isMethod($this->checkValue);
    }
}
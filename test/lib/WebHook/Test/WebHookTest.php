<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/27/13
 * @version 1.0.0
 */
namespace WebHook\Test;

use Psr\Log\NullLogger;
use WebHook\Test\Base as BaseTest;
use WebHook\WebHook;

class WebHookTest extends BaseTest
{
    public function testEmptyRun()
    {
        $wh = new WebHook();
        $this->assertTrue($wh->run());
    }

    public function testLsRun()
    {
        $wh = new WebHook();
        $wh->addCommand('ls -la');
        $this->assertTrue($wh->run());
    }

    public function testErrorRun()
    {
        $wh = new WebHook();
        $wh->setLogger(new NullLogger());
        $wh->addCommand('errorCommand -la');
        $this->assertFalse($wh->run());
    }

}
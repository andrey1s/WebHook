<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/27/13
 * @version 1.0.0
 */
namespace WebHook;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\Process;
use WebHook\Permissions\PermissionInterface;

class WebHook implements LoggerAwareInterface
{
    /**
     * @var array
     */
    private $commands = array();

    /**
     * @var LoggerInterface
     */
    private $logger = null;

    /**
     * @var string root dir
     */
    private $cwd = null;

    /**
     * @var PermissionInterface[]
     */
    private $permissions = array();

    /**
     * init
     *
     * @param string $rootDir
     */
    public function __construct($rootDir = null)
    {
        $this->cwd = $rootDir ? : __DIR__;
    }

    /**
     * run webHook
     */
    public function run()
    {
        $status = false;
        if ($this->checkPermissions()) {
            $status = $this->runCommands();
        }

        return $status;
    }

    /**
     * add Permission
     *
     * @param PermissionInterface $permission
     */
    public function addPermission(PermissionInterface $permission)
    {
        $this->permissions[] = $permission;
    }

    /**
     * add Command
     *
     * @param string $cmd
     * @return $this
     */
    public function addCommand($cmd)
    {
        $this->commands[] = $cmd;

        return $this;
    }

    /**
     * {@internal}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * check Permissions
     *
     * @return bool
     */
    private function checkPermissions()
    {
        /** @var PermissionInterface $permission */
        foreach ($this->permissions as $permission) {
            if ($permission->check() === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * run commands
     *
     * @return $this
     * @throws \Exception
     */
    private function runCommands()
    {
        $success = true;
        foreach ($this->commands as $process) {
            if (!($process instanceof Process)) {
                if (is_array($process)) {
                    $this->cwd = empty($process['cwd']) ? $this->cwd : $process['cwd'];
                    $process = $process['cmd'];
                }
                $process = new Process($process, $this->cwd);
            }
            $process->run();
            if ($this->logger) {
                $this->logger->info($process->getCommandLine() . $process->getWorkingDirectory(), array('output' => $process->getOutput()));
            }
            if (!$process->isSuccessful()) {
                $success = $process->isSuccessful();
                if ($this->logger) {
                    $this->logger->critical($process->getCommandLine() . $process->getWorkingDirectory(), array('error_output' => $process->getErrorOutput()));
                } else {
                    throw new RuntimeException('error run command' . $process->getCommandLine() . $process->getWorkingDirectory());
                }
            }
        }

        return $success;
    }
}
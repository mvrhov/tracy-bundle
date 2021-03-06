<?php

namespace Kutny\TracyBundle;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tracy\Debugger;

class KernelExceptionListener
{
    /** string */
    private $logDirectory;

    private $emails;

    public function __construct($logDirectory, array $emails)
    {
        $this->logDirectory = $logDirectory;
        $this->emails = $emails;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$this->isNotFoundException($exception) && !$this->isAccessDeniedHttpException($exception)) {
            Debugger::$logDirectory = $this->logDirectory;
            Debugger::$email = $this->emails;

            ob_start();
            Debugger::_exceptionHandler($exception, true);
            $event->setResponse(new Response(ob_get_contents()));
            ob_clean();
        }
    }

    private function isNotFoundException(Exception $exception)
    {
        return $exception instanceOf NotFoundHttpException;
    }

    private function isAccessDeniedHttpException(Exception $exception)
    {
        return $exception instanceOf AccessDeniedHttpException;
    }
}

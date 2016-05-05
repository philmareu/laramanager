<?php

namespace Philsquare\LaraManager\Logging;

use Exception;
use Illuminate\Http\Request;
use Philsquare\LaraManager\Models\Error;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionLogging {

    protected $exception;

    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
        $this->log();
    }

    public function log()
    {
        $error = new Error;

//        if($this->exception instanceof NotFoundHttpException)
//        {
//
//        }

        $uri = $this->getRequestUri();

        if(! strpos($uri, 'admin'))
        {
            $existing = $error->where('uri', $uri)
                ->where('exception', get_class($this->exception))
                ->where('message', $this->exception->getMessage())
                ->first();

            if(is_null($existing))
            {
                $error->create([
                    'exception' => get_class($this->exception),
                    'uri' => $uri,
                    'count' => 1,
                    'message' => $this->exception->getMessage()
                ]);
            }
            else
            {
                $existing->increment('count', 1);
            }
        }
    }

    private function getRequestUri()
    {
        $trace = $this->exception->getTrace();
        $first = end($trace);

        return $first['args'][0]->getRequestUri();
    }

}
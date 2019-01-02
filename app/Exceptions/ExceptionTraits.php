<?php

namespace App\Exceptions;

use Exception;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// class ExceptionTraits extends Exception
// {
    
// }

trait ExceptionTraits
{

      public function apiException($request,$e)
      {
        if($this->isModel($e))
        {
            return $this->ModelResponse($e);
        }
        if($this->isRoute($e))
        {
            return $this->RouteResponse($e);
        }
            return parent::render($request, $e);
      }

      protected function isModel($e)
      {
            return $e instanceof ModelNotFoundException;
      }
      protected function isRoute($e)
      {
          return $e  instanceof NotFoundHttpException;
      }

      protected function RouteResponse($e)
      {
            return response()->json([

                'errors'=>'Incorrect Route',
                'status_code'=>'404',
            ]);
      }
      protected function ModelResponse($e)
      {
            return response()->json([

                'errors'=>'Model Not found',
                'status_code'=>'404',
            ]);
      }
}


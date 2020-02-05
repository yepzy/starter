<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Error404Controller extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiResponse()
    {
        return response()->json(['message' => __('errors.message.404')], 404);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function webResponse()
    {
        return response()->view('errors.default', ['exception' => new HttpException(404)], 404);
    }
}

<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FallbackController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function layout()
    {
        return view('layout');
    }

    /**
     * @throws NotFoundHttpException
     */
    public function notFound()
    {
        throw new NotFoundHttpException();
    }
}

<?php

namespace Tv2regionerne\StatamicPassport\Http\Controllers\CP;

use Illuminate\Http\Request;

class PassportController
{
    public function index(Request $request)
    {
        return view('statamic-passport::index');
    }
}

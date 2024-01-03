<?php

namespace Tv2regionerne\StatamicPassport\Http\Controllers\CP;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController;

class PassportController extends CpController
{
    public function index(Request $request)
    {
        $this->authorize('manage passport', [], __('You are not authorized to manage Passport.'));

        return view('statamic-passport::index');
    }
}

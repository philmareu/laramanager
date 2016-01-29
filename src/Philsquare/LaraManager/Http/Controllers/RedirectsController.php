<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Philsquare\LaraManager\Models\Redirect;

class RedirectsController extends Controller {

    public function redirect(Request $request, Redirect $redirect)
    {
        $redirect = $redirect->where('from', $request->path())->first();

        if(is_null($redirect)) abort(404);

        return redirect($redirect->to, $redirect->type);
    }

}
<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Philsquare\LaraManager\Http\Requests\CreateRedirectRequest;
use Philsquare\LaraManager\Http\Requests\UpdateRedirectRequest;
use Philsquare\LaraManager\Models\Redirect;

class RedirectsController extends Controller {

    protected $redirect;

    public function __construct(Redirect $redirect)
    {
        $this->redirect = $redirect;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $redirects = $this->redirect->all();

        return view('laramanager::redirects.index', compact('redirects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laramanager::redirects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRedirectRequest $request)
    {
        $this->redirect->create($request->all());

        return redirect('admin/redirects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $redirect = $this->redirect->findOrFail($id);

        return view('laramanager::redirects.edit', compact('redirect'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRedirectRequest $request, $id)
    {
        $redirect = $this->redirect->findOrFail($id);
        $redirect->update($request->all());

        return redirect('admin/redirects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $redirect = $this->redirect->findOrFail($id);

        if($redirect->delete()) return response()->json(['status' => 'ok']);

        return response()->json(['status' => 'failed']);
    }

    public function redirect(Request $request, Redirect $redirect)
    {
        $redirect = $redirect->where('from', $request->path())->first();

        if(is_null($redirect)) abort(404);

        return redirect($redirect->to, $redirect->type);
    }

}
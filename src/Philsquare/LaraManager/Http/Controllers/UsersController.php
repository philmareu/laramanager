<?php namespace Philsquare\LaraManager\Http\Controllers;

use Illuminate\Http\Request;
use Philsquare\LaraManager\Http\Requests\CreateUserRequest;
use Philsquare\LaraManager\Http\Requests\UpdateUserRequest;
use Philsquare\LaraManager\Models\User;

class UsersController extends Controller {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->all();

        return view('laramanager::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laramanager::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->user->create($request->except('password'));

        if($request->has('password')) $user->password = bcrypt($request->password);

        $user->save();

        return redirect('admin/users');
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
        $user = $this->user->findOrFail($id);

        return view('laramanager::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->update($request->except('password'));

        if($request->has('password')) $user->password = bcrypt($request->password);
        if(! $request->has('is_admin')) $user->is_admin = 0;

        $user->save();

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);

        if($user->delete()) return response()->json(['status' => 'ok']);

        return response()->json(['status' => 'failed']);
    }

}
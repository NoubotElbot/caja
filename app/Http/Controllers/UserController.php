<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('users.index', compact('users'))->with(['view' => 'usuarios']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Auth::user()->hasRole('Super Admin') ? Role::get() : Role::where('name', '!=', 'Super Admin')->get();
        return view('users.create', compact('roles'))->with(['view' => 'usuarios']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->syncRoles($request->role);

        return redirect()->route('usuarios.show', $user)->with([
            'alert' => [
                "type" => "success",
                "message" => "Usuario #$user->id creado con exito.",
                "icon" => "success"
            ],
            'view' => 'usuarios'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'))->with(['view' => 'usuarios']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Auth::user()->hasRole('Super Admin') ? Role::get() : Role::where('name', '!=', 'Super Admin')->get();
        return view('users.edit', compact('user', 'roles'))->with(['view' => 'usuarios']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user->syncRoles($request->role);

        $user->update($data);

        return redirect()->route('usuarios.show', $user)->with([
            'alert' => [
                "type" => "success",
                "message" => "Usuario #$user->id modificado con exito.",
                "icon" => "success"
            ],
            'view' => 'usuarios'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('usuarios.index')->with([
            'alert' => [
                "type" => "success",
                "message" => "Usuario #$user->id eliminado con exito.",
                "icon" => "success"
            ],
            'view' => 'usuarios'
        ]);
    }
}

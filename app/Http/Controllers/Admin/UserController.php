<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('logged-in')) {
            dd('no access allowed');
        }

        if (Gate::allows('is-admin')) {
            $users = User::paginate(5);

            return view('admin.users.index')
                ->with([
                    'users' => $users
                ]);
        }

        abort(403, 'Unauthorized action.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('is-admin')) {
            return view('admin.users.create', ['roles' => Role::all()]);
        }

        abort(403, 'Unauthorized action.');

    }

    public function createMobile()
    {
        // Fetch roles based on your predefined rules (e.g., roles with IDs 3 and 4)
        $allowedRoles = [3, 4];
        $roles = Role::whereIn('id', $allowedRoles)->get();

        return view('mobile.new-user.register', [
            'roles' => $roles,
        ]);
    }

    public function createWeb()
    {
        // Fetch roles based on your predefined rules (e.g., roles with IDs 3 and 4)
        $allowedRoles = [3, 4];
        $roles = Role::whereIn('id', $allowedRoles)->get();

        return view('desktop.register', [
            'roles' => $roles,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //dd($request);

        //$user = User::create($request->except(['_token', 'roles']));
        //$validate = $request->validated();
        //$user = User::create($validate);

        $newUser = new CreateNewUser();
        $user = $newUser->create($request->all());

        $user->roles()->sync($request->roles);

        Password::sendResetLink($request->only(['email']));

        $request->session()->flash('success', 'User berhasil dibuat');

        return redirect(route('admin.users.index'));
    }

    public function storeMobile(StoreUserRequest $request)
    {
        //dd($request);

        //$user = User::create($request->except(['_token', 'roles']));
        //$validate = $request->validated();
        //$user = User::create($validate);

        $newUser = new CreateNewUser();
        $user = $newUser->create($request->all());

        $user->roles()->sync($request->roles);

        //Password::sendResetLink($request->only(['email']));

        $request->session()->flash('success', 'User berhasil dibuat');

        return redirect(route('mobile-login'));
    }

    public function storeWeb(StoreUserRequest $request)
    {
        //dd($request);

        //$user = User::create($request->except(['_token', 'roles']));
        //$validate = $request->validated();
        //$user = User::create($validate);

        $newUser = new CreateNewUser();
        $user = $newUser->create($request->all());

        $user->roles()->sync($request->roles);

        //Password::sendResetLink($request->only(['email']));

        $request->session()->flash('success', 'User berhasil dibuat');

        return redirect(route('mobile-login'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // User not found
        }

        if (Gate::allows('is-admin')) {
            return view('admin.users.edit', [
                'roles' => Role::all(),
                'user' => $user
            ]);
        } elseif (Gate::allows('is-non-publik') || Gate::allows('is-publik')) {
            return view('mobile.auth.edit', [
                'user' => $user
            ]);
        }

        abort(403, 'Unauthorized action.');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $request->session()->flash('warning', 'Aksi tidak bisa dilakukan');
            return redirect(route('admin.users.index'));
        }

        $user->update($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);

        $request->session()->flash('success', 'Data User diupdate');

        return redirect(route('admin.users.index'));
    }

    public function updateMobile(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $request->session()->flash('warning', 'Aksi tidak bisa dilakukan');
            return redirect(route('mobile-profil'));
        }

        // Exclude password field from update
        $userData = $request->except('_token', 'password');

        // Update user's profile for non-admin users
        $user->update($userData);

        $request->session()->flash('success', 'Data User diupdate');
        return redirect(route('mobile-profil'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        User::destroy($id);

        $request->session()->flash('danger', 'User telah dihapus');

        return redirect(route('admin.users.index'));
    }
}

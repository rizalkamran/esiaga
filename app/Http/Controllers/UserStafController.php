<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class UserStafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('logged-in')) {
            $searchQuery = $request->input('search');
            $sortField = $request->input('sort_by', 'id'); // Default sort by ID
            $sortOrder = $request->input('sort_order', 'asc'); // Default sort order is ascending

            $query = User::query();

            if ($searchQuery) {
                $query->where('nama_lengkap', 'like', '%' . $searchQuery . '%');
            }

            // Apply sorting
            $query->orderBy($sortField, $sortOrder);

            $users = $query->with('roles')->paginate(10);

            return view('staf.users.index')
                ->with([
                    'users' => $users,
                    'searchQuery' => $searchQuery,
                    'sortField' => $sortField,
                    'sortOrder' => $sortOrder,
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
        if (Gate::allows('is-staf')) {
            $allowedRoles = [3, 4];
            $roles = Role::whereIn('id', $allowedRoles)->get();

            return view('staf.users.create', [
                'roles' => $roles,
            ]);

        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new CreateNewUser();
        $user = $newUser->create($request->all());

        $user->roles()->sync($request->roles);

        // Password::sendResetLink($request->only(['email']));

        $flashMessage = 'User berhasil dibuat,';
        $flashMessage .= "\nUsername: " . $request->input('name');
        $flashMessage .= "\nNama Lengkap: " . $request->input('nama_lengkap');

        $request->session()->flash('success', $flashMessage);

        return redirect(route('staf.biodata.create'));
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

        if (Gate::allows('is-staf')) {
            return view('staf.users.edit', [
                'roles' => Role::all(),
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
            return redirect(route('staf.users.index'));
        }

        $user->update($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);

        // Update password if provided
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        $request->session()->flash('success', 'Data User diupdate');

        return redirect(route('staf.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

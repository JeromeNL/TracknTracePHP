<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Webshop;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $allRoles = Role::all();
        $webshops = Webshop::all();
        return view('users.edit', compact('user'))->with(['userRoles' => $user->roles, 'roles' => $allRoles, 'webshops' => $webshops]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->roles()->sync($request->roles);
        $user->assignWebshop($request->webshop);

        flash("Gegevens van gebruiker $user->name succesvol aangepast!");

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash("Gebruiker $user->name succesvol verwijderd!");
        return redirect()->route('users.index');
    }
}

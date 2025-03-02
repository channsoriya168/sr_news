<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{

    // Query Only Admin
    public function showAdmin()
    {
        $perPage = request()->query('itemsPerPage', 5);
        $users = User::where('role', 'admin')->paginate($perPage)->appends(request()->query());

        return Inertia::render('Admin/User/Admin', [
            'users' => $users
        ]);
    }

    // Query Only Reader
    public function showReader()
    {
        $perPage = request()->query('itemsPerPage', 5);
        $users = User::where('role', 'reader')->paginate($perPage)->appends(request()->query());

        return Inertia::render('Admin/User/Reader', [
            'users' => $users
        ]);
    }

    // Query Only Author
    public function showAuthor()
    {
        $perPage = request()->query('itemsPerPage', 5);
        $users = User::where('role', 'author')->paginate($perPage)->appends(request()->query());

        return Inertia::render('Admin/User/Author', [
            'users' => $users
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request()->query('itemsPerPage', 5);
        $users = User::paginate($perPage)->appends(request()->query());

        return Inertia::render('Admin/User/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/User/Create', ['roles' => UserRole::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'email_verified_at' => $request->email_verified_at,
            ]);

            DB::commit();

            return redirect()->route('admin.user.index')->with('success', 'User created.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('admin.user.index')->with('error', 'User not created.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Inertia::render('Admin/User/Show',[
        'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/User/Edit', [
            'user' => $user,
            'roles' => UserRole::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();

        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            DB::commit();

            return redirect()->route('admin.user.index')->with('success', 'user updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.user.index')->with('error', 'user not updated.');
        }
    }

    //delete
    public function delete(User $user){
        return  Inertia::render('Admin/User/Delete', [
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();

        try {

            $user->delete();

            DB::commit();

            return redirect()->route('admin.user.index')->with('success', 'user deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.user.index')->with('error', 'user not deleted.');
        }
    }
}

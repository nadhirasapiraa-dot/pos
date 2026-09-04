<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\SearchRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request) 
    {
        $keyword = $request->input('search');

    $users = User::query()
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        })
        ->paginate(10)
        ->withQueryString();


        return view('users.index', compact('users'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
    
        return view('users.create' , compact('roles'));
    }

    public function store(StoreRequest $request)
    {
        $dataReq = $request->validated();

        $data['name'] = $dataReq['name'];
        $data['email'] = $dataReq['email'];
        $data['password'] = Hash::make($dataReq['password']);
        $data['role_id'] = $dataReq['role_id'];

        User::create($data);

        // proses memasukkan data ke tabel users
        return redirect()->route('admin.users')->with('success', 'User berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $dataReq = $request->validated();

        $user->name = $dataReq['name'];
        $user->email = $dataReq['email'];
        $user->role_id = $dataReq['role_id'];

        if (!empty($dataReq['password'])) {
            $user->password = Hash::make($dataReq['password']);
        }

        $user->save();

        return redirect()->route('admin.users', $user->id)->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $user = User::findOrFail($id);

    // Cek apakah user masih digunakan di tabel penjualan
    if ($user->penjualan()->exists()) {
        return redirect()
            ->route('admin.users')
            ->with('error', 'User tidak dapat dihapus karena masih digunakan pada data penjualan.');
    }

    $user->delete();

    return redirect()
        ->route('admin.users')
        ->with('success', 'User berhasil dihapus.');

    }
}

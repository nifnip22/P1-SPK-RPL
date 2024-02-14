<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PetugasController extends Controller
{
    public function index()
    {
        $users = User::where('level', 'Petugas')->get();

        return view('lib.petugas', [
            'title' => 'Data Petugas | LibraNest',
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'level' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
        ]);

        User::create([
            'name' => $request->name,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('petugas.index')->with('petugas_success', 'Petugas Berhasil di Register!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return redirect()->route('petugas.index')->with('deletePetugas_success', 'Petugas Berhasil di Hapus!');
        } else {
            return redirect()->route('petugas.index')->with('deletePetugas_error', 'Terjadi Kesalahan!');
        }
    }
}

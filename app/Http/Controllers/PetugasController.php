<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;

class PetugasController extends Controller
{
    public function index() {
        // SELECT * FROM petugas;
        $petugas = Petugas::all();

        return view('petugas', compact('petugas'));
    }

    public function store(Request $request) {
        $petugas = Petugas::create($request->all());
        // $petugas = Petugas::create([
        //     'username' => $request->username,
        //     'password' => md5($request->password),
        //     'nama_petugas' => $request->nama_petugas,
        //     'id_level' => $request->id_level,
        // ]);
        
        if ($petugas)
            $message = "Data petugas berhasil ditambahkan!";
        else
            $message = "Data petugas gagal ditambahkan!";

        return redirect()->route('petugas.index')->with('message', $message);
    }

    public function edit($id) {
        $petugas = Petugas::find($id);

        return view('petugas_edit', compact('petugas'));
    }

    public function update(Reqeust $request, $id) {
        $petugas = Petugas::find($id);
        $petugas->username = $request->username;
        if ($request->password != '')
            $petugas->password = md5($request->password);
        $petugas->nama_petugas = $request->nama_petugas;
        $petugas->id_level = $request->id_level;
        $petugas->save();
        
        if ($petugas)
            $message = "Data petugas berhasil diubah!";
        else
            $message = "Data petugas gagal diubah!";

        return redirect()->route('petugas.index')->with('message', $message);
    }

    public function delete($id) {
        $petugas = Petugas::find($id);
        $petugas->delete();

        if ($petugas)
            $message = "Data petugas berhasil dihapus!";
        else
            $message = "Data petugas gagal dihapus!";

        return redirect()->route('petugas.index')->with('message', $message);
    }
}

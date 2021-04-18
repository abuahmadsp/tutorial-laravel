<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers/index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // cara ke-1
        // $teacher = new Teacher;
        // $teacher->nama = $request->nama;
        // $teacher->nipy = $request->nipy;
        // $teacher->tugas = $request->tugas;
        // $teacher->mapel = $request->mapel;

        // $teacher->save();

        // cara <ke-2>
        // Teacher::create([
        //     'nama' => $request->nama,
        //     'nipy' => $request->nipy,
        //     'tugas' => $request->tugas,
        //     'mapel' => $request->mapel,
        // ]);

        $request->validate([
            'nama' => 'required',
            'nipy' => 'required|size:5',
            'tugas' => 'required',
            'mapel' => 'required'
        ]);

        // cara <ke-3>
        Teacher::create($request->all());

        return redirect('/teachers')->with('status', 'Data Guru Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return view('teachers/detail', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers/edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'nama' => 'required',
            'nipy' => 'required|size:5',
            'tugas' => 'required',
            'mapel' => 'required'
        ]);

        Teacher::where('id', $teacher->id)
            ->update([
                'nama' => $request->nama,
                'nipy' => $request->nipy,
                'tugas' => $request->tugas,
                'mapel' => $request->mapel
            ]);

        return redirect('/teachers')->with('status', 'Data Guru Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        Teacher::destroy($teacher->id);
        return redirect('/teachers')->with('status', 'Data Guru Berhasil Dihapus!');
    }
}

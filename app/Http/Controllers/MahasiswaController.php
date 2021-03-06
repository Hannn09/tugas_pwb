<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $students = DB::table('studentss') -> get();
        $students = Student::all();
        return view('mahasiswa.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'nisn' => 'required|size:10',
            'email' => 'required',
            'jurusan' => 'required',
            
        ]);

        Student::create($request->all());
        return redirect('/mahasiswa')->with('status', 'Data Added Successfully!');
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
        $student = Student::find($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nama' => 'required',
            'nisn' => 'required|size:10',
            'email' => 'required',
            'jurusan' => 'required',
            
        ]);

        Student::where('id', $student->id)
            ->update([
                'nama' => $request->nama,
                'nisn' => $request->nisn,
                'email' => $request->email,
                'jurusan' => $request->jurusan
            ]);

            return redirect('/mahasiswa')->with('status', 'Data Edited Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Student::find($id)->delete();
        return redirect('/mahasiswa')->with('status', 'Data Deleted Successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Branch;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('branch')->get();
        return view('students.index')->with(['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('students.studentForm')->with(['branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = new Student;
        $student->name =  $request->input('name');
        $student->gender =  $request->input('gender');
        $student->address =  $request->input('address');
        $student->birthDate =  $request->input('birthDate');
        $student->bacGrade =  $request->input('bacGrade');
        $student->idBranch =  $request->input('idBranch');
        $student->save();
        return redirect()->route('students');
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
    public function edit($id)
    {
        $student = Student::find($id);
        $branches = Branch::all();
        return view('students.edit')->with(['student'=>$student, 'branches' => $branches]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id =  $request->input('studentId');
        $student = Student::find($id);
        $student->name =  $request->input('fullName');
        $student->gender =  $request->input('gender');
        $student->address =  $request->input('address');
        $student->birthDate =  $request->input('dob');
        $student->bacGrade =  $request->input('bacGrade');
        $student->idBranch =  $request->input('idBranch');
        $student->save();
        return redirect()->route('students');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('students');
    }
        /**
     * Remove the specified resource from storage.
     */
    public function search(Request $request)
    {
        //echo $request->input();
        //name, ID, or address
        $students = 
        Student::with('branch')
        ->where('name','like',"%".$request->input('searchInput')."%")
        ->orWhere('address','like',"%".$request->input('searchInput')."%")
        ->orWhere('id','=',$request->input('searchInput'))
        ->get();
        //dd($students);
        return view('students.index')->with(['students'=>$students]);
    }
}




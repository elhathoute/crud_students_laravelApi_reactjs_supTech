<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class ApiStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //all
        return ['students'=>StudentResource::collection(Student::all())];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //add
        $validated = $request->validate([
            'name'=> 'required|string|min:2',
            'gender'=> 'required|string|in:M,F',
            'address'=> 'required',
            'birthDate' => 'required|date',
            'bacGrade'=> 'required|numeric|between:0,20',
            'idBranch'=> 'required|int',
            'photo' => 'required|mimes:jpeg,jpg,png|max:10024'
        ]);

        $photo = $request->file('photo');

        $photoName= uniqid().".".$photo->getClientOriginalExtension();
        $photo->move(public_path('pictures/') , $photoName); 
        $validated['photo'] =  $photoName;
        
        Student::create($validated);
        print_r($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //one
        $student = Student::find($id);
        return ['student' => StudentResource::make($student)];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete
        $student = Student::find($id);
        $student->delete();
        return response()->json(['delete'=>true, 'code'=>200]);
    }
}

<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
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

        $photoName = uniqid().".".$photo->getClientOriginalExtension();
        $photo->move(public_path('pictures/'), $photoName);
        $validated['image'] = $photoName;
        unset($validated['photo']);
        $student = Student::create($validated);
        return response()->json(['student' => StudentResource::make($student)], 201);
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
        $student = Student::findOrFail($id);
        $rules = [
            'name' => 'required|string|min:2',
            'gender' => 'required|string|in:M,F',
            'address' => 'required',
            'birthDate' => 'required|date',
            'bacGrade' => 'required|numeric|between:0,20',
            'idBranch' => 'required|integer',
            'photo' => 'nullable|mimes:jpeg,jpg,png|max:10024'
        ];
        $validated = $request->validate($rules);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('pictures/'), $photoName);
            $validated['image'] = $photoName;
        }
        unset($validated['photo']);
        $student->update($validated);
        return response()->json(['student' => StudentResource::make($student->fresh())]);
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

    public function generatePdf(string $id)
    {
        $student = Student::with('branch')->findOrFail($id);
        $photoPath = $student->image
            ? public_path('pictures/' . $student->image)
            : public_path('images/no-photo.jpg');
        $pdf = Pdf::loadView('pdf.student', ['student' => $student, 'photoPath' => $photoPath]);
        return $pdf->download('student-' . $id . '.pdf');
    }
}

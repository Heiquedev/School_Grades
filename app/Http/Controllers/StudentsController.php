<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Students::all();
        return response()->json([
            'success' => true,
            'msg' => 'Students listed successfully',
            'studentsCount' => $students->count(),
            'students' => $students
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'year' => 'required|string',
                    'first_trimester' => 'required|integer',
                    'second_trimester' => 'required|integer',
                    'third_trimester' => 'required|integer',
                ],
                [
                    'name.required' => 'Name is required',
                    'year.required' => 'Year is required',
                    'first_trimester.required' => 'Grades mathematics is required',
                    'second_trimester.required' => 'Grades english is required',
                    'third_trimester.required' => 'Grades history is required'
                ]
            );

            $students = Students::create($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while crate the student',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Student created with successfully',
            'data' => $students
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'year' => 'required|string',
                    'first_trimester' => 'required|integer',
                    'second_trimester' => 'required|integer',
                    'third_trimester' => 'required|integer',
                ],
                [
                    'name.required' => 'Name is required',
                    'year.required' => 'Year is required',
                    'first_trimester.required' => 'Grades mathematics is required',
                    'second_trimester.required' => 'Grades english is required',
                    'third_trimester.required' => 'Grades history is required'
                ]
            );

            $student = Students::findOrFail($id);
            $student->update($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while updating student',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => "Student from $student->id updated successfully",
            'data' => $student
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { {
            try {
                $student = Students::findOrFail($id);
                $student->delete();
                return response()->json([
                    'success' => true,
                    'msg' => "student $student->name deleted successfully"
                ], 200);
            } catch (\Exception $error) {
                return response()->json([
                    'success' => false,
                    'msg' => "Failed to delete student",
                    'error' => $error->getMessage()
                ], 500);
            }
        }
    }
}

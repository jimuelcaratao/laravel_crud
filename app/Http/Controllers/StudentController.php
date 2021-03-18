<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = DB::table('students')
            ->get();

        $studentsModel = Student::get();

        return view('students', [
            "students" => $students,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $new_student = new Student;
        // $new_student->first_name = $request->input('inputFirstName');
        // $new_student->save();


        DB::table('students')->insert([
            'first_name' => $request->input('inputFirstName'),
            'last_name' => $request->input('inputLastName'),
            'section' => $request->input('inputSection'),
        ]);

        return redirect('students');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        DB::table('students')
            ->where('student_id', 1)
            ->update([
                'first_name' => $request->input('editFirstName'),
                'last_name' => $request->input('editLastName'),
                'section' => $request->input('editSection'),
            ]);

        return redirect('students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        DB::table('students')->where('student_id', '=', $student_id)->delete();

        return redirect('students');
    }
}

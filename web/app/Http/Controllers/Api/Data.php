<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dorm;
use App\Models\Shift;
use App\Models\Student;
use App\Models\SignHistory;
use App\Models\SignDormRemark;

class Data extends Controller
{
    public function dorms()
    {
        return Dorm::select('id', 'name')->sort()->get();
    }

    public function shift()
    {
        return Shift::select('id', 'name')->sort()->get();
    }

    public function lists(Request $request)
    {
        $request->validate([
           'date' => 'required|date',
           'shift_id' => 'required',
        ]);

        $date = $request->input('date');
        $shift_id = $request->input('shift_id');

        $historys = SignHistory::where([
            'date' => $date,
            'shift_id' => $shift_id,
        ])->pluck('status', 'student_id');

        $bodys = SignDormRemark::where([
            'date' => $date,
            'shift_id' => $shift_id,
        ])->pluck('body', 'dorm_id');

        $data = Dorm::select('id', 'name', 'remark')->with('Student')->sort()->get();

        $dorms = [];
        foreach ($data as $info) {
            $dorm_id = $info->id;

            $students = [];
            foreach ($info->Student as $student) {
                $student_id = $student->id;
                $students[$student_id] = [
                    'student_id' => $student_id,
                    'dorm_id' => $dorm_id,
                    'bed_name' => $student->bed_name,
                    'name' => $student->name,
                    'phone' => $student->phone,
                    'parent_type' => $student->parent_type,
                    'parent_phone' => $student->parent_phone,
                    'remark' => $student->remark,
                    'status' => $historys[$student_id] ?? false,
                    'loading' => false,
                ];
            }

            $dorms[$dorm_id] = [
                'dorm_id' => $dorm_id,
                'name' => $info->name,
                'remark' => $info->remark,
                'students' => $students,
                'body' => $bodys[$dorm_id] ?? null,
            ];
        }

        return $dorms;
    }

    public function sign(Request $request)
    {
        $request->validate([
           'date' => 'required|date',
           'dorm_id' => 'required',
           'student_id' => 'required',
           'shift_id' => 'required',
        ]);

        SignHistory::updateOrCreate([
            'school_id' => 1,
            'user_id' => 1,
            'date' => $request->input('date'),
            'dorm_id' => $request->input('dorm_id'),
            'student_id' => $request->input('student_id'),
            'shift_id' => $request->input('shift_id'),
        ], [
            'status' => $request->input('status'),
        ]);
    }

    public function remark(Request $request)
    {
        $request->validate([
           'date' => 'required|date',
           'dorm_id' => 'required',
           'shift_id' => 'required',
        ]);

        SignDormRemark::updateOrCreate([
            'school_id' => 1,
            'user_id' => 1,
            'date' => $request->input('date'),
            'dorm_id' => $request->input('dorm_id'),
            'shift_id' => $request->input('shift_id'),
        ], [
            'body' => $request->input('body'),
        ]);
    }
}


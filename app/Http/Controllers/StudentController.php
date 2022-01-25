<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreStudentRequest;
use App\Imports\StudentsImport;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('students.index');
        dd(session('success'));
    } // end of index

    public function data()
    {
        $students = Student::orderBy('first_name');

        return DataTables::of($students)
            ->addColumn('record_select', 'admin.roles.data_table.record_select')
            ->editColumn('created_at', function (Student $student) {
                return $student->created_at;
            })
            ->toJson();
    } // end of data

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    function importData(Request $request)
    {
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('uploaded_file');
        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(1, $row_limit);
            $column_range = range('F', $column_limit);
            $startcount = 2;
            $data = array();

            foreach ($row_range as $row) {
                if (
                    empty($sheet->getCell('A' . $row)->getValue())
                    || empty($sheet->getCell('B' . $row)->getValue())
                    || empty($sheet->getCell('C' . $row)->getValue())
                    || empty($sheet->getCell('D' . $row)->getValue())
                    || empty($sheet->getCell('E' . $row)->getValue())
                    || Student::whereEmail($sheet->getCell('E' . $row)->getValue())->exists()
                )
                    continue;
                $data[] = [
                    'first_name' => $sheet->getCell('A' . $row)->getValue(),
                    'second_name' => $sheet->getCell('B' . $row)->getValue(),
                    'third_name' => $sheet->getCell('C' . $row)->getValue(),
                    'last_name' => $sheet->getCell('D' . $row)->getValue(),
                    'email' => $sheet->getCell('E' . $row)->getValue(),
                    'created_at'=>now()
                ];
                $startcount++;
            }
            //dd($data);
           Student::insert($data);
        } catch (Exception $e) {
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('Great! Data has been successfully uploaded.' .$startcount);
    }
    public function import()
    {
        Excel::import(new StudentsImport, request()->file('file'));

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();
        Student::create($data);

        return redirect(route('students.index'))->with('success', 'Added Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}

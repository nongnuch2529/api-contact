<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //อ่านข้อมูลแบบ แบ่งหน้า
        // return Employee::orderBy('id','dec')->pageinate(25); 

        //Read all Contact Employees
        $Employees = Employee::all();               
        return response()->json([
                'message' => $Employees               
                
            ] ,200 );             
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Edit Contact Employee
       $request->validate([
            'id_emp'        =>  ['required', 'unique:employees','string','min:8'],
            'name_th'       =>  ['required', 'string'],
            'name_en'       =>  ['required', 'string'],
            'nickname'      =>  ['nullable', 'string'],
            'ipphone'       =>  ['nullable', 'string'],
            'mobile'        =>  ['required', 'string'],
            'email'         =>  ['required', 'unique:employees','email'],
            'position'      =>  ['required', 'string'],
            'team'          =>  ['required', 'string'],
            'department'    =>  ['required', 'string'],
            'group'         =>  ['nullable', 'string'],
            'location'      =>  ['nullable', 'string'],
            
        ]);

        $Employees =  Employee::create($request->all());        

        return response()->json([
                'message' => 'Create successfully',
                'Contact Employee' => $Employees 
            ] ,200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // show Contact Employee
        return Employee::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //Update Contact Employee
         $Employees = Employee::find($id);
         $Employees->update($request->all());

         return response()->json([
                'message' => 'Updated Successfully!',
                'Contact Employee' => $Employees 
         ],200);
    }
          
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Contact Employee
        $Employees = Employee::find($id);
        $Employees->delete();

        return response()->json([
                'message' => 'Delete Successfully!',
                'Contact Employee' => $Employees
        ]);
    }

    /**
     * Select Team form Employees.
     *
     * @param  string  $team
     * @return \Illuminate\Http\Response
     */
    public function search($team)
    {
        $team = Employee::where('team' , 'like' , '%'.$team.'%')->get();
        return response()->json([
            'message' => 'Select Team Successfully!',
            'Contact Team Employee' => $team
        ], 200);       
    }
}

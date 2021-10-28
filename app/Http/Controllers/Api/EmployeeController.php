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
        // $Employees = Employee::orderBy('id','desc')->paginate(4);
        $Employees = Employee::orderBy('updated_at','desc')->paginate(12);
        
        // $Employees = Employee::orderBy('id','dec')->pageinate(2);
        return response()->json($Employees ,200);
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
    public function search($keyword)
    {
        $keyword = Employee::where('name_th' , 'like' , '%'.$keyword.'%')
                             ->orWhere('name_en' , 'like' , '%'.$keyword.'%' )
                             ->orWhere('nickname' , 'like' , '%'.$keyword.'%' )
                             ->orWhere('ipphone' , 'like' , '%'.$keyword.'%' )
                             ->orWhere('mobile' , 'like' , '%'.$keyword.'%' )
                            //  ->orWhere('email ' , 'like' , '%'.$keyword.'%' )
                             ->orWhere('position' , 'like' , '%'.$keyword.'%' )
                             ->orWhere('team' , 'like' , '%'.$keyword.'%' )
                             ->orWhere('department' , 'like' , '%'.$keyword.'%' )
                             ->orWhere('group' , 'like' , '%'.$keyword.'%' )
                             ->orWhere('location' , 'like' , '%'.$keyword.'%' )
                             ->orderBy('updated_at','desc')
                             ->paginate(12);
        return response()->json($keyword,200);   
            
    }

    // ------------------------------------------------------------------------------
    // ----------------------- API ข้อมูลพนักงาน NMC ----------------------------------               
    // ------------------------------------------------------------------------------

    public function getnmc()
    {
        
            $nmcs = Employee::where('team' , '=' , 'Network Management Center')
                              ->orderBy('id','desc')->paginate(8);
            return response()->json($nmcs,200); 
    }

    public function getTeanNmc($shift)
    {        
            $nmc_team = Employee::where('group' , 'like' , $shift)
                              ->orderBy('id','desc')->paginate(8);
            return response()->json($nmc_team,200); 
    }


    // ------------------------------------------------------------------------------
    // ----------------------- API ข้อมูลพนักงาน O&M ----------------------------------               
    // ------------------------------------------------------------------------------

    public function getOM()
    {
        
            $nmcs = Employee::where('team' , '=' , 'Operation&Maintenance Center')
                              ->orderBy('id','desc')->paginate(8);
            return response()->json($nmcs,200); 
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Response;
use App\Models\Employee;
use App\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $getEmployees = Employee::orderBy('id', 'DESC')->get();
             $roles = Role::pluck('name','id')->all();
            $data=compact('getEmployees','roles');
                

       return view('employee.index',$data);
        //
    }

    public function saveEmploy(Request $request){

       $rule= array
        (
            'name' =>'required' , 
            'email'=>'required|email|unique:employees',
            'phone'=>'required|digits:10|numeric',
            'description'=>'required',
            'roles'=>'required',
            'image'=>'required|mimes:jpeg,png|image|max:5120',
        );
        $Validator=Validator::make($request->all(),$rule);
            if($Validator->fails())
            {
                return response()->json([
                    'status'=>400,
                    'error'=>$Validator->messages()
                ]);
            }else{

                $employee=new Employee;
                $employee->name=$request->name;
                $employee->email=$request->email;
                $employee->phone=$request->phone;
                $employee->description=$request->description;
                $employee->role_id=$request->roles[0];
                if ($request->hasFile('image')) {
                     $dir = public_path() . '/uploads/profile-image/';
                     $image     = time() . '.' . $request->image->getClientOriginalExtension();
                     $uploadImg = $request->file('image')->move($dir, $image);
                     $employee->profile_image = $image;

                }



                $save=$employee->save();

                $getEmployees = Employee::orderBy('id', 'DESC')->get();
                 $data=compact('getEmployees');
                 $bladeView=view("employee.employee_list",$data)->render();

                return response()->json([
                            'status'=>200,
                            'bladeview' => $bladeView,
                            
                        ]);

            }

     }
}

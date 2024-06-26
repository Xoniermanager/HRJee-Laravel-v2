<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PermissionsServices;
use App\Http\Services\RolesServices;

class AssignPermissionController extends Controller
{
    private $rolesServices;
    private $permissionServices ; 
    public function __construct(RolesServices $rolesServices , PermissionsServices $permissionServices )
    {
            $this->rolesServices = $rolesServices;
            $this->permissionServices = $permissionServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.roles_and_permission.assign_permission.index',[
            'roles' => $this->rolesServices->all() ,
            'permissions' => $this->permissionServices->all()
        ]);
    }

//     public function role_form()
//     {
//         return view('company.roles_and_permission.create-roles-form');
//     }
//     public function store(Request $request)
//     {

//         try {
//             $validator  = Validator::make($request->all(), [
//                 'name' => ['required', 'string', 'unique:roles,name'],
//             ]);
//             if ($validator->fails()) {
//                 return response()->json(['error' => $validator->messages()], 400);
//             }
//             $data = $request->all();
//             if ($this->rolesServices->create($data)) {
//                 return response()->json([
//                     'message' => 'Role Created Successfully!',
//                     'data'   =>  view('company/roles_and_permission/roles/roles_list', [
//                         'roles' => $this->rolesServices->all()
//                     ])->render()
//                 ]);
//             }
//         } catch (Exception $e) {
//             return response()->json(['error' =>  $e->getMessage()], 400);
//         }
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function update(Request $request)
//     {
//         $validator  = Validator::make($request->all(), [
//             'name' => ['required', 'string', new OnlyString, 'unique:states,name,' . $request->id],
//         ]);

//         if ($validator->fails()) {
//             return response()->json(['error' => $validator->messages()], 400);
//         }
//         $updateRole = $request->except(['_token', 'id']);
//         $companyStatus = $this->rolesServices->updateDetails($updateRole, $request->id);
//         if ($companyStatus) {
//             return response()->json(
//                 [
//                     'message' => 'Role Updated Successfully!',
//                     'data'   =>  view('company/roles_and_permission/roles/roles_list', [
//                         'roles' => $this->rolesServices->all()
//                     ])->render()
//                 ]
//             );
//         }
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Request $request)
//     {
//         $id = $request->id;
//         $data = $this->rolesServices->deleteDetails($id);
//         if ($data) {
//             return response()->json([
//                 'message' => 'Role Deleted Successfully!',
//                 'data'   =>  view('company/roles_and_permission/roles/roles_list', [
//                     'roles' => $this->rolesServices->all()
//                 ])->render()
//             ]);
//         } else {
//             return response()->json(['error' => 'Something Went Wrong!! Please try again']);
//         }
//     }
// }
}

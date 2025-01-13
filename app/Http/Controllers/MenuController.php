<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateMenu;


use App\Http\Services\MenuService;

class MenuController extends Controller
{
    //
    private $menuServices;
    public function __construct(MenuService $menuServices)
    {
        $this->menuServices = $menuServices;
    }

    public function index()
    {
        return view('admin.menu.index', [
            'allMenuDetails' => $this->menuServices->all()
        ]);
    }

    public function add_menu()
    {
        
        return view('admin.menu.add-menu',data:['allParentMenu'=>$this->menuServices->allParentMenu()]);
    }

    public function edit_menu(Request $request)
    {
        $menuDetails = $this->menuServices->getMenuById($request->id);
        return view('admin.menu.edit-menu', ['menuDetails' => $menuDetails,'allParentMenu'=>$this->menuServices->allParentMenu()]);
    }

    public function save_menu(Request $request, ValidateMenu $validateMenu){
        $validated = $validateMenu->validated();

        $validated['icon'] =  $request->icon;
        $validated['order_no'] =  $request->order_no;
        $validated['parent_id'] =  $request->parent_id;

        $this->menuServices->create($validated);
        return redirect(route('admin.menu'))->with('success','Menu Created Succesfully');
    }
    public function update_menu(Request $request){
       
        $validated = $request->validate([
            'title' => 'required|unique:menus,title,' . $request->id . '|max:255',
            'slug' => 'required|string|max:255'
        ]);

        $validated['icon'] =  $request->icon;
        $validated['order_no'] =  $request->order_no;
        $validated['parent_id'] =  $request->parent_id??NULL;

        $this->menuServices->updateDetails($validated,$request->id);
        return redirect(route('admin.menu'))->with('success','Menu Updated Succesfully');
    }

   
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->menuServices->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Menu Deleted Successfully',
                'data'   =>  view("admin.menu.menu-list", [
                    'allMenuDetails' => $this->menuServices->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->menuServices->searchMenu($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("admin.menu.menu-list", [
                    'allMenuDetails' =>  $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->menuServices->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Menu Status Updated Successfully',
                'data'   =>  view("admin.menu.menu-list", [
                    'allMenuDetails' => $this->menuServices->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}

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
        $menus = $this->menuServices->all();

        $menus->getCollection()->transform(function ($menu) use (&$orderCounts) {
            $orderNo = $menu->order_no;
        
            if (!isset($orderCounts[$orderNo])) {
                $orderCounts[$orderNo] = 0;
                // Use dynamic property for non-persistent attribute
                $menu->order_no_label = (string) $orderNo;
            } else {
                $orderCounts[$orderNo]++;
                // Set dynamic property again
                $menu->order_no_label = $orderNo . ' (' . $orderCounts[$orderNo] . ')';
            }
        
            return $menu;
        });

        return view('admin.menu.index', [
            'allMenuDetails' => $menus
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

    public function save_menu(ValidateMenu $validateMenu){
        $validated = $validateMenu->validated();
        $validated['slug'] = '/' . ltrim($validated["slug"], '/');
        $this->menuServices->create($validated);
        return redirect(route('admin.menu'))->with('success','Menu Created Succesfully');
    }
    
    public function update_menu(Request $request,$menuId)
    {
        $validated = $request->validate([
            'title' => 'required|unique:menus,title,' . $request->id . '|max:255',
            'slug' => 'required|string|max:255',
            'order_no' => 'required|integer',
            'parent_id' => 'nullable|sometimes|exists:menus,id',
            'icon'     => 'required'
        ]);
        $validated['slug'] = '/' . ltrim($validated["slug"], '/');
        $this->menuServices->updateDetails($validated,$menuId);
        return redirect(route('admin.menu'))->with('success','Menu Updated Succesfully');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->menuServices->deleteDetails($id);
        if ($data['success'] == true) {
            return response()->json([
                'success' => 'Menu Deleted Successfully',
                'data'   =>  view("admin.menu.menu-list", [
                    'allMenuDetails' => $this->menuServices->all()
                ])->render()
            ]);
        } elseif($data['success'] == false) {
            return response()->json(['error' => $data['message']]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->menuServices->searchMenu($request->all());

        $searchedItems->getCollection()->transform(function ($menu) use (&$orderCounts) {
            $orderNo = $menu->order_no;
        
            if (!isset($orderCounts[$orderNo])) {
                $orderCounts[$orderNo] = 0;
                // Use dynamic property for non-persistent attribute
                $menu->order_no_label = (string) $orderNo;
            } else {
                $orderCounts[$orderNo]++;
                // Set dynamic property again
                $menu->order_no_label = $orderNo . ' (' . $orderCounts[$orderNo] . ')';
            }
        
            return $menu;
        });

        // dd($searchedItems);
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

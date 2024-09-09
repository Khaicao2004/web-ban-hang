<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WareHouse;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    const PATH_VIEW = 'admin.wareHouses.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = WareHouse::query()->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        WareHouse::query()->create($request->all());
       return redirect()->route('admin.wareHouses.index')->with('success', 'Thêm thuộc tính thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(WareHouse $wareHouse)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('wareHouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WareHouse $wareHouse)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('wareHouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WareHouse $wareHouse)
    {
        $wareHouse->update($request->all());
        return back()->with('success', 'Cập nhật thuộc tính thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WareHouse $wareHouse)
    {
        $wareHouse->delete();
        return back()->with('success', 'Xóa thuộc tính thành công');
    }
}

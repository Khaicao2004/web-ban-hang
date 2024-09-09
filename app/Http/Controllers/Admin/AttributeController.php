<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    const PATH_VIEW = 'admin.attributes.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = Attribute::query()->latest('id')->get();
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
       Attribute::query()->create($request->all());
       return redirect()->route('admin.attributes.index')->with('success', 'Thêm thuộc tính thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $attribute->update($request->all());
        return back()->with('success', 'Cập nhật thuộc tính thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return back()->with('success', 'Xóa thuộc tính thành công');
    }
}

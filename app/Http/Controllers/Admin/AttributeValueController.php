<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttributeValueController extends Controller
{
    const PATH_VIEW = 'admin.values.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AttributeValue::query()->with('attribute')->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = Attribute::query()->pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            AttributeValue::query()->create($request->all());
            return redirect()->route('admin.values.index')->with('success', 'Thêm giá trị thuộc tính thành công');
        } catch (\Exception $exception) {
            Log::error('Lỗi thêm giá trị thuộc tính ' . $exception->getMessage());
            return back()->with('error', 'Lỗi thêm giá trị thuộc tính');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AttributeValue $value)
    {
        $attributes = Attribute::query()->pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes', 'value'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttributeValue $value)
    {
        $attributes = Attribute::query()->pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes', 'value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttributeValue $value)
    {
        try {
            $value->update($request->all());
            return back()->with('success', 'Cập nhật giá trị thuộc tính thành công');
        } catch (\Exception $exception) {
            Log::error('Lỗi cập nhật giá trị thuộc tính ' . $exception->getMessage());
            return back()->with('error', 'Lỗi cập nhật giá trị thuộc tính');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeValue $value)
    {
        $value->delete();
        return back();
    }
}

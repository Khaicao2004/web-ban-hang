<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    const PATH_VIEW = 'admin.Tags.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = Tag::query()->latest('id')->get();
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
        Tag::query()->create($request->all());
       return redirect()->route('admin.tags.index')->with('success', 'Thêm thuộc tính thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->all());
        return back()->with('success', 'Cập nhật thuộc tính thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $Tag)
    {
        $Tag->delete();
        return back()->with('success', 'Xóa thuộc tính thành công');
    }
}

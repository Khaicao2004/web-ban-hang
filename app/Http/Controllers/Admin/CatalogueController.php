<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CatalogueController extends Controller
{
    const PATH_VIEW = 'admin.catalogues.';
    const PATH_UPLOAD = 'catalogues';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Catalogue::query()->latest()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCatalogues = Catalogue::query()->with(['children'])->whereNull('parent_id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('parentCatalogues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('image');
            $data['is_active'] = isset($data['is_active']) ? 1 : 0;
            $data['slug'] = Str::slug($request->name);
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            Catalogue::query()->create($data);
            return redirect()
                ->route('admin.catalogues.index')
                ->with('success', 'Thêm thành công');
        } catch (\Exception $exception) {
            Log::error('Lỗi thêm danh mục ' . $exception->getMessage());
            return back()->with('error', 'Lỗi thêm danh mục');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalogue $catalogue)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('catalogue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalogue $catalogue)
    {
        $parentCatalogues = Catalogue::query()->with(['children'])->whereNull('parent_id')->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('catalogue', 'parentCatalogues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catalogue $catalogue)
    {
        try {
            $data = $request->except('image');
            $data['is_active'] = isset($data['is_active']) ? 1 : 0;
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            $currentImage = $catalogue->image;
            $catalogue->update($data);
            if ($currentImage && Storage::exists($currentImage)) {
                Storage::delete($currentImage);
            }
            return back()
                ->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            Log::error('Lỗi cập nhật danh mục ' . $exception->getMessage());
            return back()->with('error', 'Lỗi cập nhật danh mục');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalogue $catalogue)
    {
        try {
            $parentId = $catalogue->parent_id;
            Catalogue::where('parent_id', $catalogue->id)->update(['parent_id' => $parentId]);
            $catalogue->delete();
            if (Storage::exists($catalogue->image)) {
                Storage::delete($catalogue->image);
            }
            return back()->with('success', 'Xóa danh mục thành công');
        } catch (\Exception $exception) {
            Log::error('Lỗi xóa danh mục' . $exception->getMessage());
            return back()->with('error', 'Lỗi xóa danh mục');
        }
    }
}

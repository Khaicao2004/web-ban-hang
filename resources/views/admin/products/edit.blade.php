@extends('admin.layouts.master')

@section('title')
    Cập nhật sản phẩm {{ $product->name }}
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- end page title -->
    <form action="{{ route('admin.products.update', $product) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin sản phẩm: {{ $product->name }}</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $product->name }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price Regular</label>
                                        <input type="number" class="form-control" id="price_regular" name="price_regular"
                                            value="{{ $product->price_regular }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price Sale</label>
                                        <input type="number" class="form-control" id="price_sale" name="price_sale"
                                            value="{{ $product->price_sale }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="catalogue_id" class="form-label">Catelogues</label>
                                        <select name="catalogue_id" id="catalogue_id" class="form-select">
                                            <option value="">--Chọn danh mục--</option>
                                            @foreach ($catalogues as $id => $name)
                                                <option value="{{ $id }}"
                                                    @if ($product->catalogue_id == $id) selected @endif>{{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="ware_house_id" class="form-label">Ware House</label>
                                        <select name="ware_house_id" id="ware_house_id" class="form-select">
                                            <option value="">--Chọn kho--</option>
                                            @foreach ($wareHouses as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control mb-3" id="image" name="image">
                                        @php
                                            $url = $product->image;
                                            if (!Str::contains($url, 'http')) {
                                                $url = Storage::url($url);
                                            }
                                        @endphp

                                        <img src="{{ $url }}" alt="" width="100px">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-primary">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_active" id="is_active"
                                                    @if ($product->is_active == true) checked @endif>
                                                <label class="form-check-label" for="is_active">Is Active</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-warning">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_hot_deal" id="is_hot_deal"
                                                    @if ($product->is_hot_deal == true) checked @endif>
                                                <label class="form-check-label" for="is_hot_deal">Is Hot Deal</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-danger">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_new" id="is_new"
                                                    @if ($product->is_new == true) checked @endif>
                                                <label class="form-check-label" for="is_new">Is New</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-dark">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_sale" id="is_sale"
                                                    @if ($product->is_sale == true) checked @endif>
                                                <label class="form-check-label" for="is_sale">Is Sale</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check form-switch form-switch-info">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_show_home" id="is_show_home"
                                                    @if ($product->is_show_home == true) checked @endif>
                                                <label class="form-check-label" for="is_show_home">Is Show Home</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="2">{{ $product->description }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="material" class="form-label">Material</label>
                                            <textarea class="form-control" name="material" id="material" rows="2">{{ $product->material }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="user_manual" class="form-label">User Manual</label>
                                            <textarea class="form-control" name="user_manual" id="user_manual" rows="2">{{ $product->user_manual }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" name="content" id="content">{{ $product->content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin biến thể</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div id="variant-container">
                                    <!-- Biến thể mặc định -->
                                    <div class="row mb-3 variant-row" data-index="0">
                                        <div class="col-md-3">
                                            <label for="attribute_id" class="form-label">Thuộc tính</label>
                                            <select name="variants[0][attributes][]" class="form-select select2">
                                                <option value="">Chọn thuộc tính</option>
                                                @foreach ($attributes as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="attribute_value_id" class="form-label">Giá trị</label>
                                            <select name="variants[0][attribute_values][]" class="form-select select2">
                                                <option value="">Chọn giá trị</option>
                                                @foreach ($attributeValues as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="quantity" class="form-label">Số lượng</label>
                                            <input type="number" name="variants[0][quantity]" class="form-control">
                                        </div>

                                        <div class="col-md-2">
                                            <label for="price" class="form-label">Giá</label>
                                            <input type="number" name="variants[0][price]" class="form-control">
                                        </div>

                                        <div class="col-md-2">
                                            <label for="image" class="form-label">Ảnh</label>
                                            <input type="file" name="variants[0][image]" class="form-control">
                                        </div>

                                        <div class="col-md-1 d-flex align-items-end mt-1">
                                            <button type="button" class="btn btn-danger btn-remove-variant">Xóa</button>
                                        </div>

                                        <!-- Khu vực thuộc tính -->
                                        <div class="col-md-12 attributes-container mt-2">
                                            <!-- Thuộc tính mặc định sẽ được thêm vào đây -->
                                        </div>

                                        <!-- Nút thêm thuộc tính -->
                                        <div class="col-md-12 mt-2">
                                            <button type="button" class="btn btn-primary btn-add-attribute">Thêm thuộc
                                                tính</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <button type="button" id="btn-add-variant" class="btn btn-success">Thêm biến
                                        thể</button>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="gallery_1" class="form-label">Gallery</label>
                                        <input type="file" class="form-control" name="product_galleries[]" multiple>
                                        
                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                            <div class="row">
                                @foreach ($galleries as $gallery)
                                    @php
                                        $url = $gallery->image;
                                        if (!Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp

                                    <div class="col-3 mt-2 gallery-item" id="gallery-{{ $gallery->id }}">
                                        <img src="{{ $url }}" alt="" width="100px" class="mb-2">
                                        <button type="button" class="btn btn-danger delete-gallery" data-id="{{ $gallery->id }}">Xóa</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tags</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div>
                                        <label for="tags" class="form-label">Tags </label>
                                        <select name="tags[]" id="tags" class="form-control select2" multiple>
                                            @foreach ($tags as $id => $name)
                                                <option value="{{ $id }}"
                                                    @if ($product->tags->contains($id)) selected @endif>{{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!--end row-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div><!-- end card header -->
                </div>
            </div>
        </div>
    </form>
@endsection
@section('style-libs')
    <!-- CSS của Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/library/main.css">
@endsection
@section('script-libs')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script src="/library/main.js"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('content');
        const attributes = @json($attributes);
        const attributeValues = @json($attributeValues);
        $(document).ready(function() {
            $(".select2").select2({
                allowClear: true,
                dropdownAutoWidth: true
            });
        });
    </script>
@endsection

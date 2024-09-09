@extends('admin.layouts.master')

@section('title')
    Thêm mới danh mục sản phẩm
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.catalogues.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thêm mới danh mục</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-6">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control mb-2" id="name" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="parent_id" class="form-label">Đơn vị tính cha</label>
                                    <select class="js-example-basic-single form-control" name="parent_id" id="parent_id">
                                        <option value="" selected>Trống</option>

                                        @foreach ($parentCatalogues as $parent)
                                            @php($each = ' ')
                                            @include('admin.catalogues.nested-catalogue', [
                                                'catalogue' => $parent,
                                            ])
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="image">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-switch form-switch-primary">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                            id="is_active" checked>
                                        <label class="form-check-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label><br>
                                    <textarea name="description" id="description" class="form-control"></textarea>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div><!-- end card header -->
                </div>
            </div>
            <!--end col-->
        </div>
    </form>
@endsection

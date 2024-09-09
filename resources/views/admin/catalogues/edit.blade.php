@extends('admin.layouts.master')

@section('title')
    Câp nhật danh mục : {{ $catalogue->name }}
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
    <form action="{{ route('admin.catalogues.update', $catalogue) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Cập nhật danh mục</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-6">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control mb-2" id="name" name="name"
                                            value="{{ $catalogue->name }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="parent_id" class="form-label">Loại tin cha</label>
                                    <select id="" class="js-example-basic-single form-control" name="parent_id"
                                        id="parent_id">
                                        @php($parent_id = $catalogue->parent_id)
                                        @foreach ($parentCatalogues as $parent)
                                            @php($each = ' ')
                                            @include('admin.catalogues.nested-catalogue-edit', [
                                                'catalogue' => $parent,
                                                'parent_id' => $parent_id,
                                            ])
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="image">Image</label><br>
                                    <img src="{{ Storage::url($catalogue->image) }}" alt="" width="80">
                                    <input type="file" class="form-control mt-3" name="image" id="image">
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-primary">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="is_active" id="is_active"
                                                    @if ($catalogue->is_active === 1) checked @endif>
                                                <label class="form-check-label" for="is_active">Is Active</label>
                                            </div>
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

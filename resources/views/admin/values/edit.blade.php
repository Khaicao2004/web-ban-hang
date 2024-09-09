@extends('admin.layouts.master')

@section('title')
    Cập nhật giá trị thuộc tính: {{ $value->name }}
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
    <form action="{{ route('admin.values.update', $value) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"> Cập nhật giá trị thuộc tính: {{ $value->name }}</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-6">
                                    <div>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control mb-2" id="name" name="name"
                                            value="{{ $value->name }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="attribute_id" class="form-label">Thuộc tính</label>
                                    <select name="attribute_id" class="form-select">
                                        <option value="">--Chọn thuộc tính--</option>
                                        @foreach ($attributes as $id => $name)
                                            <option value="{{ $id }}"
                                                @if ($value->attribute_id === $id) selected @endif>{{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
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

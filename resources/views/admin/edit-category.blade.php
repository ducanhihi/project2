@extends('layout.app')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Cập nhật thể loại</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Thể loại</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <form method="POST" action="/admin/edit/category/{{$category -> id}}">
            @csrf
            <div class="form-group">
                <label for="name">Tên thể loại</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
        <div id="eJOY__extension_root" class="eJOY__extension_root_class" style="all: unset;"></div>
    </main><!-- End #main -->
@endsection

@extends('layout.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Thương Hiệu</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Thương Hiệu</li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card card-table">
                    <div class="card-header">
                        <div>
                            <a href="#addBrandModal" class="btn" style="background-color: gainsboro"
                               data-toggle="modal" data-bs-target=""><i
                                    class="material-icons"></i>
                                <span>Thêm thương hiệu</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="brand_table" data-page-length='3'
                               class="table table-sm">
                            <thead>
                            <tr>
                                <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                                </th>
                                <th class="text-center fw-bold">ID</th>
                                <th class="text-center fw-bold">Name</th>
                                <th class="text-center fw-bold">Created at</th>
                                <th class="text-center fw-bold">Update at</th>
                                <th class="text-center fw-bold">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($allBrands as $brand)
                                <tr>
                                    <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                <label for="checkbox1"></label>
                            </span>
                                    </td>
                                    <td class="text-center fw-bold">{{$brand-> id}}</td>
                                    <td class="text-center fw-bold">{{$brand-> name}}</td>
                                    <td class="text-center fw-bold">{{$brand-> created_at}}</td>
                                    <td class="text-center fw-bold">{{$brand-> created_at}}</td>
                                    <td class="d-flex justify-content-around align-content-center">
                                        <a href="{{route('admin.edit-brand',['id'=>$brand->id])}}" ><i class="material-icons"></i></a>
                                        <a href="#deleteBrandModal" data-id="{{$brand -> id}}" class="delete"
                                           data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title=""
                                                                  data-original-title="Delete"></i></a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Add Modal HTML -->
    <div id="addBrandModal" class="modal fade" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/create/brand" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Brand</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteBrandModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                @if(isset($brand) && $brand)
                    <form action="/home/brand/{{$brand-> id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Brand</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                @else
                    <p>nbnbnb</p>
                @endif
            </div>
        </div>
    </div>
    <div id="eJOY__extension_root" class="eJOY__extension_root_class" style="all: unset;"></div>
    </body>
    <script>
        $(document).on("click", ".delete", function () {
            var brandId = $(this).data('id');
            $("#deleteBrandModal form").attr('action', '/home/brand/' + brandId);
        });
    </script>
    <script>
        let table = new DataTable('#brand_table');
    </script>
@endsection

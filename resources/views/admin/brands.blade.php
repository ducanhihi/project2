@extends('layout.app')

@section('content')
<body class="">
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>Brands</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addBrandModal" class="btn btn-success" data-toggle="modal" data-bs-target=""><i class="material-icons"></i> <span>Add New Brand</span></a>
                                <a href="#deleteBrandModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons"></i> <span>Delete</span></a>
                            </div>
                        </div>
                    </div>
                    <table id="brand_table" data-page-length='5' class="table table-striped table-hover">
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
                                    <a href="#editBrandModal" data-id="{{$brand -> id}}" data-name="{{$brand->name}}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>
                                    <a href="#deleteBrandModal" data-id="{{$brand -> id}}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
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
    <!-- Edit Modal HTML -->
    <div id="editBrandModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                @if(isset($brand) && $brand)
                    <form method="POST" action="/admin/edit/brand/{{$brand -> id}}">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Brand</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required="" value="{{$brand -> name}}">
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-info" value="Save">
                            </div>
                        </div>
                    </form>
                @else
                    <p>dfđff</p>
                @endif
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
        $(document).on("click", ".edit", function () {
            var editID = $(this).data('id');
            $("#editBrandModal form").attr('action', '/admin/edit/brand/' + editID);
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.edit').on('click', function(){
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#editBrandModal input[name="id"]').val(id);
                $('#editBrandModal input[name="name"]').val(name);
            });
        });
    </script>
    <script>
        let table = new DataTable('#brand_table');
    </script>
@endsection

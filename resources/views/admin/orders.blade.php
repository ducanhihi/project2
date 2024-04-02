@extends('layout.app')

@section('content')
    <body class="">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Categories</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal" data-bs-target=""><i class="material-icons"></i> <span>Add New Category</span></a>
                            <a href="#deleteCategoryModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons"></i> <span>Delete</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
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
                    @forelse($allOrders as $order)
                        <tr>
                            <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                <label for="checkbox1"></label>
                            </span>
                            </td>
                            <td class="text-center fw-bold">{{$order-> id}}</td>
                            <td class="text-center fw-bold">{{$order-> name}}</td>
                            <td class="text-center fw-bold">{{$order-> created_at}}</td>
                            <td class="text-center fw-bold">{{$order-> created_at}}</td>
                            <td class="d-flex justify-content-around align-content-center">
                                <a href="#editCategoryModal" data-id="{{$order -> id}}" data-name="{{$order->name}}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>
                                <a href="#deleteCategoryModal" data-id="{{$order -> id}}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addOrderModal" class="modal fade" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/create/category" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Category</h4>
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
    <div id="editOrderModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                @if(isset($order) && $order)
                    <form method="POST" action="/admin/edit/category/{{$order -> id}}">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required="" value="{{$order -> name}}">
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
    <div id="deleteOrderModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                @if(isset($order) && $order)
                    <form action="/home/brand/{{$order-> id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Employee</h4>
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
            var OrderId = $(this).data('id');
                $("#deleteOrderModal form").attr('action', '/home/category/' + OrderId);
        });
        $(document).on("click", ".edit", function () {
            var editID = $(this).data('id');
            $("#editOrderModal form").attr('action', '/admin/edit/category/' + editID);
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.edit').on('click', function(){
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#editOrderModal input[name="id"]').val(id);
                $('#editOrderModal input[name="name"]').val(name);
            });
        });
    </script>
@endsection

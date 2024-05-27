@extends('layout.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Quản Lí Thể Loại</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Thể Loại</li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card card-table">
                    <div class="card-header">
                        <div>
                            <a href="#addCategoryModal" class="btn" style="background-color: gainsboro"
                               data-toggle="modal" data-bs-target=""><i
                                    class="material-icons"></i>
                                <span>Thêm thể loại</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="products_table" data-page-length='5'
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
                            @forelse($allCategories as $category)
                                <tr>
                                    <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                    </td>
                                    <td class="text-center fw-bold">{{$category-> id}}</td>
                                    <td class="text-center fw-bold">{{$category-> name}}</td>
                                    <td class="text-center fw-bold">{{$category-> created_at}}</td>
                                    <td class="text-center fw-bold">{{$category-> created_at}}</td>
                                    <td class="d-flex justify-content-around align-content-center">
                                        <a href="#editCategoryModal" data-id="{{$category -> id}}"
                                           data-name="{{$category->name}}" class="edit" data-toggle="modal"><i
                                                class="material-icons" data-toggle="tooltip" title=""
                                                data-original-title="Edit"></i></a>
                                        <a href="#deleteCategoryModal" data-id="{{$category -> id}}" class="delete"
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
    <div id="addCategoryModal" class="modal fade" aria-hidden="true" style="display: none;">
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
    <div id="editCategoryModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                @if(isset($category) && $category)
                    <form method="POST" action="/admin/edit/category/{{$category -> id}}">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required=""
                                       value="{{$category -> name}}">
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
    <div id="deleteCategoryModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                @if(isset($category) && $category)
                    <form action="/home/category/{{$category-> id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Category</h4>
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
    <script>
        $(document).on("click", ".delete", function () {
            var categoryId = $(this).data('id');
            $("#deleteCategoryModal form").attr('action', '/home/category/' + categoryId);
        });
        $(document).on("click", ".edit", function () {
            var editID = $(this).data('id');
            $("#editCategoryModal form").attr('action', '/admin/edit/category/' + editID);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.edit').on('click', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#editCategoryModal input[name="id"]').val(id);
                $('#editCategoryModal input[name="name"]').val(name);
            });
        });
    </script>
    <script>
        let table = new DataTable('#category_table');
    </script>
@endsection

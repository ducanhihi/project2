@extends('layout.app')

@section('content')
   <div class="container">
       <div class="row-cols-6">
           <table class="table table-bordered table-hover">
               <tr class="table-active text-center">
                   <th>ID</th>
                   <th>Name</th>
                   <th>Created_at</th>
                   <th>Update_at</th>
               </tr>
               @forelse($allCategories as $categories)
                   <tr>
                       <td class="text-center">{{$categories-> id}}</td>
                       <td class="fw-bold">{{$categories-> name}}</td>
                       <td class="fw-bold">{{$categories-> created_at}}</td>
                       <td class="fw-bold">{{$categories-> updated_at}}</td>
                       {{--                                <td class="d-flex justify-content-around align-content-center">--}}
                       {{--                                    <a class="btn btn-sm btn-warning" href="admin/home/{{$products->id}}/edit">Sửa</a>--}}
                       {{--                                    <form onsubmit="return confirm('Ban co muon xoa')" action="/home/news/{{$products-> id}}" method="POST">--}}
                       {{--                                        @method('DELETE')--}}
                       {{--                                        @csrf--}}
                       {{--                                        <button class="btn btn-sm btn-danger">Xoa</button>--}}
                       {{--                                    </form>--}}
                       {{--                                </td>--}}x
                   </tr>
               @empty
               @endforelse
           </table>
       </div>
   </div>
@endsection

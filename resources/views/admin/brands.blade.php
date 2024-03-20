@extends('layout.app')

@section('content')
    <table class="table table-bordered table-hover">
        <tr class="table-active text-center">
            <th>ID</th>
            <th>Name</th>
            <th>Created_at</th>
            <th>Update_at</th>
        </tr>
        @forelse($allBrands as $brands)
            <tr>
                <td class="text-center">{{$brands-> id}}</td>
                <td class="fw-bold">{{$brands-> name}}</td>
                <td class="fw-bold">{{$brands-> created_at}}</td>
                <td class="fw-bold">{{$brands-> updated_at}}</td>
                {{--                                <td class="d-flex justify-content-around align-content-center">--}}
                {{--                                    <a class="btn btn-sm btn-warning" href="admin/home/{{$products->id}}/edit">Sửa</a>--}}
                {{--                                    <form onsubmit="return confirm('Ban co muon xoa')" action="/home/news/{{$products-> id}}" method="POST">--}}
                {{--                                        @method('DELETE')--}}
                {{--                                        @csrf--}}
                {{--                                        <button class="btn btn-sm btn-danger">Xoa</button>--}}
                {{--                                    </form>--}}
                {{--                                </td>--}}
            </tr>
        @empty
        @endforelse
    </table>
@endsection

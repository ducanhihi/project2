@extends('layout.app')

@section('content')
    <table class="table table-bordered table-hover">
        <tr class="table-active text-center">
            <th>ID</th>
            <th>ISBNcode</th>
            <th>Name</th>
            <th>Price</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
        @forelse($allProducts as $products)
            <tr>
                <td class="text-center">{{$products-> id}}</td>
                <td class="text-center">{{$products-> isbn_code}}</td>
                <td class="fw-bold">{{$products-> name}}</td>
                <td class="fw-bold">{{$products-> price}}</td>
                <td>{{$products-> created_at}}</td>
                                <td class="d-flex justify-content-around align-content-center">
                                    <a class="btn btn-sm btn-warning" href="admin/home/{{$products->id}}/edit">Sửa</a>
                                    <form onsubmit="return confirm('Ban co muon xoa')" action="/home/news/{{$products-> id}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger">Xoa</button>
                                    </form>
                                </td>
            </tr>
        @empty
        @endforelse
    </table>
@endsection

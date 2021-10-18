@extends('posts.layout')

@section('content')


<div class="row" style="margin-top: 1rem;">
    <form action="{{route('posts.index')}}" method="GET">
        <div class="col-lg-12 margin-tb">

            <div class="form-group pull-left">
                <input type="search" name="search" class="form-control">
                <br>
            </div>
        </div>
        <div class="col-lg-12 margin-tb">
            <label for="page">Select paginate:</label>
            <select name="page_name" id="page_id">
                <option value="5">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
            </select>
            <br>
        </div>
        <span class="input-group-prepend ">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Add new</a>
            </div>
        </div>
    </form>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered" id="myTable">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th width="280px">Action</th>
    </tr>
    @if(count($data) > 0)
    @foreach($data as $key => $value)
    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $value->title }}</td>
        <td>{{ \Str::limit($value->author, 100) }}</td>
        <td>
            <form action="{{ route('posts.destroy',$value->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('posts.show',$value->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('posts.edit',$value->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick=" return confirm('Are You Sure to Delete')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    @else
    <tr>
        <td colspan="4">No data found</td>
    </tr>
    @endif
</table>

<!-- <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script> -->
{!! $data->links() !!}
@endsection
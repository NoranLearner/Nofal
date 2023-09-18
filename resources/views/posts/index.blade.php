@extends('layouts.master')

@section('title')
    Post Management
@endsection

@section('css')
@endsection

@section('page_title')
    Posts
@endsection

@section('page_desc')
    Post Management
@endsection

@section('page_icon')
    <i class="fab far fa-comments"></i>
@endsection

@section('page_title1')
    <a href="{{ route('posts.index') }}">Posts</a>
@endsection

@section('page_title2')
    <a href="#" class="c-grey">index</a>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="mb-3">
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New Post </a>
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-danger ml-2" id="deleteAllSelected"> Delete All Selected </button>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert col-12  alert-success alert-shade alert-dismissible fade show" role="alert">
                    <p class="fnt-code c-white">{{ $message }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="alert col-12 alert-danger alert-shade alert-dismissible fade show" role="alert" id="success_msg" style="display: none;">
                <p class="fnt-code c-white">Selected Post have been Deleted successfully</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>

                        <th scope="col">
                            <input type="checkbox" id="select_all_ids">
                        </th>

                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Description</th>
                        <th scope="col">Cover</th>
                        <th scope="col" width="400px">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($posts as $key => $post)
                        <tr id="pos{{ $post->id }}">

                            <td>
                                <input type="checkbox" name="idp" class="checkbox_ids" value="{{ $post->id }}">
                            </td>

                            <th scope="row">{{ $post->id }}</th>

                            <td>{{ $post->title }}</td>

                            <td>{{ $post->author }}</td>

                            <td>{{ $post->body }}</td>

                            <td>
                                <center>
                                    <img src="cover/{{ $post->cover }}" class="img-responsive"
                                        style="max-height:100px; max-width:100px" alt="Not Available" srcset="">
                                </center>
                            </td>

                            <td>

                                <div class="row">

                                    <div class="col">
                                        <a class="btn btn-info" href="{{ route('posts.show', $post->id) }}">Show</a>
                                    </div>

                                    <div class="col">
                                        <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">Update</a>
                                    </div>

                                    <div class="col">
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure detete post: {{ $post->title }} ?')">Delete</button>
                                        </form>
                                    </div>

                                </div>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="pagination main justify-content-center">
            {{ $posts->links() }}
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(function(e) {

            $("#select_all_ids").click(function() {
                $(".checkbox_ids").prop('checked', $(this).prop('checked'));
            });

            $("#deleteAllSelected").click(function(e) {
                e.preventDefault();

                if (confirm("Are you sure detete selected post?") == true){

                    var allid = [];

                    $("input:checkbox[name=idp]:checked").each(function() {
                        allid.push($(this).val());
                    });

                    $.ajax({
                        type: "Delete",
                        url: "/selected-post",
                        data: {
                            _token: '{{ csrf_token() }}',
                            idp: allid
                        },
                        success: function(response, data) {
                            if (data.status == true) {
                                $('#success_msg').show();
                            }
                            $.each(allid, function(key, val) {
                                $("#pos" + val).remove();
                            });
                        },
                    });

                }

            });

        });
    </script>
@endsection

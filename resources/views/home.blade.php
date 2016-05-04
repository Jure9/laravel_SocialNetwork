@extends('layouts.base')

@section('content')

    @include('includes.message')

    <div class="row new_post">
        <div class="col-md-6 col-md-offset-2">
            <header><h3>New post</h3></header>
            <form action=" {{ route('post.create') }} " method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="nuPost" rows="6"
                              placeholder="Write your post"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">push D button</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>

    <section class="row posts">
        <div class="col-md-6 col-md-offset-2">
            <header><h3>Posts from around the globe:</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->firstName}} {{ $post->user->lastName}} on {{ $post->created_at}}
                    </div>

                    <div class="interaction">
                        <a href="#">Like</a> |
                        <a href="#">Dislike</a>
                        @if(Auth::user() == $post->user)
                            |
                            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delite</a> |
                            <a href="#" class="edit">Edit</a>
                        @endif
                    </div>

                </article>
            @endforeach

        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit post</h4>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="post-body">Edit post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token= '{{ Session::token() }}';
        var urlEdit= '{{ route('edit') }}'
    </script>
@endsection
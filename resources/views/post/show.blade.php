@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{$post->title}}
                            <span id="reading-count" class="badge badge-primary">0</span> reading
                        </div>
                        <div class="card-body">
                            <p>{{$post->body}}</p>
                            <p>Post by: {{$post->user->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
     $(document).ready(function() {
    let postId = '{{ $post->id }}';
    let csrfToken = '{{ csrf_token() }}';
    let localStorageKey = 'hasJoinedPost-' + postId;

    // Check if the user has already joined this post
    if (!localStorage.getItem(localStorageKey)) {
        // Send a POST request to join the post channel and increment the count
        $.post('/posts/' + postId + '/join-channel', { _token: csrfToken }, function(response) {
            $('#reading-count').text(response.count);
            localStorage.setItem(localStorageKey, 'true');
        });
    } else {
        // Get the current count from the server
        $.get('/posts/' + postId + '/current-readers-count', function(response) {
            $('#reading-count').text(response.count);
        });
    }

    // Setup Laravel Echo for presence channels
    window.Echo.join('posts.' + postId)
        .here((users) => {
            $('#reading-count').text(users.length);
        })
        .joining((user) => {
            let count = parseInt($('#reading-count').text());
            $('#reading-count').text(count + 1);
        })
        .leaving((user) => {
            let count = parseInt($('#reading-count').text());
            $('#reading-count').text(count - 1);
        });

    // Ensure the channel is left and the count is updated when the user leaves the page
    $(window).on('beforeunload', function() {
        // Send a POST request to update the count on the server
        $.ajax({
            url: '/posts/' + postId + '/leave-channel',
            method: 'POST',
            data: { _token: csrfToken },
            async: false // Ensure this request completes before unloading
        });

        // Leave the channel
        window.Echo.leave('posts.' + postId);
    });
});
    </script>
@endsection

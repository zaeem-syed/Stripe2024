@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @foreach ($post as $posts )
                    <div class="card-header"> {{$posts->title}}</div>

                    <div class="card-body">
                        <a href="{{ url('/post/'. $posts->id) }}">
                        <p>{{$posts->body}}</p>
                        <p>post by : {{$posts->user->name}} </p>
                       </a>

                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
           function join(){
            Echo.join('posts.'+{{$posts->id}});
           }
        });
    </script>
@endsection

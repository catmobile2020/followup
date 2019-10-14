@extends('layouts.master')
@section('title')News Feed @endsection
@section('styles')
    <style>

        .b-b {
            border-bottom:1px solid #e1e1e8;
        }
        .b-t {
            border-top:1px solid #e1e1e8;

        }
        .post {
            padding: 10px;
            margin: 10px;
            background: #fff;
            outline: -webkit-focus-ring-color auto 0px;
            box-shadow: 0 0 50px 0 rgba(0, 0, 0, 0.15);
        }
        .top-post {
            padding-top: 10px;
            padding-bottom: 10px;
            margin-bottom: 7px;
        }
        .radius {
            border-radius: 50%;
        }
        .top-post span {
            font-weight: bold;
        }
        .content-post .comment {
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
            display : flex;
        }
        .content-post .comment > .text p {
            padding : 10px;
            margin : 5px;
            background-color: #f3f3f3;
            border-radius: 10px;
        }
        .option-post .like , .option-post .comment {
            text-align: center;
            padding-top: 8px;
            padding-bottom: 8px;
            cursor: pointer;
        }
        .bottom-post {
            display: flex;
        }
        .bottom-post .img-user {
            width: 30px;
            height: 30px;
            margin:10px;
            margin-top :12px;
        }
        .comment-post {
            outline: -webkit-focus-ring-color auto 0px;
            margin-top : 10px;
            margin-bottom: 10px;
            width:100%;
            padding:6px;
            border-radius:40px;
            background-color: #f2f3f5;
            border: 1px solid #ccd0d5;
            padding-left:20px;
            padding-right:20px;
        }
        .dangers{
            color: #ffffff !important;
            background-color: #db2c2c !important;
            border-color: #bb3038 !important;
        }
        .zx{
            float: right;
            margin-top: -50px;
            margin-right: 5px;
        }
        .content-post .comment > .text p{
            width: 600px;
        }
        .content-post .comment.reply > .text p{
            width: 500px;
        }

        .upload-btn-wrapper {
            position: absolute;
            overflow: hidden;
            display: inline-block;
            right: 86px;
            margin-top: 4px;
        }



        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        .reply-btn {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0;
            width: 27px;
            height: 100%;
        }
        .btn-comment {
            position: absolute;
            right: 40px;
            margin-top: 15px;
            border-radius: 50px;
        }
        .reply_post {
            position: absolute;
            top: 14px;
            right: 13px;
        }
        .delete_post{
            position: absolute;
            right: 50px;
            cursor: pointer;
        }
        .delete_reply{
            position: absolute;
            right: 7px;
            top:35%;
            cursor: pointer;
        }
        .delete_comment {
            position: absolute;
            right: 36px;
            cursor: pointer;
            top: 33%;
        }
        .text{
            position: relative;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                @if(Auth::user()->team->name == 'Management' || Auth::user()->team->name == 'HR')
                <div class="post-topbar">
                    <h2> Welcome, Admin / HR </h2>
                    <div class="details">
                        <div class="upload-btn-wrapper">
                            <button class="btn">Upload a file</button>
                            <input type="file" name="image" id="image" />
                        </div>
                        <textarea v-model="post.details" id="body" class="form-control" placeholder="Add Corporate Post!"></textarea>
                    </div>
                        <button class="btn btn-primary zx" id="savePost">Post</button>
                </div><!--post-topbar end-->
                @endif

                <div class="all-post" id="app">
                    <input type="hidden" id="user_id" value="{{ Auth::id() }}">
                    @foreach($posts as $post)
                        <div class="post">
                            <div class="top-post b-b">
                                @if(count($post->user->photos) > 0) @foreach($post->user->photos as $photo) @if($photo->path || file_exists($photo->path))<img width="25" class="img-circle avatar" src="{{ URL::asset($photo->path) }}" >   @endif @endforeach @else <img width="25" class="img-circle avatar" src="http://via.placeholder.com/140x100"> @endif
                                <span>{{ $post->user->name }}</span>

                                @if(Auth::id() == $post->user_id) <a class="delete_post" id="{{ $post->id }}"><i class="icon-cancel"></i>Delete </a> @endif
                            </div>
                            <div class="comment" style="width: 90%; text-align: left; margin-left: 7%;padding: 17px;">
                                <div class="text">
                                    <p>
                                        {{ $post->body }}
                                    </p>
                                    @if(count($post->photos) > 0) @foreach($post->photos as $photo) @if($photo->path || file_exists($photo->path))<img class="img-responsive" src="{{ URL::asset($photo->path) }}" >   @endif @endforeach @endif
                                </div>
                            </div>
                            <div class="option-post b-b b-t">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="like" id="{{ $post->id }}">
                                            <i class="fa fa-thumbs-o-up"></i> <span id="like_score{{$post->id}}"> {{ $post->likes()->count() }} Like</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="comment">
                                            <i class="fa fa-comment-o"></i> Comment
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-post">
                                @foreach($post->comments as $comment)
                                <div class="comment">
                                    <div class="image-user">
                                        @if(count($comment->user->photos) > 0) @foreach($comment->user->photos as $photo) @if($photo->path || file_exists($photo->path))<img class="img-user radius" style="width: 25px; height: 25px; margin-top: 5px;" src="{{ URL::asset($photo->path) }}" >   @endif @endforeach @else <img class="img-circle avatar" src="http://via.placeholder.com/140x100"> @endif
                                    </div>
                                    <div class="text">
                                        <p style="position: relative"> <b>{{ $comment->user->name }}</b> <br/>
                                            {{ $comment->body }}<br>
                                            @if(Auth::id() == $comment->user_id) <a class="delete_comment" id="{{ $comment->id }}"><i class="icon-trash"></i> </a> @endif
                                            <button class="btn btn-success reply-btn reply-toggle" id="{{ $comment->id }}"> <i class="icon-level-down"></i> </button>
                                        </p>
                                        <div id="reply_text{{ $comment->id }}" style="display: none; position: relative">
                                            <input type="text" class="comment-post" id="reply{{ $comment->id }}">
                                            <button class="btn btn-success btn-sm reply_post" id="{{ $comment->id }}"> Reply </button>
                                        </div>
                                    @foreach($comment->replies as $reply)
                                                <div class="comment reply">
                                                    <div class="image-user">
                                                        @if(count($reply->user->photos) > 0) @foreach($comment->user->photos as $photo) @if($photo->path || file_exists($photo->path))<img class="img-user radius" style="width: 25px; height: 25px; margin-top: 5px;" src="{{ URL::asset($photo->path) }}" >   @endif @endforeach @else <img class="img-circle avatar" src="http://via.placeholder.com/140x100"> @endif

                                                    </div>
                                                    <div class="text">
                                                        <p> <b>{{ $reply->user->name }}</b> <br/>
                                                            {{ $reply->body }}

                              @if(Auth::id() == $reply->user_id) <a class="delete_reply" id="{{ $reply->id }}"><i class="icon-trash"></i> </a> @endif
                                                        </p>
                                                    </div>
                                                </div>
                                    @endforeach

                                    </div>
                                </div>

                                 @endforeach


                            </div>

                            <div class="bottom-post">
                                @if(count(Auth::user()->photos) > 0) @foreach(Auth::user()->photos as $photo) @if($photo->path || file_exists($photo->path))<img class="img-user radius" style="width: 30px; height: 30px; margin-top: 11px;" src="{{ URL::asset($photo->path) }}" >   @endif @endforeach @else <img class="img-circle avatar" src="http://via.placeholder.com/140x100"> @endif
                                    <input type="text" class="comment-post" id="comment-post{{ $post->id }}">

                                    <button class="btn btn-primary btn-sm btn-comment comment_post" id="{{ $post->id }}"> comment </button>



                            </div>
                        </div>
                        @endforeach

                </div>
            </div>
        </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script>
        const app = new Vue({
            el : '#app',
            data : {
                posts: [],
                page: 1,
                post : {
                    details : '',
                }
            },
            mounted() {

            },
            methods : {
                infiniteHandler($state) {
                    let vm = this;
                    axios.get('/api/posts', {
                        params: {
                            page: this.page,
                        },
                    }).then(response => {
                        if (response.data.posts.data.length > 0) {
                            $.each(response.data.posts.data, function(key, value) {
                                vm.posts.push(value);

                            });
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                        this.page = this.page + 1;
                    });
                },
                savePost() {
                    let vm = this;
                    axios.post('/posts/store', this.post)
                        .then(function (response) {
                            vm.$toaster.success('Posted Successfully.')
                            vm.post.details = '';
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        });

        $(document).ready(function () {
            $('#savePost').on('click', function () {
                user_id = $('#user_id').val();
                    var filesSelected = document.getElementById("image").files;
                    var body = $('#body').val();
                    if (filesSelected.length > 0) {
                        var fileToLoad = filesSelected[0];
                        var fileReader = new FileReader();

                        fileReader.onload = function(fileLoadedEvent) {
                            var srcData = fileLoadedEvent.target.result.split(',')[1]; // <--- data: base644
                            if(!body || body == null){
                                $.post('/api/corporate-posts', {user_id: user_id, image: srcData}, function (data) {
                                    window.location.reload();
                                });
                            }else{
                                $.post('/api/corporate-posts', {user_id: user_id, image: srcData, body: body}, function (data) {
                                    window.location.reload();
                                });
                            }

                        }
                        fileReader.readAsDataURL(fileToLoad);
                    }else{
                        $.post('/api/corporate-posts', {user_id: user_id, body: body}, function (data) {
                            window.location.reload();
                        });
                    }



            });

            $('.like').on('click',function () {
               var id = $(this).attr('id'),
               user_id = $('#user_id').val();
               //alert($('#like_score'+id, this).html());
               $.post('/api/post/'+ id +'/likes', {user_id: user_id }, function(data) {
                   $('#like_score'+ id).text(data.data + ' Likes');
                });
            });

            $('.comment_post').on('click',function () {
               var post_id = $(this).attr('id'),
                   user_id = $('#user_id').val(),
                   comment = $('#comment-post'+post_id).val();

               $.post('/api/post/'+ post_id +'/comments', {user_id: user_id, body:comment}, function (data) {
                   console.log(data.data);
                   window.location.reload();
               });
            });

            $('.reply-btn').on('click', function () {
                var id = $(this).attr('id');
                var x = document.getElementById("reply_text"+ id);
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            });


            $('.reply_post').on('click', function () {
                var comment_id = $(this).attr('id'),
                    user_id = $('#user_id').val(),
                    reply = $('#reply'+comment_id).val();

                $.post('/api/comment/'+ comment_id +'/replies', {user_id: user_id, body:reply}, function (data) {
                    console.log(data.data);
                    window.location.reload();
                });
            });


            $('.delete_post').on('click', function () {
               var post_id = $(this).attr('id'),
               user_id = $('#user_id').val();
                $.post('/api/delete-post/'+ post_id, function (data) {
                    console.log(data.data);
                    window.location.reload();
                });
            });

            $('.delete_comment').on('click', function () {
                var comment_id = $(this).attr('id'),
                    user_id = $('#user_id').val();
                $.post('/api/comment/'+ comment_id +'/delete', {user_id: user_id}, function (data) {
                    window.location.reload();
                });
            });

            $('.delete_reply').on('click', function () {
                var reply_id = $(this).attr('id'),
                    user_id = $('#user_id').val();
                $.post('/api/reply/'+ reply_id +'/delete', {user_id: user_id}, function (data) {
                    window.location.reload();
                });
            });


        });
    </script>

@endsection
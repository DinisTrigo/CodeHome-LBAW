<p id="csrf-token" style="display: none" hidden >{{csrf_token()}}</p>      
<br>

<script src="./assets/js/deletePost.js"></script>
<div class ="infinite-scroll">
    @foreach ($questions as $question)
    <div  id="question-{{$question->question_id}}" class="row">
        <div class="col-12">
            <div class="col-11 mx-auto">
                <div class="card border">
                    <div class="card-header border">
                        <div class="row">
                            <div class="col-12">
                                <a href="./questions/{{$question->question_id}}"> <b> {{$question->title}} </b></a>
                                <a style="color: inherit;text-decoration: none;padding-left:10px;" data-toggle="tooltip" data-placement="bottom"
                                title="Upvote Question">
                                    <i id="upvoteArr-{{$question->question_id}}" class="fas fa-caret-up upvoteArr" onclick="voteInPost(event, 1)">
                                    </i>
                                </a>
                                <a style="color: inherit;text-decoration: none;" data-toggle="tooltip" data-placement="top" title="Downvote Question">
                                    <i id="downvoteArr-{{$question->question_id}}" class="fas fa-caret-down downvoteArr" onclick="voteInPost(event, - 1)"></i>
                                </a>
                                @include('pages.showQuestionPoints')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-block border">
                    <div class="row mx-auto">
                        <div class="col-12" style="font-size: 0.9rem;">
                            <h5 style="margin-top:4px;" class="card-text text-dark">{{$question->content}}</h5>
                            <br>
                            <div class="sticky-right">
                                <h6 id="post{{$question->question_id}}PosterPoints" style="font-size:1.2em; color: rgb(0, 153, 255);">
                                    By: 
                                    <a href="./users/{{$question->poster_id}}">{{$question->username}}</a> 
                                    ({{$question->poster_points}} Points)
                                </h6>
                            </div>
                            <br>
                            @if (sizeof($questions_tags[$question->question_id]) != 0)
                            <h6>Tags:
                                @foreach ($questions_tags[$question->question_id] as $tag)
                                <a onclick="addTagToSearchBar('{{$tag->tag_name}}')" class="badge badge-pill badge-primary">{{$tag->tag_name}}</a>
                                @endforeach
                            </h6>
                            @endif
                        </div>
                    </div>
                    <br>
                </div>
                <div class="card-footer border-bottom border-top-0 border-dark">
                    <div class="btn-group btn-group-sm " role="group" aria-label="Basic example">
                        <form style="display: inline" action="{{url('/questions/'.$question->question_id)}}#replyDiv" method="get">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-comment"></i> Reply 
                            </button>
                        </form>

                        <form style="display: inline" action="/report/post/{{$question->question_id}}" method="get">
                            <input hidden type="text" name="last_url" value = window.location.href>
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-flag"></i> Report
                            </button>
                        </form>
                    
                        @if(Auth::user()->type == "ADMIN" || Auth::user()->id == $question->poster_id)
                        <form id="deleteQuestionButton-{{$question->question_id}}" style="display: inline" onsubmit="return deleteQuestion(event);" method="get">
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{ $questions->links() }}
</div>

<style>
    .jscroll-inner {
        overflow: hidden;
    }
</style>
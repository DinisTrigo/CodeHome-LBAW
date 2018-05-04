<html class="no-js" lang="en">

    <head>

        <title>Bootstrap 4 Layout</title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap-homepage.css">
        <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./assets/css/bootstrap.css" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="./assets/css/bars.css" rel="stylesheet">
        <link href="./assets/css/common.css" rel="stylesheet">
        <link href="./assets/css/admin.css" rel="stylesheet">
        <link rel="stylesheet" href="./assets/css/Homepage/styles.css">
        <link rel="stylesheet" href="./assets/css/HomepageNotLogged/style.css">

        <script src="./assets/js/jquery-1.11.1.min.js"></script>
        <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="./assets/js/jquery.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
                <script src="./assets/js/homepageSearchBar.js"></script>
		
		<meta name="google-site-verification" content="a30N-kL6X9vHRm5MlZ_OE720T-Vl8rKeKqC8x2_8AmM" />
    </head>

    <body>

        <div id="wrap" class="wrapper">
            <div id="content">
                @include("pages.navbar")
                <div id="classContainerID" class="container">
                    <div class="row">
                        <div id="searchInputForm" class="col-12">
                            <div class="row" id="searchInput">
                                <div class="col-8 mx-auto" style="margin-left:10vw;">
                                    <div class="input-group mb-3 mx-auto">
                                                <form action="{{ url('/poster') }}" method="post">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <span class="sr-only">Sort Methods</span>Sort By
                                                            </button>
                                                            <ul class="dropdown-menu text-dark">
                                                                <li>
                                                                    <a href="#" class="small" data-value="option1" tabIndex="-1">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox">
                                                                                <span class="checkbox-material">
                                                                                    <span class="check"></span>
                                                                                </span> Question Points
                                                                            </label>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="small" data-value="option1" tabIndex="-1">
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox">
                                                                                <span class="checkbox-material">
                                                                                    <span class="check"></span>
                                                                                </span> Poster Points
                                                                            </label>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <input id="questionSearchBar" type="text" name="data" class="form-control border-dark" aria-label="Text input with segmented dropdown button" data-toggle="tooltip"
                                                               data-placement="bottom" title="Search For Questions. Use the # before a word to add a tag search to your question.">
                                                        <button type="button submit" class="btn btn-outline-dark">Search</button>
                                                        
                                                    </form>    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-1">
                        </div>
                    </div>
                    <br>
                    <div id="Questions">
                    <p id="questions-csrf-token" style:"display: none" hidden >{{csrf_token()}}</p>      
                        <br>

                        @foreach ($questions as $question)
                        <div id="question-{{$question->question_id}}" class="row">
                                    <div class="col-12">
                                        <div class="col-11 mx-auto">
                                        <div class="card border">
                                        <h5 class="card-header border">
                                            <div class="row">
                                            <div class="col-9">
                                            <a href="./questions/{{$question->question_id}}"> <b> {{$question->title}} </b></a>
                                                <a href="#" style="color: inherit;text-decoration: none;padding-left:10px;" data-toggle="tooltip" data-placement="bottom"
                                               title="Upvote Question">
                                                <i id="upvoteArr-{{$question->question_id}}" class="fas fa-caret-up upvoteArr" onclick="voteInPost(event, 1)">
                                                </i>
                                            </a>
                                            <a href="#" style="color: inherit;text-decoration: none;" data-toggle="tooltip" data-placement="top" title="Downvote Question">
                                                <i id="downvoteArr-{{$question->question_id}}" class="fas fa-caret-down downvoteArr" onclick="voteInPost(event, -1)"></i>
                                            </a>
                                        </div>
                                        @include('pages.showQuestionPoints')
                                            </div>
                                        </h5>
                                    </div>
                                    <div class="card-block border">
                                        <h4 class="card-title"></h4>
                                        <div class="row mx-auto">
                                            <div class="col-12" style="font-size: 0.9rem;">
                                            <h5 class="card-text text-dark">{{$question->content}}</h5>
                                                <br>
                                                <div class="sticky-right">
                                                    <h6 style="font-size:1.2em; color: rgb(0, 153, 255);">By: <a href="./users/{{$question->poster_id}}">{{$question->username}}</a> ({{$question->poster_points}} Points)</h6>
                                                </div>
                                                <br>
                                                @if (sizeof($questions_tags[$question->question_id]) != 0)
                                                <h6>Tags:
                                                @foreach ($questions_tags[$question->question_id] as $tag)
                                                <a href="#" onclick="addTagToSearchBar('{{$tag->tag_name}}')" class="badge badge-pill badge-primary">{{$tag->tag_name}}</a>
                                            @endforeach
                                                </h6>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>

                                @endforeach

                <script>


                    $('#upvoteArr').mouseover(function () {
                        $("#upvoteArr").removeClass('text-secondary');
                        $("#upvoteArr").addClass('text-success');
                    })
                    $('#upvoteArr').mouseleave(function () {
                        $("#upvoteArr").addClass('text-secondary');
                        $("#upvoteArr").removeClass('text-success');
                    })


                    $('#downvoteArr').mouseover(function () {
                        $("#downvoteArr").removeClass('text-secondary');
                        $("#downvoteArr").addClass('text-danger');
                    })
                    $('#downvoteArr').mouseleave(function () {
                        $("#downvoteArr").addClass('text-secondary');
                        $("#downvoteArr").removeClass('text-danger');
                    })

                    var options = [];

                    $('.dropdown-menu a').on('click', function (event) {

                        var $target = $(event.currentTarget),
                                val = $target.attr('data-value'),
                                $inp = $target.find('input'),
                                idx;

                        if ((idx = options.indexOf(val)) > -1) {
                            options.splice(idx, 1);
                            setTimeout(function () {
                                $inp.prop('checked', false)
                            }, 0);
                        } else {
                            options.push(val);
                            setTimeout(function () {
                                $inp.prop('checked', true)
                            }, 0);
                        }

                        $(event.target).blur();

                        return false;
                    });

                </script>
                <script src="./assets/js/bars.js"></script>
                </body>

                </html>
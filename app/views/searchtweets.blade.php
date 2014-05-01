<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Emotionals Tweets</title>
        {{ HTML::style('tb/css/bootstrap.min.css') }}
        {{ HTML::style('tb/css/bootstrap-theme.min.css') }}
        {{ HTML::script('tb/js/bootstrap.min.js') }}
    </head>
    <body>
        <h1>Search for tweets.</h1>

        <div class="row">
            {{ Form::open(array('url'=>'/', 'class'=>'form-search', 'role'=>'form', 'method' => 'post')) }}
            <div class="col-lg-6">
                <div class="input-group">
                    {{ Form::text('q', $q, array('class'=>'form-control', 'placeholder'=>'Search term or hash tag.'))}}
                    <span class="input-group-btn">
                        {{ Form::submit('Search', array('class'=>'btn btn-default'))}}
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
            {{ Form::close() }}
        </div><!-- /.row -->
        <p>Looking for searching by  <a href="{{URL::to('/screen_name')}}">screen_name?</a></p>
        <br/>

        <div class="twitter">
            @if(!empty($tweets))       

            @foreach($tweets as $tweet)
            <div class="row">
                <div class="col-lg-6">
                    <div class="twitter-block">
                        <span class="badge pull-right">{{$tweet['emotion']}}</span>
                        {{$tweet['name']}} ({{Twitter::linkify('@'.$tweet['screen_name'])}})
                        <p>{{Twitter::linkify($tweet['text'])}}</p>
                        <span class="timeago" title="{{$tweet['created_at']}}">{{ date('H:i, M d', strtotime($tweet['created_at'])) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            @if(Request::isMethod('post'))
            <p>We are having a problem with our Twitter Feed right now.</p>
            @endif
            @endif
        </div>

    </body>
</html>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Emotionals Tweets</title>
        {{ HTML::style('tb/css/bootstrap.min.css') }}
        {{ HTML::style('tb/css/bootstrap-theme.min.css') }}
        {{ HTML::style('css/styles.css') }}
        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('tb/js/bootstrap.min.js') }}
        {{ HTML::script('js/jquery.timeago.js') }}
        {{ HTML::script('js/scripts.js') }}
    </head>
    <body>
        <div class="container">
            <h1>Search for tweets:</h1>

            <div class="row">
                {{ Form::open(array('url'=>'/', 'class'=>'form-search', 'role'=>'form', 'method' => 'post')) }}
                <div class="col-md-6">
                    <div class="input-group">
                        {{ Form::text('q', e($q), array('class'=>'form-control', 'placeholder'=>'Search term or hash tag.'))}}
                        <span class="input-group-btn">
                            {{ Form::submit('Search', array('class'=>'btn btn-default'))}}
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                {{ Form::close() }}
            </div><!-- /.row -->
            
            <br/>

            <div class="twitter">
                @if(!empty($tweets))       

                @foreach($tweets as $tweet)
                <?php
                $emotionClass = '';
                switch ($tweet['emotion']):
                    case "Sad": $emotionClass = 'alert-danger';
                        break;
                    case "Indifferent": $emotionClass = '';
                        break;
                    case "Happy": $emotionClass = 'alert-success';
                        break;
                endswitch;
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="twitter-block">
                            @if(!empty($tweet['profile_image_url']))
                            <div class="pull-left twitter-img">
                                <img src="{{$tweet['profile_image_url']}}" class="img-responsive" alt="Profile image">
                            </div>
                            @endif

                            <span class="badge pull-right <?php echo $emotionClass; ?> ">{{$tweet['emotion']}}</span>
                            <strong>{{$tweet['name']}}</strong> ({{Twitter::linkify('@'.$tweet['screen_name'])}})
                            <small class="text-muted timeago" title="{{$tweet['created_at']}}"><i class="glyphicon glyphicon-time"></i>
                                {{ date('H:i, M d', strtotime($tweet['created_at'])) }}
                            </small>
                            <p>{{Twitter::linkify($tweet['text'])}}</p>


                        </div>
                        <hr/>
                    </div>

                </div>

                @endforeach
                @else
                @if(Request::isMethod('post'))
                <p>We are having a problem with our Twitter Feed right now.</p>
                @endif
                @endif
            </div>
        </div>
    </body>
</html>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Emotionals Tweets :: Demo</title>
        {{ HTML::style('tb/css/bootstrap.min.css') }}
        {{ HTML::style('tb/css/bootstrap-theme.min.css') }}
        {{ HTML::style('css/styles.css') }}
        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('tb/js/bootstrap.min.js') }}
        {{ HTML::script('js/jquery.timeago.js') }}
        {{ HTML::script('js/scripts.js') }}
    </head>
    <body class="dark-page">
        <div class="container">

            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <h1><a href="{{URL::to('/')}}"><img src="/img/logo.png" class="img-responsive bsa-logo" /></a></h1>
                </div>  
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="tweets-panel">
                        <h1>Search for tweets:</h1>
                        @if( count($errors->all()) )
                        <div class="alert alert-danger fade in">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <div class="row-fluid">
                            {{ Form::open(array('url'=>URL::to('/search'), 'class'=>'form-search', 'role'=>'form', 'method' => 'post')) }}
                            <div class="input-group">
                                {{ Form::text('q', e($q), array('class'=>'form-control', 'placeholder'=>'Search term or hash tag.'))}}
                                <span class="input-group-btn">
                                    {{ Form::submit('Search', array('class'=>'btn btn-default'))}}
                                </span>
                            </div>
                            {{ Form::close() }}
                        </div>

                        <div class="twitter">
                            @if(is_array($tweets))       

                            @foreach($tweets as $tweet)

                            <?php
                            $emotionClass = '';
                            switch ($tweet['emotion']) {
                                case "Sad": $emotionClass = 'alert-danger';
                                    break;
                                case "Indifferent": $emotionClass = '';
                                    break;
                                case "Happy": $emotionClass = 'alert-success';
                                    break;
                            }
                            ?>
                            <div class="row">
                                <div class="col-xs-12">
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
                </div>
                <div class="col-md-3">
                    <div class="score-panel">
                        <p>emotional state</p>
                        <hr />
                        <div class="row-fluid">
                            <div class="col-xs-4"><img src="/img/analysis-face-1.png" alt="-" class="img-responsive center-block" /></div>
                            <div class="col-xs-4"><img src="/img/analysis-face-2.png" alt="0" class="img-responsive center-block" /></div>
                            <div class="col-xs-4"><img src="/img/analysis-face-3.png" alt="+" class="img-responsive center-block" /></div>
                            <p>Bar charts, Avarage score...</p>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; 2014 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
            </footer>

        </div>
    </body>
</html>

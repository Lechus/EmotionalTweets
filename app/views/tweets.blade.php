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
	{{ Form::open(array('url'=>'/', 'class'=>'form-search', 'role'=>'form', 'method' => 'get')) }}
	<div class="col-lg-6">
		<div class="input-group">
			{{ Form::text('q', '', array('class'=>'form-control', 'placeholder'=>'Search by screen_name only.'))}}
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
                    <div class="twitter-block">
                        {{$tweet->user->name}} ({{Twitter::linkify('@'.$tweet->user->screen_name)}})
                        <p>{{Twitter::linkify($tweet->text)}}</p>
                        <span class="timeago" title="{{$tweet->created_at}}">{{ date('H:i, M d', strtotime($tweet->created_at)) }}</span>
                    </div>
                @endforeach
            @else
            <p>We are having a problem with our Twitter Feed right now.</p>
            @endif
        </div>

    </body>
</html>

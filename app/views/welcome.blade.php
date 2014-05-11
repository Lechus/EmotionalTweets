<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Emotionals Tweets :: Welcome</title>
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
                    <h1><img src="/img/logo.png" class="img-responsive bsa-logo" /></h1>
                </div>  
            </div>  
            <div class="row">
                <div class="col-xs-12">
                    <img src="/img/header.png" class="img-responsive" alt="Do they love you? we can tell you that!" />
                </div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-xs-12">
                    <p class="marketing-intro">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
                </div>
            </div><!-- /.row -->

            <div class="container marketing">
                <div class="row">
                    <div class="col-lg-4">
                        <img class="img-face" alt="face1" style="width: 69px; height: 69px;" src="/img/icon-face-1.png">
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-face" alt="face2" style="width: 69px; height: 69px;" src="/img/icon-face-2.png">
                        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-face" alt="face3" style="width: 69px; height: 69px;" src="/img/icon-face-3.png">
                        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    </div>
                </div>
            </div>
            
                <div class="row">
                    <div class="col-lg-8">
                        <p class="call-to-action">Check our demo analysis</p>
                    </div>
                    <div class="col-lg-4">
                        <a href="{{URL::to('/search')}}" id="btn-go">Go!</a>
                    </div>
                </div>
            
            <footer>
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; 2014 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
            </footer>

        </div>
    </body>
</html>

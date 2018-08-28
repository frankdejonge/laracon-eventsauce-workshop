<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #cat-head {
                /*height: 450px;*/
                /*width: 406px;*/
                /*background: url("/images/cat-head.png") no-repeat;*/
                /*background-size: 50%;*/
                /*position: fixed;*/
                /*bottom: -50px;*/
                /*left: -50px;*/
            }
        </style>
    </head>
    <body>
        <div id="cat-head"></div>
        <div class="flex-center position-ref full-height">
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>

            <div class="content">
                <img src="/images/cat-head.png" alt="" height="225px" width="203px"/>
                <div class="title m-b-md">
                    LaraCats
                </div>
                <div class="links">
                    <a href="#">Event</a>
                    <a href="#">Sourcing</a>
                    <a href="#">Totally</a>
                    <a href="#">Rocks</a>
                </div>
            </div>
        </div>
    </body>
</html>

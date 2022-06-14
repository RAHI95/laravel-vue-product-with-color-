<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div id="app">
            <app-header></app-header>
            <router-view></router-view>
        </div>

        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>

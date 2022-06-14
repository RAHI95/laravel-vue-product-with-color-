<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>public</title>
</head>
<body>
    <div id="app">
        <h1>Hello App!</h1>
        <p>
          <!-- use router-link component for navigation. -->
          <!-- specify the link by passing the `to` prop. -->
          <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
          <router-link to="/foo">Go to Foo</router-link>
          <router-link to="/bar">Go to Bar</router-link>
        </p>
        <!-- route outlet -->
        <!-- component matched by the route will render here -->
        <router-view></router-view>
    </div>


    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FM NEWS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
        <link rel="stylesheet" href="//getbootstrap.com/docs/4.5/examples/blog/blog.css" >

        @yield('css')


    </head>

    <body>

    <div class="container">

   @include('Backend.layout.partials.nav-bar')

   @yield('jumbotron')

<main role="main" class="container">
  <div class="row">
  @include('Backend.layout.partials.sidebar')
    <div class="col-md-10 blog-main">

       @yield('container')

    </div><!-- /.blog-main -->

  </div><!-- /.row -->



 </main><!-- /.container -->
</div>

   @include('partials.footer')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   @yield('script')



</body>
</html>

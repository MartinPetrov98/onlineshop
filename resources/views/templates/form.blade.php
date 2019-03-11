<!DOCTYPE html>
<html>
    <head>

        @if(session()->has('username'))


        <script type="text/javascript">
            window.location.href = '{{url("/")}}';
        </script>

        @endif

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> @yield('title')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('js/app.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('js/jQuery.js') }}"  type="text/javascript"></script>


    </head>

    <header id="header"></header>



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="Category/IT">IT</a>
                        <a class="dropdown-item" href="Category/Fashion">Fashion</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="Category/About">About</a>
                    </div>
                </li>

            </ul>


            <span id='u-links' >
                <a href="{{ url('register') }}">Register</a>/
                <a href="{{ url('login') }}">Login</a> 
            </span>

            <form class="form-inline my-2 my-lg-0" method="GET" action="{{url('search')}}">

                <input name="gb-search" class="form-control mr-sm-2"  type="search" placeholder="Search" aria-label="Search">
                <button  class="btn btn-outline-success my-2 my-sm-0" value="bsubmit" type="submit" >Search</button>
            </form>
        </div>

        <!-- TO DO SHOPPING CART TO THE LEFT OF THE SEARCH FIELD AND Login/Register link and if the person is logged to show his username there -->
    </nav>



    <section id="form">
        @yield('form')
    </section>









    <footer id="footer">&copy; Copyright all rights reserved!</footer> 
</body>
</html>














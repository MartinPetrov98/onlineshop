<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> @yield('title')</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('js/app.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('js/jQuery.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('js/style.js') }}"  type="text/javascript"></script>
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>












    </head>
    <body>
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
                            <a class="dropdown-item" href="{{ url('Category/IT') }}">IT</a>
                            <a class="dropdown-item" href="{{ url('Category/Fashion') }}">Fashion</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('category/about') }}">About</a>
                        </div>
                    </li>
                    @if(session()->has('msg'))
                        {{ session()->get('msg') }}
                    @endif

                    @if(session()->has('err'))
                       <div style="margin-top:8px;font-weight: bold;">  {{ session()->get('err') }}   </div>
                    @endif

                </ul>



                <a href="{{url('Cart')}}" id="shopping-cart-img">
                    <span>Cart </span>
                </a>
                        <div id="shopping-div">



                            <div id="items">
                                    <?php

                                    $total = [];
                                     $uv = [];
                                    $i = '';
                                    $inc = '';
                                    $c = '';
                                    $totalqty = 0;



                                if(session()->has('test')){

                                    $sessdata = session()->get('test');

                                    $counts = array_count_values(array_column($sessdata, "id"));



                                    foreach ($sessdata as $v2) {


                                        $uv[$v2['id']]['id'] = $v2['id'];
                                        $uv[$v2['id']]['title'] = $v2['title'];
                                        $uv[$v2['id']]['prize'] = $v2['prize'];
                                        $uv[$v2['id']]['image'] = $v2['image'];
                                        $uv[$v2['id']]['quantity'] = $v2['quantity'];

                                    }


                                    foreach ($uv as  $v){

                                        $i++;


                                   if($counts[$v['id']] == 1){
                                      $v['quantity'] = $counts[$v['id']] * $counts[$v['id']]  ;

                                   }
                                    else{
                                        $v['quantity'] = ($v['quantity'] + $counts[$v['id']]);
                                       }






                                   if($v['quantity']>1){
                                       $c = (int)$v['quantity'];
                                     $total[$i] =  ($v['prize'] = $v['prize'] * $c);

                                   }

                                        $total[$i] =+ (int)$v['prize'];



                                    echo "

                                         <span  class='quantity'>".$v['quantity']."   </span>
                                          <span class='titles'><a href=".url("item/".$v['id']."  ")."> ". $v['title'] ." </a>  </span>
                                             <span ><img class='cimage' src=". $v['image'] ." >  </span>
                                          <span class='cprize'>". $v['prize'] ."   </span>


                                            <form method='post'  action=" .url("remove/".$v['id']."  ") ." >
                                              <input type='hidden' name='_token' id='csrf-token' value=" .Session::token(). " />
                                            <input type='hidden' name='_method' value='DELETE'>
                                            <button class='delete' type='submit'>delete</button>
                                            </form>






                                   ";





                                    }


                                }
                               /*
                                *
                               
                                */
                                if((int)$total > 0){
                                    echo "   <span style='float:right'>Total:   ".array_sum($total)." </span> ";
                                }
                                ?>





                            </div>
                            <br><br>
                               <div class="total"></div>



                        </div>




                @if(session()->has('username'))



                    <span class="user-name"> <a href="{{ url("user")    }} "> {{Session::get('username')}} </a>  </span>

                    <a href="{{url('exit')}}">Exit</a>
                    `
                    <!-- to do a drop down menu here with settings for users and other things -->

                @else
                    <span id='u-links' >
                    <a href="{{ url('register') }}">Register</a>/
                    <a href="{{ url('login') }}">Login</a>
                    </span>

                @endif






              <form class="form-inline my-2 my-lg-0" method="GET" action="{{url('search')}}">

               <input name="gb-search" class="form-control mr-sm-2"  type="search" placeholder="Search" aria-label="Search">
                <button  class="btn btn-outline-success my-2 my-sm-0" value="bsubmit" type="submit" >Search</button>
              </form>





            </div>



        </nav>




        <aside id="aside">

            @yield('side-bar')
        </aside>

        <section id="section">
            @yield('content')
            <article id="article">@yield('article')</article>
        </section>


        <footer id="footer">&copy; Copyright all rights reserved!</footer> 
    </body>
</html>


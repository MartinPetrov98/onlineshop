@extends('app')

@section('title', 'Home')





@section('side-bar')

<li>
<?php
    foreach ($data as $row){
    echo  "<ul><a href='Category/$row->categories'>$row->categories</a> </ul>";
    }

?>
 




</li>
@endsection




@section('content')


@section('article')
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">

      <div class="carousel-item active">
          <a href="Category/IT"   ><img class="d-block w-100" src="{{ asset('slider-imgs/imgad1.jpg') }}" alt="First slide">  </a>
      </div>



  @foreach($imgs as $img)

              <div class='carousel-item'>
                  <a href='Category/{{$img->categories}}'   ><img class="d-block w-100" src="{{asset("$img->imgsrc")}}" alt="slider">  </a>

              </div>

      @endforeach




  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


@endsection
@endsection
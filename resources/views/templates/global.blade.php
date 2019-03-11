@extends('app')

@section('title', 'Global')

@section('side-bar')

         @foreach($data['categories'] as $row)
             <ul> <a href="Category/{{$row->categories}}"> {{$row->categories}} </a> </ul>

         @endforeach






@endsection


@section('content')


    <?php
    #print_r($data);
    /*

     *7. to do the profile settings and info for shipping
     *8. when the user visit the home page to do a array or connection to db to retrieve pics for the dynamic slider,
     * the to move the next and previous button out of the  div <    |div.......... /div|      >
     * 9. to do a simple admin panel
     *
     *
     */
    ?>



    @foreach($data['globalitems'] as $row)
   <form class="ajax-form" method="POST" action="{{route('addtochart')}}">

       {{csrf_field()}}

        <a href=item/{{$row->id}} class="href-item">
            <div class="item">
                <strong    class="title">{{$row->model}}</strong>

                <img id="image"  src="{{url($row->image) }}" alt=" " class="img-item" />
                <strong id="price"  class="item-price">{{$row->prize}}</strong>
                <br>
                <input type="hidden" name="id" value="{{$row->id}}">
                <input type="hidden"  name="title" value="{{$row->model}}">
                <input type="hidden" name="image" value="{{$row->image}}">
                <input type="hidden" name="prize" value="{{$row->prize}}">





        </a>
       <input class="quantity-input" type="number" name="quantity"  value="1" min="1" max="5">
       <button type="submit" name="chart-btn"  class="btn-group">Add to chart</button>
        </div>
   </form>


    @endforeach

@endsection



@extends('app')

@section('title', $sidebar[0]->categories)

@section('side-bar')

      @foreach($sidebar as $row)
      <ul> <a href="{{$sidebar[0]->categories}}/Subcategory/{{$row->product}}"> {{$row->product}} </a> </ul>

    @endforeach


@endsection



@section('content')







      @foreach($data as $row)

          <form class="ajax-form" method="POST" action="{{ route('addtochart') }}">
          {{csrf_field()}}

          <div class="item">
              <a href={{ url("item/$row->id") }} class="href-item">
              <strong   class="title">{{$row->model}}</strong>

              <img  id="image"  src="{{url($row->image) }}" alt=" " class="img-item" />
              <strong  id="price"   class="item-price">{{$row->prize}}</strong>
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









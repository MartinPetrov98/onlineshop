@extends('app')


@section('title', $data[0]->brand_name)



@section('side-bar')

  @foreach($sidebar as $row1)
      <ul> <a href="{{$row1->brand_name}}">  {{$row1->brand_name}} </a> </ul>

    @endforeach




@endsection

@section('content')

    @foreach($data as $row)
       <form class="ajax-form" method="POST" action="{{ route('addtochart') }}">
           {{csrf_field()}}

            <div class="item">
                <a href={{ url("item/$row->id") }} class="href-item">
                <strong name="title"   class="title">{{$row->model}}</strong>

                <img name="image" id="image"  src="{{url($row->image) }}" alt=" " class="img-item" />
                <strong name="price" id="price"  class="item-price">{{$row->prize}}</strong>
                <br>
                    <input type="hidden" name="id" value="{{$row->id}}">
                    <input type="hidden" name="title" value="{{$row->model}}">
                    <input type="hidden" name="image" value="{{$row->image}}">
                    <input type="hidden" name="prize" value="{{$row->prize}}">


        </a>
                <input class="quantity-input" type="number" name="quantity"  value="1" min="1" max="5" >
           <button type="submit" name="chart-btn"  class="btn-group">Add to chart</button>
        </div>

</form>

   @endforeach


@endsection

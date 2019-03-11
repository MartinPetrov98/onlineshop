@extends('app')

@section('title',$item[0]->model)


@section('side-bar')

    @foreach($sidebar as $row)
        <ul> <a href="{{ url("Category/".$sidebar[0]->categories."/Subcategory/$row->product/Brand/$row->brand_name") }}"> {{$row->brand_name}} </a> </ul>

    @endforeach

@endsection
  <?php
     $arr = [];


  ?>
@section('content')


<div class="item-div">


    @foreach($item as $row1)

        <?php
           $arr[$row1->product_id]['model'] = $row1->model;
           $arr[$row1->product_id]['image'] = $row1->image;
        $arr[$row1->product_id]['prize'] = $row1->prize;
        $arr[$row1->product_id]['id'] = $row1->id;
        $arr[$row1->product_id]['descr'] = $row1->descr;




        ?>


    @endforeach


    @foreach($arr as $row)


        <form class="ajax-form" method="POST" action="{{ route('addtochart') }}">
            {{csrf_field()}}





                <img  id="image-div"  src="{{url($row['image']) }}" alt=" " class="img-item" />
                <strong   class="title-div">{{$row['model']}}</strong>
                <br>
                <div class="desc">
                    {{$row['descr']}}

                </div>

                <br>
                <input type="hidden" name="id" value="{{$row['id']}}">
                <input type="hidden"  name="title" value="{{$row['model']}}">
                <input type="hidden" name="image" value="{{$row['image']}}">
                <input type="hidden" name="prize" value="{{$row['prize']}}">





                <div class="pab">
                    <strong  id="price"   class="div-prize">Prize: {{$row['prize']}}</strong>
                    <br>
                    <input class="quantity-input" type="number" name="quantity"  value="1" min="1" max="5">
                    <button type="submit" name="chart-btn"  class="btn-group">Add to chart</button>

                </div>


        </form>

            <br> <br> <br> <br>
            <br> <br> <br> <br> <br> <br> <br> <br> <br>
        <form method="POST" action="{{ route('postcomment') }}">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{$row['id']}}">


            @if(!session()->has('username'))
           <span style="float:left;">
                <label for="username">Username</label>

                <input type="text" name="username" >



           </span>

            @else


                <input type="hidden"  name="user_id" value="{{ session()->get('user_id')[0]->user_id }}">

                <input type="hidden" name="username" value="{{ session()->get('username') }}">
                <br>


            @endif


<br>
<br>
            <label class="comment-label" for="textarea">
               Comment
            </label>
            <br>

            <textarea name="comment" class="textarea" rows="4" cols="100">

              </textarea>
            <button class="btn-cmt" type="submit" >Post comment</button>

        </form>
        <br><br><br><br>
    @endforeach

    @foreach($item as $comment)
      @if(!empty($comment->comment))
          <div class="comments">
              <p style="float:left;">
               Име:    {{$comment->username}}

                    <br>

                  {{$comment->comment}}

              </p>


          </div>


      @endif


    @endforeach

</div>


    @endsection




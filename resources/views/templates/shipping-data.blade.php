@extends('app')

@section('title','Shipping')


@section('side-bar')

    <button type="submiot" onclick="window.history.go(-1)">Go Back</button>

@endsection


@section('content')


    @if(!empty($data))
            <div id="shipping-div">
                <form method="POST" action="<?= url('Редактирай')?>">
                    {{csrf_field()}}

                    <br>
                        <h2>Shipping Data</h2>
                    <label>City</label>  <input type="text" value="{{$data[0]->City}}" name="City" pattern="[A-Z,a-z]{A-Z,a-z}" title="From A to Z"> <br>
                    <label>ZIP Code</label><input type="text" value="{{$data[0]->Zip}}" name="zipcode" pattern="[0-9]{4}" title="Four digit zip code" /> <br>
                    <label>Street</label><input type="text" value="{{$data[0]->Street}}" name="street"> <br>
                    <label>Phone number</label><input type="tel" value="{{$data[0]->Phone}}" name="phone" pattern="[0-9]{10}" title="It must contain 10 digits"> <br>
                    <label>FirstName</label><input type="text" value="{{$data[0]->Firstname}}" name="f-name" pattern="[A-Z,a-z]{A-Z,a-z}"> <br>
                    <label>LastName</label><input type="text" value="{{$data[0]->Surname}}" name="l-name" pattern="[A-Z,a-z]{A-Z,a-z}"> <br>


                  <input type="submit" value="Редактирай">


                </form>
            </div>

        @else
        <div id="shipping-div">
            <form method="POST" action="<?= url('AddShippingAdress')?>">
                {{csrf_field()}}
                <br>
                <h2>Shipping Data</h2>
                <label>City</label>  <input type="text"  name="City" pattern="[A-Z,a-z]{A-Z,a-z}" title="From A to Z"> <br>
                <label>ZIP Code</label><input type="text"  name="zipcode" pattern="[0-9]{4}" title="Four digit zip code" /> <br>
                <label>Street</label><input type="text"  name="street"> <br>
                <label>Phone number</label><input type="tel"  name="phone" pattern="[0-9]{10}" title="It must contain 10 digits"> <br>
                <label>FirstName</label><input type="text"  name="f-name" pattern="[A-Z,a-z]{A-Z,a-z}"> <br>
                <label>LastName</label><input type="text"  name="l-name" pattern="[A-Z,a-z]{A-Z,a-z}"> <br>


                <input type="submit" value="Добави адрес">


            </form>
        </div>


      @endif


@endsection

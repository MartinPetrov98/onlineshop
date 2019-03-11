@extends('app')

@section('title','Cart')


@section('side-bar')

   <button type="submiot" onclick="window.history.go(-1)">Go Back</button>

@endsection


@section('content')


    <div id="items">
        <?php
         $counts ='';
        $total = [];
        $uv = [];

        $i = '';
        $inc = '';
        $c = '';
        $tai = [];


        if(session()->has('test')){
            $sessdata = session()->get('test');
            $counts = array_count_values(array_column($sessdata, "id"));
            foreach ($sessdata as $v2) {
                $uv[$v2['id']]['id'] = $v2['id'];
                $uv[$v2['id']]['title'] = $v2['title'];
                $uv[$v2['id']]['prize'] = $v2['prize'];
                $uv[$v2['id']]['image'] = $v2['image'];
                $uv[$v2['id']]['quantity'] = $v2['quantity'];

               $tai[$v2['id']]['id'] = $v2['id'];
               $tai[$v2['id']]['title'] = $v2['title'];
            }
            foreach ($uv as  $v){
                $i++;
                if($counts[$v['id']] == 1){
                    $v['quantity'] =($counts[$v['id']] * $v['quantity']);
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

                                         <span  class='quantity'>". $v['quantity'] ."   </span>
                                          <span class='titles'><a href=".url("item/".$v['id']."  ")."> ". $v['title'] ." </a>  </span>
                                             <span ><img class='cimage' src=". $v['image'] ." >  </span>
                                          <span class='cprize'>". $v['prize'] ."   </span>


                                            <form method='post'  action=" .url("remove/".$v['id']."  ") ." >
                                              <input type='hidden' name='_token' id='csrf-token' value=" .Session::token(). " />
                                            <input type='hidden' name='_method' value='DELETE'>
                                            <button type='submit'>delete</button>
                                            </form>


                                   ";
            }
        }
        if((int)$total > 0){
         echo "   <span style='float:right'>Total:   ".array_sum($total)."




                  </span> "




         ;



        }
        ?>





          @if((int)$total >0)
              @if(!empty($sh))



        <br>

            <div id="shipping-div">
          <form id="form1" method="POST" action="<?= url('Order')?>">
              {{csrf_field()}}

             <input type="hidden" name="qty" value=" <?= serialize($counts)?>">
              <input type="hidden" name="items" value=" <?= http_build_query($tai)?>">
              <input type="hidden" name="total-prize" value="<?=  array_sum($total)?>">
              <br>

              <label>City</label>  <input type="text"  value="{{$sh[0]->City}}" name="City" pattern="[A-Z,a-z]{A-Z,a-z}" title="From A to Z"> <br>
              <label>ZIP Code</label><input type="text"  value="{{$sh[0]->Zip}}"  name="zipcode" pattern="[0-9]{4}" title="Four digit zip code" /> <br>
              <label>Street</label><input type="text" value="{{$sh[0]->Street}}" name="street"> <br>
              <label>Phone number</label><input type="tel" value="{{$sh[0]->Phone}}" name="phone" pattern="[0-9]{10}" title="It must contain 10 digits"> <br>
              <label>FirstName</label><input type="text" value="{{$sh[0]->Firstname}}"  name="f-name" pattern="[A-Z,a-z]{A-Z,a-z}"> <br>
              <label>LastName</label><input type="text" value="{{$sh[0]->Surname}}"   name="l-name" pattern="[A-Z,a-z]{A-Z,a-z}"> <br>






              <script>
                   var totalvar = '<?php echo array_sum($total) ;?>';

                  // Render the PayPal button

                  paypal.Button.render({

                      // Set your environment

                      env: 'sandbox', // sandbox | production

                      // Specify the style of the button

                      style: {
                          label: 'checkout',
                          size:  'small',    // small | medium | large | responsive
                          shape: 'pill',     // pill | rect
                          color: 'gold'      // gold | blue | silver | black
                      },

                      // PayPal Client IDs - replace with your own
                      // Create a PayPal app: https://developer.paypal.com/developer/applications/create

                      client: {
                          sandbox:    'AWx0PzuNexbso3L1BC0FZucduwv0mj2KvhOOq7nh0XJyM4dtI9AEftVjwg2wWDFh_gF_aYx_deYFkjtm',
                          production: 'OnlineMarket'
                      },

                      payment: function(data, actions) {
                          return actions.payment.create({
                              payment: {
                                  transactions: [
                                      {
                                          amount: { total: totalvar, currency: 'USD' }
                                      }
                                  ]
                              }
                          });
                      },

                      onAuthorize: function(data, actions) {
                          return actions.payment.execute().then(function() {
                              window.alert('Payment Complete!');
                              //window.location.replace("Cart");
                              document.getElementById("form1").submit();

                          });
                      }

                  }, '#paypal-button-container');

              </script>


                  <div id="paypal-button-container" ></div>




          </form>
            </div>

              @endif

            @if(session()->has('order'))
              <h1 style="align:center;"> {{ session()->get('order') }} </h1>
            @endif

            @if(session()->has('fail'))
                <h1> {{ session()->get('fail') }} </h1>


            @elseif(empty($sh))

                      <br>

                      <div id="shipping-div">
                          <form method="POST" action="<?= url('Order')?>">
                              {{csrf_field()}}

                              <input type="hidden" name="qty" value=" <?= serialize($counts)?>">
                              <input type="hidden" name="items" value=" <?= http_build_query($tai)?>">
                              <input type="hidden" name="total-prize" value="<?=  array_sum($total)?>">
                              <br>

                              <label>City</label>  <input type="text"   name="City" pattern="[A-Z,a-z]{A-Z,a-z}" title="From A to Z"> <br>
                              <label>ZIP Code</label><input type="text"  name="zipcode" pattern="[0-9]{4}" title="Four digit zip code" /> <br>
                              <label>Street</label><input type="text"  name="street"> <br>
                              <label>Phone number</label><input type="tel"  name="phone" pattern="[0-9]{10}" title="It must contain 10 digits"> <br>
                              <label>FirstName</label><input type="text"   name="f-name" pattern="[A-Z,a-z]{A-Z,a-z}"> <br>
                              <label>LastName</label><input type="text"    name="l-name" pattern="[A-Z,a-z]{A-Z,a-z}"> <br>



                              <button type="submit" style="float:right;margin-right: 25px;">Pay</button>
                          </form>
                      </div>

                  @endif



            @endif
            @if(session()->has('order'))
                <h1 style="align:center;"> {{ session()->get('order') }} </h1>
            @endif

            @if(session()->has('fail'))
                <h1> {{ session()->get('fail') }} </h1>



            @endif



    </div>
  @endsection




$(document).ready(function() {


    $('#shopping-cart-img').mouseover(function(){
        $('#shopping-div').toggle();

        cartimg = this.serialize();


    });




     /*
           $(".ajax-form").submit(function (e) {
               e.preventDefault();
                sentdata = $(this).serialize();

           $.ajax({
               headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               type:"POST",
               ContentType: 'application/json',
               data: sentdata,

               success: function(data) {
                   var title = JSON.stringify(data.jsondata.title);
                   var image = JSON.stringify(data.jsondata.image);
                   var prize = JSON.stringify(data.jsondata.prize);
                   var quantity =JSON.stringify(data.jsondata.quantity);

                   var rtitle = title.replace(/['"]+/g, '');
                   var rprize = prize.replace(/['"]+/g, '');
                   var rquantity = quantity.replace(/['"]+/g, '');


                     $(".quantity").append(rquantity+'<br>');
                      $(".titles").append(rtitle+'<br>');
                       $(".cprize").append(rprize+'<br>');
                   $(".c1image").append("<img class='cimage' src="+image+"/> <br>");


           },fail: function (){
               alert('problem')}
           });

       });
      */

});


/*
$('.cprize').blur(function () {
    sum = 0;
    $('.cprize').each(function() {
        sum += Number($(this).val());
    });

    // here, you have your sum
});​​​​​​​​​

*/

























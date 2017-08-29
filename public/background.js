

$(document).ready(function(){

  var image_count = 0;
  var image_array = new Array();
  image_array[0] = 'main1.jpg';
  image_array[1] = 'main2.jpg';
  image_array[2] = 'main3.jpg';
  image_array[3] = 'main4.jpg';
  image_array[4] = 'main5.jpg';


  function start(){
      setInterval(image_change,6000);
   }

  function image_change(){

    //  $( '#header' ).css({"background-image":"url(/php/shopping_mall/public/images/main1.jpg)"});

    $('#header')
    .animate({opacity: 0}, 200, function() {
        $(this)
            .css({'background-image': "url(/php/shopping_mall/public/images/"+image_array[image_count]+")"})
            .animate({opacity: 1});
    });

    //  $( '#header' ).css({"background-image":"url(/php/shopping_mall/public/images/"+image_array[image_count]+")"});
    //  console.log(image_count);

     image_count++;
     if(image_count ==5){image_count = 0;}
  }

  // start();

  // $( '#header' ).css({"background-image":"url(/php/shopping_mall/public/images/main1.jpg)"});

});

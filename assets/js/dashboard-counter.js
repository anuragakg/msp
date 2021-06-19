$(function(){

      var pending_count = $('.counter-area').find('.pending_count').text();
       if(pending_count!=''){
           $(".pending_count").counterUp({delay:10,time:1000});
       }

       var approved_count = $('.counter-area').find('.approved_count').text();
       if(approved_count!=''){
           $(".approved_count").counterUp({delay:10,time:1000});
       }

       var tribal_gatherers = $('.counter-area').find('.tribal_gatherers').text();
       if(tribal_gatherers!=''){
           $(".tribal_gatherers").counterUp({delay:10,time:1000});
       }

       var shg_group = $('.counter-area').find('.shg_group').text();
       if(shg_group!=''){
           $(".shg_group").counterUp({delay:10,time:1000});
       }

       var ware_houses = $('.counter-area').find('.ware_houses').text();
       if(ware_houses!=''){
           $(".ware_houses").counterUp({delay:10,time:1000});
       }

       var haat_market = $('.counter-area').find('.haat_market').text();
       if(haat_market!=''){
           $(".haat_market").counterUp({delay:10,time:1000});
       }

       var surveyor = $('.counter-area').find('.surveyor').text();
       if(surveyor!=''){
           $(".surveyor").counterUp({delay:10,time:1000});
       }

       var supervisor = $('.counter-area').find('.supervisor').text();
       if(supervisor!=''){
           $(".supervisor").counterUp({delay:10,time:1000});
       }
       
  });
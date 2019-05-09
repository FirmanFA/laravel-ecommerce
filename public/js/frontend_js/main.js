(function($) {
  "use strict"

  // NAVIGATION
  var responsiveNav = $('#responsive-nav'),
    catToggle = $('#responsive-nav .category-nav .category-header'),
    catList = $('#responsive-nav .category-nav .category-list'),
    menuToggle = $('#responsive-nav .menu-nav .menu-header'),
    menuList = $('#responsive-nav .menu-nav .menu-list');

  catToggle.on('click', function() {
    menuList.removeClass('open');
    catList.toggleClass('open');
  });

  menuToggle.on('click', function() {
    catList.removeClass('open');
    menuList.toggleClass('open');
  });

  $(document).click(function(event) {
    if (!$(event.target).closest(responsiveNav).length) {
      if (responsiveNav.hasClass('open')) {
        responsiveNav.removeClass('open');
        $('#navigation').removeClass('shadow');
      } else {
        if ($(event.target).closest('.nav-toggle > button').length) {
          if (!menuList.hasClass('open') && !catList.hasClass('open')) {
            menuList.addClass('open');
          }
          $('#navigation').addClass('shadow');
          responsiveNav.addClass('open');
        }
      }
    }
  });

  // HOME SLICK
  $('#home-slick').slick({
    autoplay: true,
    infinite: true,
    speed: 300,
    arrows: true,
  });

  // PRODUCTS SLICK
  $('#product-slick-1').slick({
    slidesToShow: 3,
    slidesToScroll: 2,
    autoplay: true,
    infinite: true,
    speed: 300,
    dots: true,
    arrows: false,
    appendDots: '.product-slick-dots-1',
    responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 480,
        settings: {
          dots: false,
          arrows: true,
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
    ]
  });

  $('#product-slick-2').slick({
    slidesToShow: 3,
    slidesToScroll: 2,
    autoplay: true,
    infinite: true,
    speed: 300,
    dots: true,
    arrows: false,
    appendDots: '.product-slick-dots-2',
    responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 480,
        settings: {
          dots: false,
          arrows: true,
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
    ]
  });

  // PRODUCT DETAILS SLICK
  $('#product-main-view').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-view',
  });

  $('#product-view').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    asNavFor: '#product-main-view',
  });

  // PRODUCT ZOOM
  $('#product-main-view .product-view').zoom();

  // PRICE SLIDER
  var slider = document.getElementById('price-slider');
  if (slider) {
    noUiSlider.create(slider, {
      start: [1, 999],
      connect: true,
      tooltips: [true, true],
      format: {
        to: function(value) {
          return value.toFixed(2) + '$';
        },
        from: function(value) {
          return value
        }
      },
      range: {
        'min': 1,
        'max': 999
      }
    });
  }

})(jQuery);

$(document).ready(function(){
  $("#selSize").change(function(){
    var idsize = $(this).val();

    if(idsize == ""){
      return false;
    }
    $.ajax({
      type:'get',
      url:'/get-product-price',
      data:{idsize:idsize},
      success:function(resp){
        // alert(resp);
        $("#getPrice").html("RP. "+resp);
        $("#price").val(resp);
        
      },error:function(resp,xhr){
        alert(xhr.responseText);
      }
    });
    $.ajax({
      type:'get',
      url:'/get-product-stock',
      data:{idsize:idsize},
      success:function(resp){
        // alert(resp);
        $("#productStock").html("Availability : "+ resp);
        $("#productqty").on('change',function(e){
          var total_stock = resp;
          if($(this).val() > total_stock ){
            $(this).val(total_stock);
          }
        })
        
      },error:function(resp,xhr){
        alert(xhr.responseText);
      }
    });
  })

  // $("#quantity").focusout(function(){
  //   var current = $(this).val;

  // });

  $().ready(function(){
    $("#current_pwd").keyup(function(){
      var current_pwd = $(this).val();
      // alert(current_pwd);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'post',
        url:'/check-user-pwd',
        data:{current_pwd:current_pwd},
        success:function(resp){
          // alert(resp);
          if(resp=="false"){
            $("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
          }else if(resp=="true"){
            $("#chkPwd").html("<font color='green'>Current Password is correct</font>");
          }
        },error:function(){
          alert("error");
        }
      })
    });
    
  });

  // $("#new_pwd").change(function(){
  //   if( $("#new_pwd").val() != $("#confirm_pwd").val()) {
  //     $("#confirm_pwd").setCustomValidity("Passwords Don't Match");
  //   } else {
  //     $("#confirm_pwd").setCustomValidity('');
  //   }
  // });

  // $("#confirm_pwd").keyup(function(){
  //   if( $("#new_pwd").val() != $("#confirm_pwd").val()) {
  //     $("#confirm_pwd").setCustomValidity("Passwords Don't Match");
  //   } else {
  //     $("#confirm_pwd").setCustomValidity('');
  //   }
  // });

  var password = document.getElementById("new_pwd")
  , confirm_password = document.getElementById("confirm_pwd");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
  $("#new_pwd").change(function(){
    validatePassword();
  })
  $("#confirm_pwd").change(function(){
    validatePassword();
  })
// password.onchange = validatePassword;
// confirm_password.onkeyup = validatePassword;

  $("#samewbill").click(function(){
    if(this.checked){
      // alert("test");
      $("#shipping_name").val($("#billing_name").val());
      $("#shipping_address").val($("#billing_address").val());
      $("#shipping_city").val($("#billing_city").val());
      $("#shipping_state").val($("#billing_state").val());
      $("#shipping_country").val($("#billing_country").val());
      $("#shipping_zipcode").val($("#billing_zipcode").val());
      $("#shipping_mobile").val($("#billing_mobile").val());
    }else{
      $("#shipping_name").val('');
      $("#shipping_address").val('');
      $("#shipping_city").val('');
      $("#shipping_state").val('');
      $("#shipping_country").val('');
      $("#shipping_zipcode").val('');
      $("#shipping_mobile").val('');
    }
  });

  
  
});


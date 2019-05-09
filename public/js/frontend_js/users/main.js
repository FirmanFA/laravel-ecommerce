(function($){
  $().ready(function(){
    $("#register").validate({
      rules:{
        name:{
          required:true,
          minLength:2,
          accept:"[a-aZ-Z]+"
        },
        email:{
          required:true,
          email:true,
          // remote:"check-email"
        },
        password:{
          required:true,
          minLength:6
        }
      },messages:{
        name:{
          required:"Please Enter Your Name",
          minLength:"Minimal 2 karakter"
        },
        email:{
          required:"Harap Masukan Email",
          email:"Harap masukan email dengan benar"
        },
        password:{
          required:"Please Provide Your Password",
          minLength:"Minimal 6 karakter"
        }
      }
    });
    $('#myPassword').passtrength({
      minChars: 4,
      passwordToggle: true,
      tooltip: true,
      eyeImg: "/images/frontend_images/eye.svg"
    });
  });

  

});
$(document).ready(function(){
    

    $("#newsticker").jCarouselLite({
        vertical:true,
        hoverPause:true,
        btnPrev: "#news-up",
        btnNext: "#news-down",
        visible: 3,
        auto:5300,
        speed:500
    });
    
$("#style-grid").click(function(){
        
$("#block-tovar-grid").show();       
$("#block-tovar-list").hide();   
$("#style-grid").attr("src","/immages/grid-red.png")    
$("#style-list").attr("src","/immages/list.png")   

$.cookie('select_style','grid');
})

$("#style-list").click(function(){

$("#block-tovar-grid").hide();       
$("#block-tovar-list").show();    
$("#style-list").attr("src","/immages/list-red.png")     
$("#style-grid").attr("src","/immages/grid.png")    

$.cookie('select_style','list');
})

if ($.cookie('select_style') == 'grid')
{
$("#block-tovar-grid").show();       
$("#block-tovar-list").hide(); 
$("#style-grid").attr("src","/immages/grid-red.png")    
$("#style-list").attr("src","/immages/list.png")      
}
else
{
$("#block-tovar-grid").hide();       
$("#block-tovar-list").show();    
$("#style-list").attr("src","/immages/list-red.png")     
$("#style-grid").attr("src","/immages/grid.png")           
}

$("#select-sort").click(function(){
    
    $("#sorting-list").slideToggle(200);

});

$('#block-category >  ul > li > a').click(function(){
    
    if ($(this).attr('class') != 'active'){
        
    $('#block-category >  ul > li > ul').slideUp(400);
    $(this).next().slideToggle(400);
      
      $('#block-category >  ul > li > a').removeClass('active');
      $(this).addClass('active');
      $.cookie('select_cat',$(this).attr('id'));
      
    }else
    {
       $('#block-category >  ul > li > a').removeClass('active');      
       $('#block-category >  ul > li > ul').slideUp(400); 
       $.cookie('select_cat', ''); 
    }
    
});

if ($.cookie('select_cat') != '')
{
  $('#block-category >  ul > li > #' + $.cookie('select_cat')).addClass('active').next().show();   
}

$('#gen-pass').click(function () {
  $.ajax({
    type: "POST",
    url: "/functions/genpass.php",
    dataType: "html",
    cache: false,
    success: function(data){
       $('#reg_pass'). val(data);
    }
});  
}); 

$("#reloadcapcha").click(function (){
    $('#block-capcha > img').attr("src","/reg/reg_capcha.php?r=" + Math.random());
});

$('.top-auth').toggle(
    function(){
      $(".top-auth").attr("id","active-button");
      $("#block-top-auth").fadeIn(200);
    },
    function(){
         $(".top-auth").attr("id","");
         $("#block-top-auth").fadeOut(200);
    }

);

$('#button-pass-show-hide').click(function(){
    var statuspass = $('#button-pass-show-hide').attr("class");
    
    if (statuspass == "pass-show")
    {
        $('#button-pass-show-hide').attr("class","pass-hide");
                
                var $input = $('#auth_pass');
                var change = "text";
                var rep = $("<input  placeholder='������' type='" + change +"' />")
                    .attr("id", $input.attr("id"))
                    .attr("name", $input.attr("name"))
                    .attr('class', $input.attr('class'))
                    .val($input.val())
                    .insertBefore($input);
                $input.remove();
                $input = rep;
    }else
    {
        $('#button-pass-show-hide').attr("class","pass-show");
                
                var $input = $('#auth_pass');
                var change = "password";
                var rep = $("<input  placeholder='������' type='"+ change +"'/>")
                    .attr("id", $input.attr("id"))
                    .attr("name", $input.attr("name"))
                    .attr('class', $input.attr('class'))
                    .val($input.val())
                    .insertBefore($input);
                $input.remove();
                $input = rep;  
    }
    
});


$("#button-auth").click(function(){
    var auth_login = $("#auth_login").val();
    var auth_pass = $("#auth_pass").val();
    
    
    if (auth_login == 0 ||  auth_login.length > 30)
    {
        $("#auth_login").css("borderColor", "#EC1431");
        send_login = 'no';
    }else { $("#auth_login").css("borderColor", "#DBDBDB"); send_login = 'yes'; }
    
        
    if (auth_pass == 0 ||  auth_pass.length > 15)
    {
        $("#auth_pass").css("borderColor", "#EC1431");
        send_pass = 'no';
    }else { $("#auth_pass").css("borderColor", "#DBDBDB"); send_pass = 'yes'; }
    
    
    if ($("#rememberme").prop('checked'))
    {
       auth_rememberme = 'yes';
       
    }else { auth_rememberme = 'no'; }
    
    
    if ( send_login == 'yes' && send_pass == 'yes' )
    {
       $("#button-auth").hide();
       $(".auth-loading").show();
       
        $.ajax({
           type: "POST",
           url: "/include/auth.php",
           data: "login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
           dataType: "html",
           cache: false,
           success: function(data) {
                if (data == "yes_auth" )
                {
                    location.reload();
                }else 
                {
                    $("#message-auth").slideDown(400);
                    $(".auth-loading").hide();
                    $("#button-auth").show();
                }
           }
            
        });
    }  
});

$('#remindpass').click(function(){
    $('#input-email-pass').fadeOut(200, function(){
        $('#block-remind').fadeIn(300); 
    });
});

$('#prev-auth').click(function(){
    $('#block-remind').fadeOut(200, function(){
        $('#input-email-pass').fadeIn(300); 
    });
});


$('#button-remind').click(function(){
    
    var recal_email = $("#remind-email").val();
    
    if (recal_email == "" ||  recal_email.length > 20)
    {
        $("#remind-email").css("borderColor","#FDB6B6");
    }else
    {
        $("#remind-email").css("borderColor","#DBDBDB");
        
        $("#button-remind").hide();
        $("#button-loading").show();
        
    $.ajax({
        type: "POST",
        url: "/include/remind-pass.php",
        data: "email="+recal_email,
        dataType: "html",
        cache: false,
        success: function(data) {
                if (data == "yes" )
                {
                    $("#button-loading").hide();
                    $("#button-remind").show();
                    $("#message-remind").attr("class","message-remind-succes").html("�� ��� E-mail ������ ������.").slideDown(400);
                    setTimeout("$('#message-remind').html('').hide(),$('#block-remind').hide(),$('#input-email-pass').show()", 3000);
                }else 
                {
                    $("#button-loading").hide();
                    $("#button-remind").show();
                    $("#message-remind").attr("class","message-remind-error").html(data).slideDown(400);
                }
           }
        
    });
    }
    
});
$("#auth-user-info").toggle(
    function(){
        $("#block-user").fadeIn(100);
    },
    function(){
        $("#block-user").fadeOut(100);
    }
);

$('#logout').click(function(){
    
    $.ajax({
        type: "POST",
           url: "/include/logout.php",
           dataType: "html",
           cache: false,
           success: function(data) {
            if (data == 'logout')
            {
                location.reload();
            }
            
}     
});  
});

$('#input-search').bind('textchange', function (){
    
    var input_search = $('#input-search').val();
    
if (input_search.length > 2)
{
         $.ajax({
        type: "POST",
           url: "/include/search.php",
           data: "text="+input_search,
           dataType: "html",
           cache: false,
           success: function(data) {
            if (data > '')
            {
                $("#result-search").show().html(data);
            }else
            {
               $("#result-search").hide(); 
            }
}   
});
}else
{
     $("#result-search").hide();
}
});
});
<!-- Javascript -->
<script type="text/javascript">
//navigation bar animation
var  nav = document.getElementById('nav');
      
    window.onscroll = function(){

        if (window.pageYOffset > 300) {
            nav.style.background = "black";
            nav.style.padding = "0px";
            navword.style.margin = "-30px";
            navword.style.color = "white";
        }
      	else{
      		nav.style.background = "transparent";
      		nav.style.boxShadow = "none";
      	}
      }
//end of navigation bar animation
</script>

<!-- Login/Register -->
<script>
    
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");
    var a = document.getElementById("form-box");
        
    function register(){
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "110px";
        a.style.height = "565px";
        a.style.transition = ".5s"
    }
        
    function login(){
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0px";
        a.style.height = "350px";
        a.style.transition = ".5s"
    }
    
</script>

<!-- Toggle password visibility -->

<script>
function togglePassword() {
  var x = document.getElementById("loginPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
function togglePassword2() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<script>
function togglePassword3() {
  var x = document.getElementById("repassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


<!-- Animated on Scroll -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- first carousel slider -->
<script>
    var responsiveSlider = function() {

var slider = document.getElementById("slider");
var sliderWidth = slider.offsetWidth;
var slideList = document.getElementById("posterSlider");
var count = 1;
var items = slideList.querySelectorAll("li").length;
var prev = document.getElementById("prev");
var next = document.getElementById("next");

window.addEventListener('resize', function() {
  sliderWidth = slider.offsetWidth;
});

var prevSlide = function() {
  if(count > 1) {
    count = count - 2;
    slideList.style.left = "-" + count * 1920 + "px";
    count++;
  }
  else if(count = 1) {
    count = items - 1;
    slideList.style.left = "-" + count * 1920 + "px";
    count++;
  }
};

var nextSlide = function() {
  if(count < items) {
    slideList.style.left = "-" + count * 1920 + "px";
    count++;
  }
  else if(count = items) {
    slideList.style.left = "0px";
    count = 1;
  }
};


setInterval(function() {
  nextSlide()
}, 3500);

};

window.onload = function() {
responsiveSlider();  
}


</script>

<!-- owl carousel -->
<script>
         $(".carousel").owlCarousel({
           margin: 20,
           loop: true,
           autoplay: true,
           autoplayTimeout: 2000,
           autoplayHoverPause: true,
           responsive: {
             0:{
               items:1,
               nav: false
             },
             600:{
               items:2,
               nav: false
             },
             1000:{
               items:3,
               nav: false
             }
           }
         });
</script>

<!-- top function -->
<script type="text/javascript">

var mybutton = document.getElementById("topBtn");

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

<!-- promotion and news -->
<script>
var displayPromotion = document.getElementById("promotion");
var displayNews = document.getElementById("news");

function promotion() {
    displayPromotion.style.display = "inline-flex";
    displayPromotion.style.opacity = "1";
    displayNews.style.display = "none";
    displayNews.style.opacity = "0";
    
}
    
function news() {
    displayPromotion.style.display = "none";
    displayPromotion.style.opacity = "0";
    displayNews.style.display = "inline-flex";
    displayNews.style.opacity = "1";
}
</script>

<!-- Movie Detail -->
<script>
 function popclick(clicked) {
    
                   
    var popout = document.getElementById("popout"+clicked);
    var span = document.getElementsByClassName("closes"+clicked)[0];
    popout.style.display = "block";
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      popout.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == popout) {
        popout.style.display = "none";
      }
    }
} 
</script>

<!-- open and close chatbot -->
<script>
    function openForm() {
        document.getElementById("wrapper").style.display = "block";
        document.getElementById("open-button").style.display = "none";
        document.getElementById("wrapper").classList.add('open');
        document.getElementById("wrapper").classList.remove('close');

    }

    function closeForm() {
        document.getElementById("wrapper").style.display = "none";
        document.getElementById("open-button").style.display = "block";
        document.getElementById("wrapper").classList.add('close');
        document.getElementById("wrapper").classList.remove('open');
    }
</script>

<!-- end of open and close chatbot-->

<!-- chatbot function ajax-->
<script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                    $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                    $(".form").append($replay);
                    // when chat goes down the scroll bar automatically comes to the bottom
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                }
            });
        });
    });
</script>
<!-- end of chatbot function-->

<!-- admin page -->
<script>

function checksales() {
    document.getElementById("checkSales").style.display = "block";
    document.getElementById("addMovie").style.display = "none";
    document.getElementById("addPromotion").style.display = "none";
    document.getElementById("addNews").style.display = "none";
    
    document.getElementById("checkSales").style.transition = ".5s";
    
    document.getElementById("checkSalesList").style.background= "white";
    document.getElementById("AddMovieList").style.background= "none";
    document.getElementById("AddPromotionList").style.background= "none";
    document.getElementById("AddNewsList").style.background= "none";
    
    document.getElementById("checkSalesTag").style.color= "black";
    document.getElementById("addMovieTag").style.color= "white";
    document.getElementById("addPromotionTag").style.color= "white";
    document.getElementById("addNewsTag").style.color= "white";
    
    google.charts.setOnLoadCallback(drawCategoryChart);
    google.charts.setOnLoadCallback(drawStatusChart);

}
    
function addmovie() {
    document.getElementById("checkSales").style.display = "none";
    document.getElementById("addMovie").style.display = "block";
    document.getElementById("addPromotion").style.display = "none";
    document.getElementById("addNews").style.display = "none";
    
    document.getElementById("addMovie").style.transition = ".5s";
    
    document.getElementById("checkSalesList").style.background= "none";
    document.getElementById("AddMovieList").style.background= "white";
    document.getElementById("AddPromotionList").style.background= "none";
    document.getElementById("AddNewsList").style.background= "none";
    
    document.getElementById("checkSalesTag").style.color= "white";
    document.getElementById("addMovieTag").style.color= "black";
    document.getElementById("addPromotionTag").style.color= "white";
    document.getElementById("addNewsTag").style.color= "white";
}
    
function addpromotion() {
    document.getElementById("checkSales").style.display = "none";
    document.getElementById("addMovie").style.display = "none";
    document.getElementById("addPromotion").style.display = "block";
    document.getElementById("addNews").style.display = "none";
    
    document.getElementById("addPromotion").style.transition = ".5s";
    
    document.getElementById("checkSalesList").style.background= "none";
    document.getElementById("AddMovieList").style.background= "none";
    document.getElementById("AddPromotionList").style.background= "white";
    document.getElementById("AddNewsList").style.background= "none";
    
    document.getElementById("checkSalesTag").style.color= "white";
    document.getElementById("addMovieTag").style.color= "white";
    document.getElementById("addPromotionTag").style.color= "black";
    document.getElementById("addNewsTag").style.color= "white";
}
    
function addnews() {
    document.getElementById("checkSales").style.display = "none";
    document.getElementById("addMovie").style.display = "none";
    document.getElementById("addPromotion").style.display = "none";
    document.getElementById("addNews").style.display = "block";
    
    document.getElementById("addNews").style.transition = ".5s";
    
    document.getElementById("checkSalesList").style.background= "none";
    document.getElementById("AddMovieList").style.background= "none";
    document.getElementById("AddPromotionList").style.background= "none";
    document.getElementById("AddNewsList").style.background= "white";
    
    document.getElementById("checkSalesTag").style.color= "white";
    document.getElementById("addMovieTag").style.color= "white";
    document.getElementById("addPromotionTag").style.color= "white";
    document.getElementById("addNewsTag").style.color= "black";
}

</script>
<!-- end of admin page-->

<!-- print button -->
<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<!-- end of print button-->

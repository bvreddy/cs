<?php
echo 'works - test.php';
?>


<!-- <script>
console.log('log message .. ');
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '156589268405824',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.11'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>



<div class="fb-customerchat"
 page_id="1744915998866434"
 ref="<OPTIONAL_WEBHOOK_PARAM>"
 minimized="true">
</div> -->

<script>  
console.log('chatfuel .........');
    window.fbMessengerPlugins = window.fbMessengerPlugins || {        init: function () {          FB.init({            appId            : '1678638095724206',            autoLogAppEvents : true,            xfbml            : true,            version          : 'v2.10'          });        }, callable: []      };      window.fbAsyncInit = window.fbAsyncInit || function () {        window.fbMessengerPlugins.callable.forEach(function (item) { item(); });        window.fbMessengerPlugins.init();      };      setTimeout(function () {        (function (d, s, id) {          var js, fjs = d.getElementsByTagName(s)[0];          if (d.getElementById(id)) { return; }          js = d.createElement(s);          js.id = id;          js.src = "//connect.facebook.net/en_US/sdk/xfbml.customerchat.js";          fjs.parentNode.insertBefore(js, fjs);        }(document, 'script', 'facebook-jssdk'));      }, 0);      </script>            <div        class="fb-customerchat"        page_id="1744915998866434"        ref="">      </div>    
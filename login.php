<?php
  include_once('inc/header.php');
  include_once('inc/navbar.php');
?>
<main>
<!-- Main Section -->
<div class="container-fluid" style="margin-top: 5%;">
  <div class="row">
      <div class="col-12 col-xl-4 offset-xl-4 colored" style="padding: 2%;">
          <form method="post" id="login">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Adres email</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Hasło</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
              <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
              <button type="submit" class="btn btn-success">Zaloguj</button>
            </form>
      </div>
  </div>
</div>
</main>
<?PHP
include_once("inc/footer.php");
?>
<script src="https://www.google.com/recaptcha/api.js?render=6LcrT68UAAAAAP9svbN35XnnwPNsdbjFDwfPIQIH"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#login').submit(function(e){
      e.preventDefault();
      grecaptcha.ready(function() {
          grecaptcha.execute('6LcrT68UAAAAAP9svbN35XnnwPNsdbjFDwfPIQIH', {action: 'submit'}).then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
            $.ajax({
              type: "POST",
              url: 'class/login_.php',
              data: $('#login').serialize(),
              success: function (date){
                if (date === '{"success": "loged"}'){
                  window.location = 'index.php';
                }else{
                  alert('Nie prawidłowe dane!');
                }
              }
            });
        });
    });
  });
});
</script>
<?PHP
include_once("inc/end.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
<script type="text/javascript" charset="utf-8">
$().ready(function (){
  var token = '';
  var pinger = setInterval(function (){
    
    $.ajax({
      cache: false,
      data: {
        token: token,
      },
      timeout: 2500,
      type: 'GET',
      url: 'class/pinger.php',
      dataType: 'json',
      success: function (data, status, jqXHR){
        $('#online').attr("title", "Użytkowników online: " + data.userCount + " 🟢");
        $('#online').attr("data-bs-original-title", "Użytkowników online: " + data.userCount + " 🟢");
        token = data.token;
      }
    });
    
  }, 2500);
});
</script>
<?php
  echo("<script>console.log('email => ".@$_SESSION['email']."')</script>");
  echo("<script>console.log('nickname => ".@$_SESSION['nickname']."')</script>");
  echo("<script>console.log('role => ".@$_SESSION['role']."')</script>");
?>
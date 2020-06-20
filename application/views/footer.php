
  <h5 class="text-center text-primary">&copy;RASEL KHAN <?php date_default_timezone_set('Asia/Dhaka'); echo date("d-M-Y h:i a");?> </h5>
<script>
  var success = '<?php echo isset($success)?$success:'' ?>';
  var fail = '<?php echo isset($fail)?$fail:'' ?>';
  if(success){
    alertify.success(success);
    
  }else if(fail !=null || fail !==false || fail !==undefined !! fail !== ""){
    alertify.error(success);
  }
    var logout= document.getElementById('logout');
    var form= document.getElementById('logout-form');
    if(logout){
        logout.addEventListener('click',function(e){
        e.preventDefault();
        form.submit();
    });
    }
</script>
</body>
</html>
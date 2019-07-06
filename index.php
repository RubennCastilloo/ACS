<?php 
include 'inc/sesiones.php';
include 'layout/header.php'; 
//   echo "<pre>";
//   echo var_dump($_SESSION);
//   echo "<hr>";
//   echo var_dump("$_GET");
//   echo "</pre>";

?>

<button id="mostrar-ip">
    Mostrar IP
</button>




<input class="ip" value="">
<button class="send">Go</button>
<br><br>
<span class="city"></span> 
<span class="country"></span>
<br>


<script type="application/javascript">
  function getIP(json) {
    document.write("My public IP address is: ", json.ip);
  }
</script>

<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php include 'layout/footer.php'; ?>
<link rel="stylesheet" href="billing/logincss/css/style.css">
<script type="text/javascript" src="billing/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="billing/js/jquery-ui-1.8.20.custom.min.js"> </script>
<script>
	function dobilling()
	{

		window.location.assign("billing");
	}

	function doops()
	{

		window.location.assign("ops");
	}
</script>
<title>MERAKMAS</title>
<br>

<body class="bodiku">
	<section class="containerp2">

    <div class="loginp2">
      <h1 width="100%"><img src="img/merakmas.png" width="100"></h1>

      <!-- <form method="POST" action="login/do_login" /> -->
        <table width="100%" border="1" class="tableku">
        	<tr>
        		<td align="center"><button class="buttonku" onclick="dobilling()">
<img src="img/billing.png" width="100"></button></td>
        		<td align="center"><button class="buttonku" onclick="doops()"><img src="img/operator.png" width="100">
        		</button></td>
        	</tr>

        </table>
      <!-- </form> -->
    </div>
    <div class="loginp2-help">
      <p>Copyright@2014 System Information Beureau</p>
      
    </div>
  </section>
</body>
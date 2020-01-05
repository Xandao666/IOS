<?php
	session_start();
	if ($_SESSION['usuarioNome'] == null){
		header("Location: index.php");
	} 
?>

<!DOCTYPE>
<html>
    <head>

        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/bootstrap/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/et-line/css/style.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/elegant-icons/css/style.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/pe-icon-7-stroke/css/helper.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/nivo-lightbox/css/nivo-lightbox.css" /> 
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/nivo-lightbox/themes/default/default.css"/>
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/animate/css/animate.css"> 
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/owl/css/owl.carousel.css"> 
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/owl/css/owl.theme.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/form-validation/css/formValidation.min.css"> 
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/morris.js/morris.css">           
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/dropzone/css/dropzone.min.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/third-party/full-calendar/css/fullcalendar.min.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/css/style.css">
        <link rel="stylesheet" href="http://nucleus.amazyne.com/v2/css/custom.css">

        <!-- Script for IE < 9 -->

        <!--[if lt IE 9]>
        <script src="third-party/respond/js/respond.min.js"></script>
        <![endif]-->
        <title>CHECKER ELO</title>
    </head>
        <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">iOSCHECKERS</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">CHECKER DE ELO GATE 1</a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuario <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#sobre"><?php echo "Nome: ". $_SESSION['usuarioNome']; ?></a></li>
                            <li><a href="#nivel"><?php if ($_SESSION['usuarioNiveisAcessoId'] == 1) {
        echo "Nivel: ADMIN";
    }elseif ($_SESSION['usuarioNiveisAcessoId'] == 2) {
        echo "Nivel: COLABORADOR";
    }else{
        echo "Nivel: CLIENTE";
    } ?></a></li>
                        </ul>
                    </li>
                    <li><a href="administrativo.php">ADMIN</a></li>
                    <li><a href=""></a></li>
                    <li><a href="sair.php">SAIR</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
 <h3>.</h3>
<center><h3>GATE [1] ELO</h3></center>
        <script title="ajax do checker">
                  function notifyMe(message, status, progress) {
          if (!("Notification" in window)) {
              alert("This browser does not support desktop notification");
          }else if (Notification.permission === "granted") {
              var options = {
                  body: message,
                  icon: "images/img_204828.png",
                  dir: "auto"
              };
              var notification = new Notification("</> iOS CHECKERS </>" + status, options);
          }else if (Notification.permission !== 'denied') {
              Notification.requestPermission(function(permission) {
                  if (!('permission' in Notification)) {
                      Notification.permission = permission;
                  }
                  if (permission === "granted") {
                      var options = {
                          body: progress,
                          icon: "images/img_204828.png",
                          dir: "auto"
                      };
                      var notification = new Notification("</> iOS CHECKERS </>" + status, options);
                  }
              });
          }

      }
            $(document).ready(function () {
document.getElementById('testar').onkeyup = function() {
   count = this.value.split("\n").length;
   document.getElementById("carregada").innerHTML = count;
}
                $('#testar').click(function () {
                    var Livess = 0;
    
                        $("#divstatus").fadeIn();
                         $("#lista").fadeOut();
                         $("#testar").fadeOut();
                        document.title = "EM ANDAMENTO";
                    var line = $('#lista').val().replace(',', '').split('\n');
                    line = line.filter(function (item, index, inputArray) {
                        return inputArray.indexOf(item) == index;
                    });
                    $("#lista").val(line.join("\n"));
                    line.forEach(function (value) {
                        
                        var ajaxCall = $.ajax({
                            url: 'api.php',
                            type: 'GET',
                            data: 'lista=' + value,
                            success: function (data) {
                                if (data.match("#Aprovada")){
                                    removelinha();
                                    document.getElementById("aprovadas").innerHTML += data + "<br>";
                                   document.getElementById("aprovadasc").innerHTML = (eval(document.getElementById("aprovadasc").innerHTML) + 1);
          Livess = (eval(document.getElementById("aprovadasc").innerHTML) + 1);
          Livess--;
          removelinha();
                    if(window.Notification && Notification.permission !== "aprovadasc") {
    Notification.requestPermission(function(status) {  // status is "granted", if accepted by user
        var n = new Notification('</> iOS CHECKERS </>', { 
            body: `+1 CC Aprovada, Total: ${Livess} :)`,
            icon: 'images/img_204828.png',
        }); 
    });
                    }
                                } else {
                                    removelinha();
                                    document.getElementById("reprovadas").innerHTML += data + "<br>";
                                    document.getElementById("reprovadasc").innerHTML = (eval(document.getElementById("reprovadasc").innerHTML) + 1);
                                }
                            }
                        });
                    });
                });
            });

            function removelinha() {
                var lines = $("#lista").val().split('\n');
                lines.splice(0, 1);
                $("#lista").val(lines.join("\n"));
            }
                     
        </script>
    <center>

        <textarea name="lista" id="lista" onKeyup="updateLineCount()" rows="9" style="width:40%;text-align:center;" class="form-control form-text-area" placeholder="5447317675157505|08|2023|796"></textarea>
            <br>
            <p><a type="submit" id="testar" name="testar" value="testar" class="btn btn-hollow-dark">Começar</a></p>
                                    <div id="divstatus" style="display: none;"><div style="width:80%;" class="alert alert-success"> <strong>Pronto!</strong> Teste iniciado, Com um total de <div id="carregada" class="label label-info label-dismissible">0</div> cc's</div>
                            <div style="width:80%;text-align:center;" class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        APROVADAS <span class="label bg-green" id="aprovadasc">0</span>
                                    </h4>
                                </div>
                                    <div class="panel-body" style="text-align:left;" id="aprovadas">
                                    </div>
                            </div>
                            <hr style="width:80%;text-align:center;" />
                            
                            <div style="width:80%;text-align:center;" class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        REPROVADAS <span class="label bg-red" id="reprovadasc">0</span>
                                    </h4>
                                </div>
                                    <div class="panel-body" style="text-align:left;" id="reprovadas">
                                    </div>
                            </div>
                                </div>      
    </center>
</body>

        <script src="http://nucleus.amazyne.com/v2/third-party/jquery/jquery.min.js"></script>
        <script src="http://nucleus.amazyne.com/v2/third-party/bootstrap/js/bootstrap.min.js"></script> 
        <script src="http://nucleus.amazyne.com/v2/third-party/slimscroll/jquery.slimscroll.js"></script>       
        <script src="http://nucleus.amazyne.com/v2/third-party/morris.js/morris.js"></script>       
        <script src="http://nucleus.amazyne.com/v2/pages/morris-charts.js"></script>
        <script src="http://nucleus.amazyne.com/v2/js/scripts.js"></script>
        <script src="http://nucleus.amazyne.com/v2/js/custom.js"></script>
        
</html>
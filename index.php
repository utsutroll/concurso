<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>SorteoApp</title>
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon.svg">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
	<link href="css/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-r from-gray-200 to-transparent">

<nav class="bg-gradient-to-r from-gray-200 to-gray-300">
  	<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    	<div class="relative flex items-center justify-between h-16">

	      	<div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
		        <div class="flex-shrink-0 flex items-center">
		          	<img class="h-16 w-auto" src="img/logo.svg" alt="Space DigitalSolutions C.A">
		        </div>
	      	</div>
    	</div>
  	</div>
</nav>

	<div class="grid grid-cols-5 gap-3 justify-items-center py-4 my-4 info">
		<div class="col-start-1 md:col-start-2 col-span-5 md:col-span-3">
			<h1 class="text-3xl md:text-4xl font-bold text-gray-800 sor">Sorteo por WhatsApp</h1>
		</div>
		
		<div class="col-start-2 col-span-3">
			<img src="img/post-concurso.jpg" class="w-80" alt="Post del concurso La Mega Tienda Turén">
		</div>
	</div>

	<div class="grid grid-cols-5 gap-3 mt-5 pt-5" id="spin">
		<div class="lds-ring col-start-2 md:col-start-3 col-span-2">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div class="count" id="countdown"></div>
		</div>	
		
	</div>

	<div class="grid grid-cols-5 gap-3 mt-5 pt-5 justify-items-center" id="win">
		<div class="col-start-2 col-span-3" id="logo">
			<img src="img/logo-gira.png" class="w-80" alt="La Mega Tienda Turén">
		</div>
		<canvas class="z-0" id="my-canvas"></canvas>
		<div class="col-start-1 col-span-5 md:col-start-2 md:col-span-3 mb-2">
			<h1 class="text-3xl font-bold text-gray-800 text-center">Ganador del Almuerzo a preferencia (3er Lugar)</h1>
		</div>
		<div class="col-start-2 col-span-3 text-3xl font-bold text-gray-800 text-center" id="cedula"></div>
		<div class="col-start-1 col-span-5 md:col-start-2 md:col-span-3 text-3xl font-bold text-gray-800 uppercase text-center" id="winner"></div>	
	</div>

	<div class="flex justify-center relative z-50" id="btn">
		<button type="button" id="start" class="p-2 rounded-md text-base font-bold text-white bg-blue-500 hover:bg-blue-700">Comenzar</button>
	</div>

			
	



	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/index.min.js"></script>

	<script type="text/javascript">
	$('#spin').hide();	
	$('#win').hide();	
	jQuery.fn.countDown = function(settings,to) {
        settings = jQuery.extend({
                startFontSize: "8rem",
                endFontSize: "8rem",
                duration: 1000,
                startNumber: 10,
                endNumber: 0,
                callBack: function() { }
        }, settings);
        return this.each(function() {
                
                //¿Dónde empezamos?
                if(!to && to != settings.endNumber) { to = settings.startNumber; }
                
                //Establecemos la cuenta atrás con el numero inicial
                jQuery(this).text(to).css("fontSize",settings.startFontSize);
                
                //lo recorremos
                jQuery(this).animate({
                        fontSize: settings.endFontSize
                }, settings.duration, "", function() {
                        if(to > settings.endNumber + 1) {
                                jQuery(this).css("fontSize", settings.startFontSize).text(to - 1).countDown(settings, to - 1);
                        }
                        else {
                                settings.callBack(this);
                        }
                });                  
	        });
		};

			jQuery('#start').on("click", function(){
				jQuery('.info').css({"display": "none"});
				jQuery('#btn').css({"display": "none"});
				jQuery('#spin').show();
				jQuery("#countdown").countDown({
			        startNumber: 10,
			        callBack: function(me) {
			           $.ajax({
					        url: "query.php",
					        type: "GET",
					        dataType: "json",
					        success: function (data) {
					        	console.log(data);
					        	jQuery('#win').show();
					        	$('#cedula').text(data[0].id);
					        	$('#winner').text(data[0].name);
					        	$('#tsparticles').css({"display": "block"});	
					        }
						});

			           jQuery(me).css({"display": "none"});
			           $('#spin').hide();
			           var confettiSettings = {target: 'my-canvas'};
			           var confetti = new ConfettiGenerator (confettiSettings);
			           confetti.render();
			       	}
		        });   
        });
	</script>
</body>
</html>
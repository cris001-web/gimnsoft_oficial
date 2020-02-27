audio = new Audio("../alarma/alar.mp3");

var n=0;
	function Empezar(){
	 n=1;
	alert(n);
			audio.pause();
			audio.currentTime=0;

			$('#Tiempo').timer('remove');
			$('#Tiempo').timer({
				countdown:true,
			duration:$('#h').val()+"h"+$('#m').val()+"m"+$('#s').val()+"s",
				callback:function(){
					audio.addEventListener('ended',function(){
						this.currentTime=0;
						this.play();
					},false);
					audio.play();
					//setTimeout('Pausa_Alarma',20000);
					ban=1;
					$('#Tiempo').css('color', 'white');
					$('#numm').css('background-color', 'rgb(226, 5, 36)');
				},

				format:'%H:%M:%S'
				
			});
		
		}

		
		
		
		function Pausa(){
			$('#Tiempo').timer('pause');
		}
		function Renaudar(){
			
			$('#Tiempo').timer('resume');
		
		}
		function Pausa_Alarma(){

				audio.pause();
				$('#numm').css('background-color', 'white');
				$('#Tiempo').css('color', 'black');
			
		}

	//setTimeout('Pausa_Alarma',2000);
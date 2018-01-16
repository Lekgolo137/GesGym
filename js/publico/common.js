jQuery( document ).ready( function($) {

	/* Toggle del Menú */

	$( '.menu-toggle' ).click( function() {
		$( '#site-navigation' ).toggleClass( 'toggled' );
		$( '#page' ).toggleClass( 'toggled' );
		$( 'html' ).toggleClass( 'toggled' );
	});

	/*$( '.main-navigation ul li.servicios' ).click( function() {
		$( 'li.servicios ul.sub-menu' ).toggleClass( 'visible' );

	});

	$( '.main-navigation ul li.actividades' ).click( function() {
		$( 'li.actividades ul.sub-menu' ).toggleClass( 'visible' );

	});*/

	$( '.main-navigation ul li.con-submenu' ).click( function() {
		$( 'li.con-submenu > ul.sub-menu' ).slideToggle('slow');

	});




	/*** formulario ****/

	$( '.wpcf7-response-output' ).click(function() {
		$( '.wpcf7-response-output' ).css({
			'display': 'none'
		});
	});


	/* Carousel Home */

	var bool = true; // Hacemos el booleano con el loop ya que el carrousel no funciona con un elemento

	if( $('.item-carrousel').length <= 1 ) bool = false;

	$( '#carousel-fondo' ).owlCarousel( {
		autoplay : true,
		autoplayTimeout : 8000, // Tiempo que está fija una imagen
		autoplaySpeed : 5000,
		autoplayHoverPause : true,
		navText: [ '', '' ],
		items:1,
		nav:bool,
		loop:bool,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn',
	} );

	/* Fin Carousel Home*/

	/* Animacion objetos */



	$("#filosofia .columna-2").addClass('wow fadeInRight');
	$("#noticias-home article").addClass('wow fadeInUp');
	$("#conocenos").addClass('wow fadeInUp');
	$(".actividades .actividad").addClass('wow fadeInUp');
	$("#caracteristicas .section-25 img").addClass('wow fadeInUp');
	$(".destacado").addClass('wow fadeIn');
	$(".claseshoy .clase").addClass('wow fadeInUp');
	$(".single-actividades article.clases").addClass('wow fadeInUp');
	$("footer .contacto .datos-contacto").addClass('wow fadeInLeft');

	$("#mensaje_horario").addClass('wow fadeInUp');
	$("#mensaje_horario").append('<button class="cerrar">X</button>');

	$("#mensaje_horario .cerrar").click(function() {
		$("#mensaje_horario").fadeOut();
	});




	if ( $( window ).width() > 200 ) {

		new WOW().init();
	};



	/* Altura de la div */


	$(window).resize(function(){

		if ($(window).width() > 768){

			$('.acf-map').css({

				'height' : $('footer .contacto .datos-contacto').outerHeight( true ),

			});


		}

	});

	$(window).resize();


	/** contacto **/

	$("li.contacto a").attr("data-toggle", "modal");

	$("li.contacto a").attr("data-target", "#formInformacion");

	$(".contacto a").click(function() {
		$("#page").removeClass('toggled');
		$(".main-navigation").removeClass('toggled');
	});

	$(".cargar-form").click(function() {
		$(".formulario-contacto").toggleClass('visible');


	});

	$(".cerrar-form").click(function() {
		$(".formulario-contacto").removeClass('visible');

	});


	/** masonry **/

	var $container = $( '#galeria .columna-1' );
	// initialize Masonry after all images have loaded
	$container.imagesLoaded( function() {
		$container.masonry({
			gutter: 10,
			percentPosition: true,
			itemSelector: '#galeria .grid a',
		});
	});

	/***** Video ********/


	var iframe = $('#homevideo')[0];
	var player = $f(iframe);
	// player.addEvent('ready', function() {
	// 	player.api( 'setVolume', 0 );
	// });

	function mainPositioning(){}

	function resizeTopVideoHome(){

		$('#logo-portada').css({
			'height': $(window).height(),
		});

var originalRatio = 540/960; //1920*930

var video = $('.videoContainer iframe');

var t,e,i=$(window).width(), n=$(window).height(), s=5;


n/i > originalRatio ? (t=n+s,video.height(t),e=(n+s)/originalRatio,video.width(e)) : (e=i+s*originalRatio,video.width(e), t=(i+s)*originalRatio,video.height(t)),


setTimeout(function(){
	$(window).width() > 767 ? ($(".videoContainer").width(i),
		$(".videoContainer").height(n)) : ($(".videoContainer").width(i),
		$("body.home").length> 0 ? $(".videoContainer").height(n) : $(".videoContainer").height(2*(n/3)),mainPositioning()), video.css("left",(i-e)/2),video.css("top",(n-t)/1)},10);

}

$( document ).ready(function() {
	resizeTopVideoHome();
});


$(window).resize(function(){
	resizeTopVideoHome();
});

});
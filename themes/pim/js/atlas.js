$( document ).ready(function() {
	console.log( "ready!" );

		//Pour cacher le bouton vers l'atlas
		$('body.not-logged-in li.menu-13519.menu-path-node-56082 ').hide();

		// Script pour ajouter le menu dans la page des commentaires   ->>>>>  MARCHE EN PROD

		
		//On va chercher le nidID dans l'url
		var pathname = window.location.pathname;
		var href = window.location.href;

		href = href.split('/');
		href = href[href.length - 4];

		pathname = pathname.split('/');
	  	pathname = pathname[pathname.length -1];

		var nodeID = pathname;
		
		var bar = "<div class='tabs'><ul class='tabs primary clearfix'><li><a href='/node/"+nodeID+"'><span class='tab'>Voir</span></a></li><li><a href='/node/"+nodeID+"/edit'><span class='tab'>Modifier</span></a></li><li class='tab'><a href='/node/"+nodeID+"/revisions' class='tab'><span class='tab'>Révisions</span></a></li><li class='active'><a href='/comment/reply/"+nodeID+"#comment-form' class='active'><span class='tab'>Commenter</span></a></li></div>";


		$('body.section-comment #content .section').before(bar);
});
$( document ).ready(function() {
	console.log( "ready!" );

		//Pour cacher le bouton vers l'atlas
		$('body.not-logged-in li.menu-13519.menu-path-node-56082 ').hide();


		
		//On va chercher le nidID dans l'url
		var pathname = window.location.pathname;
		var href = window.location.href;

	  	pathBase = href.split('/');
		
		// Script pour ajouter le menu dans la page des commentaires   ->>>>>  MARCHE EN PROD
	  	pathBase = pathBase[0] +'//'+ pathBase[1] +'/'+ pathBase[2]; 
	  	
		href = href.split('/');
		href = href[href.length - 4];

		
		pathname = pathname.split('/');
	  	pathname = pathname[pathname.length -1];



		var nodeID = pathname;
		var lang = $('html').attr('lang');
        
        if(lang == 'fr') var bar = "<div class='tabs'><ul class='tabs primary clearfix'><li><a href='"+pathBase+"/node/"+nodeID+"'><span class='tab'>Voir</span></a></li><li><a href='"+pathBase+"/node/"+nodeID+"/edit'><span class='tab'>Modifier</span></a></li><li class='tab'><a href='"+pathBase+"/node/"+nodeID+"/revisions' class='tab'><span class='tab'>Révisions</span></a></li><li class='active'><a href='"+pathBase+"/comment/reply/"+nodeID+"#comment-form' class='active'><span class='tab'>Commenter</span></a></li></div>";
		else var bar = "<div class='tabs'><ul class='tabs primary clearfix'><li><a href='"+pathBase+"/en/node/"+nodeID+"'><span class='tab'>View</span></a></li><li><a href='"+pathBase+"/en/node/"+nodeID+"/edit'><span class='tab'>Edit</span></a></li><li class='tab'><a href='"+pathBase+"/en/node/"+nodeID+"/revisions' class='tab'><span class='tab'>Revisions</span></a></li><li class='active'><a href='"+pathBase+"/en/comment/reply/"+nodeID+"#comment-form' class='active'><span class='tab'>Comment</span></a></li></div>";

		$('body.section-comment #content .section').before(bar);
});
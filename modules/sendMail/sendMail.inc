<?php
//Renvoie le(s) mail de(s) responsable(s) sous forme d'une string séparé par des ","
function getMailResponsables($form,  $form_state, $type, $node, $isComment){

	//Comment post
	if($isComment){

		//Récuperation du nid sous bassin parent
		if($type == 'book_ile')	$idSousBassinParent = $node->field_ile_id_ss_bassin[0]['value'];
		else if($type == 'book_cluster') $idSousBassinParent = $node->field_id_bassin_for_cluster[0]['value'];
		else if($type == 'book_sous_bassin') $idSousBassinParent = $node->nid;

	}else{
		
		//Récuperation du nid sous bassin parent
		if($type == 'book_ile')	$idSousBassinParent = $form_state['values']['field_ile_id_ss_bassin'][0]['value'];
		else if($type == 'book_cluster') $idSousBassinParent = $form_state['values']['field_id_bassin_for_cluster'][0]['value'];
		else if($type == 'book_sous_bassin') $idSousBassinParent = $form_state['values']['nid'];

	}


	//On charge le node sous bassin à partir du nid
	$nodeOfSousBassinParent = node_load($idSousBassinParent, $revision = NULL, $reset = NULL);

	//On récupere un tableau d'uid des utilisateur enregsitré dans le champs "field_ss_bassin_responsable"
	$arrayOfUidOfResponsable = $nodeOfSousBassinParent->field_ss_bassin_responsable;


	//Parcour des uid
	foreach ($arrayOfUidOfResponsable as $value){
			
		//Charge l'utilisateur concerné
		$userCourant = user_load( $value['uid'] );

		//Concaténation des mails des responsables
		$allMail .= $userCourant->mail.',';

	}

	//Nettoyage de la string
	$allMail = trim($allMail, ",");


	return $allMail;
}


//Envoi les mail 
function sendMail($allMail, $title, $statut, $link, $type, $isComment){

	//Recuperation de la date au niveau serveur et conversion au foamat jj/mm/aa
    $date = date('Y-m-d');
    $date = explode('-', $date);
    $date = $date[2].'/'.$date[1].'/'.$date[0];

    //Recuperation du nom du user
    global $user;
    $username = $user->name;


	if($isComment){

		//sujet du mail
		$subject = '[Atlas PIM] Nouveau commentaire';
		//Construction du corp du mail
		$text = '<html><head></head><body>Bonjour,<br/><br/>un commentaire a été posté sur le contenu "'.$title.'", le '.$date.' par '.$username.'<br/><br/>Voir sur le site '.$link.'<br/><br/>Bonne journée.<br/><br/>Atlas PIM.</body></html>';
		

	}else{
		
		//sujet du mail
		$subject = '[Atlas PIM] Changement de statut du contenu "'.$title.'"';
		//Construction du corp du mail
		$text = '<html><head></head><body>Bonjour,<br/><br/> Le statut du contenu "'.$title.'"" a été modifié le '.$date.' par '.$username.', il est désormais "'.$statut.'".<br/><br/>Cliquez sur ce '.$link.' pour éditer ce contenu.<br/><br/>Bonne journée.<br/><br/>Atlas PIM.</body></html>';
		
	}
	//Configuration des propriété du mail
	$message = array(
	  	'to' => $allMail,
	  	'from' => 'initiative-pim@conservatoire-du-littoral.fr',
	  	'subject' => t($subject),
	  	'body' => $text,
	  	'headers' => array('From' => 'initiative-pim@conservatoire-du-littoral.fr',
          'MIME-Version' => '1.0',
          'Content-Type' => 'text/html;charset=utf-8',
         ),
	);

	//Mail posté
	drupal_mail_send($message);

}
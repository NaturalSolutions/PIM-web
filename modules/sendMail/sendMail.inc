<?php

//Renvoie le(s) mail de(s) responsable(s) sous forme d'une string séparé par des ","
function getMailResponsables($form,  $form_state, $type){

	

	//Récuperation du nid sous bassin parent
	if($type == 'book_ile')	$idSousBassinParent = $form_state['values']['field_ile_id_ss_bassin'][0]['value'];
	else if($type == 'book_cluster') $idSousBassinParent = $form_state['values']['field_id_bassin_for_cluster'][0]['value'];
	else if($type == 'book_sous_bassin') $idSousBassinParent = $form_state['values']['nid'];


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
function sendMail($allMail, $title, $statut, $link){

	//Construction du corp du mail
	$text = '<html><head></head><body>Le contenu "'.$title.'" est désormais "'.$statut.'", <br/> vous pouvez éditer ce contenu sur ce '.$link.'<br/>Bonne journée</body></html>';
	
	//Configuration des propriété du mail
	$message = array(
	  	'to' => 'p.delaunay1@gmail.com,julie_chabalier@natural-solutions.eu',
	  	'from' => 'contact@pim.org',
	  	'subject' => t('Atlas - Changement de statut : '.$statut),
	  	'body' => $text,
	  	'headers' => array('From' => 'contact@pim.org',
          'MIME-Version' => '1.0',
          'Content-Type' => 'text/html;charset=utf-8',
         ),
	);

	//Mail posté
	drupal_mail_send($message);

}
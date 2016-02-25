<?php
// $Id$
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
/***************************************************************************/
/***************************************************************************/
/*                   VUE AFFICHE FIELDS OF ILE                             */
/*                                                                         */
/***************************************************************************/
/*********************************  ****************************************/
/*********************************  ****************************************/
  global $base_url, $language;
?>

<?php foreach ($fields as $id => $field): ?>


<?php if ($id == 'title') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $title = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $nid = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_connaiss_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $connaissances = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_interet_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $interet = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_pression_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $pression = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_gest_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $gestion = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_image_fid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $url_picture = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_have_ss_bassin_nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $have_ss_bassin = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_have_cluster_nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $have_ss_cluster = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_biblio_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $biblio = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_autor_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $author = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_tab_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $tab = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_desc_gen_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $descGen = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_code_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $code_ile = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_ile_id_ss_bassin_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $idSousBassinParent = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'tid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $tid = $field->content; ?>
  <?php endif; ?>
<?php endif;?>


<?php endforeach; ?>

<?php //echo $code_ile; ?>
<?php //echo $tid; ?>


<?php if($language->language == 'fr'): ?>

  <a class='titleIsland' title='Editer' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  <br/>Rédigé par : <i><?php echo $author; ?></i>

  <br/>
  <br/>
  <?php if($url_picture): ?>

    <div>
      <?php echo $url_picture; ?>
    </div>
    
  <?php endif; ?>
  <br/>
  
  <?php if($tid != ''): ?>
  
    <!-- lien vers la fiche ile -->
    <?php echo  "<a class='linkToFicheIle' href=".$base_url."/fiche-Ile/".$code_ile.">Modifier les valeurs des tableaux pour cette île.</a>"; ?>

    <!-- Status description physique -->
    <?php print views_embed_view('v_atlas_tab_data_ile', 'block_1', $tid); ?>
    
    <!-- Status de propriete fonciere -->
    <TABLE class='tableRecapIle'>
      <?php print views_embed_view('v_atlas_tab_data_ile', 'block_2', $tid); ?>
    </TABLE>

    <!-- Status de protection internationnal-->
    <br/>
    <TABLE class='tableRecapIle'>
      <TR>
        <td></td>
        <td>Nom</td>
        <td>Année</td>
        <td>Zone concernée</td>        
      </TR>
        <?php print views_embed_view('v_atlas_tab_data_ile', 'block_3', $tid); ?>
    </TABLE>
    

    <!-- Status de protection nationnal-->
    <br/>
    <TABLE class='tableRecapIleN'>
      <TR>
        <td></td>
        <td>Nom</td>
        <td>Année</td>
        <td>Zone concernée</td>        
      </TR>
        <?php print views_embed_view('v_atlas_tab_data_ile', 'block_5', $tid); ?>
    </TABLE>
    <br/>
    <!-- AUCUN STATUT 
    <br/>
    <TABLE class='tableRecapIleA'>
      <TR>
        <td></td>
        <td>Nom</td>
        <td>Année</td>
        <td>Zone concernée</td>        
      </TR>
        <?php //print views_embed_view('v_atlas_tab_data_ile', 'block_6', $tid); ?>
    </TABLE>-->
    
       
    <!-- Status de Gestion -->
    <?php $countNbTotalItem = views_get_view_result('v_atlas_tab_data_ile', 'block_4', $tid); ?>
    <?php if(!(empty($countNbTotalItem[0]))): ?>
    <table class='tableRecapIle'>
      <TR>
        <td></td>
        <td>Nom du gestionnaire</td>
        <td>Année de début de gestion</td>
        <td>Type d'accord</td>
      </TR>
      <?php print views_embed_view('v_atlas_tab_data_ile', 'block_4', $tid); ?> 
      
    </table>
    <br/>
    <?php endif; ?>
    
  <?php endif; ?>

  <?php echo $tab; ?>

  <div class='responsableBloc'>
    <h2>Responsable(s) :</h2>
    <?php $nodeOfSousBassinParent = node_load($idSousBassinParent, $revision = NULL, $reset = NULL);  ?>
    <?php 
    //On récupere un tableau d'uid des utilisateur enregsitré dans le champs "field_ss_bassin_responsable"
    $arrayOfUidOfResponsable = $nodeOfSousBassinParent->field_ss_bassin_responsable;


    //Parcour des uid
    foreach ($arrayOfUidOfResponsable as $value){
        
      //Charge l'utilisateur concerné
      $userCourant = user_load( $value['uid'] );

      //Concaténation des mails des responsables
      $allName .= "<a href=$base_url/user/$value[uid]>".$userCourant->name.'</a><br/>';

    }

    //Nettoyage de la string
    $allName = trim($allName, ",");
    echo $allName;
    ?>
  </div>

  <h3> Description générale</h3>

  <?php echo $descGen; ?>

  <?php 
  
  //Get termName
  $termName = $code_ile;     

  /*-- ----------------------------------------------------------------------------
  -- État des connaissances
  -- ----------------------------------------------------------------------------*/
  
  //Bota
  $sql = "select b.niveau from picto_etaco_bota b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatBota = $result['niveau'] - 1;
  
  //Ornithologie
  $sql = "select b.niveau from picto_etaco_ornitho b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result);             
  $etatOrni = $result['niveau'] - 1;
  
  //Herpétologie
  $sql = "select b.niveau from picto_etaco_herpeto b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result);
  $etatHerpe = $result['niveau'] - 1;
  
  //Mammifères
  $sql = "select b.niveau from picto_etaco_mamm b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result);             
  $etatMami = $result['niveau'] - 1;
  
  //Chiroptères
  $sql = "select b.niveau from picto_etaco_chiro b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result);             
  $etatChiro = $result['niveau'] - 1;
                
  //Invertébrés
  $sql = "select b.niveau from picto_etaco_invert b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result);             
  $etatInvert = $result['niveau'] - 1;  
  
  //Caractéristique environnentales
  $sql = "select b.niveau from picto_etaco_carenv b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result);             
  $etatEnviro = $result['niveau'] - 1;
  
  //Socie économie
  $sql = "select b.niveau from picto_etaco_soceco b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result);             
  $etatEco = $result['niveau'] - 1;
    
  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Botanique et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Botanique';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsBota[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
    $titleBota = $row['title'];    
    $labelBota = $row['field_book_value_picto_connaiss_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Ornithologie et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Ornithologie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsOrni[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];   
    $titleOrnito = $row['title'];
    $labelOrni = $row['field_book_value_picto_connaiss_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Herpétologie et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Herpétologie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsHerpeto[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
    $titleHerpe = $row['title'];
    $labelHerpe = $row['field_book_value_picto_connaiss_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Mammifères et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Mammifères';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsMami[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
    $titleMami = $row['title'];
    $labelMami = $row['field_book_value_picto_connaiss_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Chiroptères et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Chiroptères';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsChiro[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
    $titleChiro = $row['title'];
    $labelChiro = $row['field_book_value_picto_connaiss_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Invertébrés et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Invertébrés';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsInvert[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
    $titleInvert = $row['title'];
    $labelInvert = $row['field_book_value_picto_connaiss_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici caractéristique environnentales
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Caractéristique environnementales';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsCaraEnviro[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
    $titleCaractEnv = $row['title'];
    $labelCaractEnv = $row['field_book_value_picto_connaiss_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Socie économie
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Socio economie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEco[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
    $titleSocioEco = $row['title'];    
    $labelSocioEco = $row['field_book_value_picto_connaiss_value'];
  }

  //On stock le bon picto en fonction de la valeur
  $urlOfPictoBotaToDisplay = $rowsBota[$etatBota];
  $urlOfPictoOrniToDisplay = $rowsOrni[$etatOrni];
  $urlOfPictoHerpeToDisplay = $rowsHerpeto[$etatHerpe];
  $urlOfPictoMamiToDisplay = $rowsMami[$etatMami];
  $urlOfPictoChiroToDisplay = $rowsChiro[$etatChiro];
  $urlOfPictoInvertToDisplay = $rowsInvert[$etatInvert];
  $urlOfPictoEnviroToDisplay = $rowsCaraEnviro[$etatEnviro];
  $urlOfPictoEcoToDisplay = $rowsEco[$etatEco];

  
  // required for Drupal 6 -Exemple in comment : https://api.drupal.org/api/drupal/includes%21form.inc/function/drupal_get_form/6
  module_load_include('inc', 'node', 'node.pages');    
  $node_type = 'book_les_pictos_surcharge';
  $form_id = $node_type . '_node_form';

  global $user;  
  
  /*//Parcour des pictos pictos surchargés
  $sql = "SELECT n.title FROM drp_node n JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid;";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ){*/
    
  /*
  * FAUNE MARINE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> FauneM
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'fauneM' AND s.field_book_genre_picto_surcharge_value = 'connaissance';";
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueFauneM = $row['field_book_star_com_picto_value'];  
    $isRemarquableFauneM = $row['field_book_star_on_picto_value'];
    $valueOfPictoSurchargeFauneM = $row['field_book_value_picto_surcharge_value'];

    //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
    if($valueOfPictoSurchargeFauneM != ''){
      //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici FauneM et connaissance
      $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND c.field_book_value_picto_connaiss_value = ".$valueOfPictoSurchargeFauneM." AND t.name = 'Faune marine';";  
      $result1 = db_query($sql1);
      if (!$result1) die('Invalid query: ' . mysql_error());
      else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargeFauneM = $row['filepath'];      
    }

  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputFauneM = drupal_get_form($form_id, $node);

  
  /*
  * FLORE MARINE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> FloreM
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'floreM' AND s.field_book_genre_picto_surcharge_value = 'connaissance';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueFloreM = $row['field_book_star_com_picto_value'];       
    $isRemarquableFloreM = $row['field_book_star_on_picto_value'];        
    $valuePictoSurchargeFloreM = $row['field_book_value_picto_surcharge_value'];        
    
    //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
    if($valuePictoSurchargeFloreM != ''){
      //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici FauneM et connaissance
      $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND c.field_book_value_picto_connaiss_value = ".$valuePictoSurchargeFloreM." AND t.name = 'Flore marine';";  
      $result1 = db_query($sql1);
      if (!$result1) die('Invalid query0: ' . mysql_error());
      else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargeFloreM = $row['filepath'];              
    }

  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputFloreM = drupal_get_form($form_id, $node);

  /*
  * GROTTE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> FloreM
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'grotte' AND s.field_book_genre_picto_surcharge_value = 'connaissance';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueGrotte = $row['field_book_star_com_picto_value'];       
    $isRemarquableGrotte = $row['field_book_star_on_picto_value'];        
    $valuePictoSurchargeGrotte = $row['field_book_value_picto_surcharge_value'];        
    
    //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
    if($valuePictoSurchargeGrotte != ''){
      //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici FauneM et connaissance
      $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND c.field_book_value_picto_connaiss_value = ".$valuePictoSurchargeGrotte." AND t.name = 'Grotte / fonds rocheux-sableux';";  
      $result1 = db_query($sql1);
      if (!$result1) die('Invalid query: ' . mysql_error());
      else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargeGrotte = $row['filepath'];              
    }

  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputGrotte = drupal_get_form($form_id, $node);

  //} /*fin while parcours de picto*/

  //Transforme value of picto to label
  switch ($labelBota) {
    case 0: $labelBota = 'Pas de données'; break;
    case 1: $labelBota = 'Données anciennes'; break;
    case 2: $labelBota = 'Données récentes'; break;
    case 3: $labelBota = 'Bonne connaissance'; break;    
  } // fin switch  
  switch ($labelOrni) {
    case 0: $labelOrni = 'Pas de données'; break;
    case 1: $labelOrni = 'Données anciennes'; break;
    case 2: $labelOrni = 'Données récentes'; break;
    case 3: $labelOrni = 'Bonne connaissance'; break;    
  } // fin switch  
  switch ($labelHerpe) {
    case 0: $labelHerpe = 'Pas de données'; break;
    case 1: $labelHerpe = 'Données anciennes'; break;
    case 2: $labelHerpe = 'Données récentes'; break;
    case 3: $labelHerpe = 'Bonne connaissance'; break;    
  } // fin switch 
  switch ($labelMami) {
    case 0: $labelMami = 'Pas de données'; break;
    case 1: $labelMami = 'Données anciennes'; break;
    case 2: $labelMami = 'Données récentes'; break;
    case 3: $labelMami = 'Bonne connaissance'; break;    
  } // fin switch
  switch ($labelChiro) {
    case 0: $labelChiro = 'Pas de données'; break;
    case 1: $labelChiro = 'Données anciennes'; break;
    case 2: $labelChiro = 'Données récentes'; break;
    case 3: $labelChiro = 'Bonne connaissance'; break;    
  } // fin switch 
  switch ($labelInvert) {
    case 0: $labelInvert = 'Pas de données'; break;
    case 1: $labelInvert = 'Données anciennes'; break;
    case 2: $labelInvert = 'Données récentes'; break;
    case 3: $labelInvert = 'Bonne connaissance'; break;    
  } // fin switch
  switch ($labelCaractEnv) {
    case 0: $labelCaractEnv = 'Pas de données'; break;
    case 1: $labelCaractEnv = 'Données anciennes'; break;
    case 2: $labelCaractEnv = 'Données récentes'; break;
    case 3: $labelCaractEnv = 'Bonne connaissance'; break;    
  } // fin switch 
  switch ($labelSocioEco) {
    case 0: $labelSocioEco = 'Pas de données'; break;
    case 1: $labelSocioEco = 'Données anciennes'; break;
    case 2: $labelSocioEco = 'Données récentes'; break;
    case 3: $labelSocioEco = 'Bonne connaissance'; break;    
  } // fin switch  
  switch ($valueOfPictoSurchargeFauneM) {
    case 0: $labelEtatSurchargeFauneM = 'Pas de données'; break;
    case 1: $labelEtatSurchargeFauneM = 'Données anciennes'; break;
    case 2: $labelEtatSurchargeFauneM = 'Données récentes'; break;
    case 3: $labelEtatSurchargeFauneM = 'Bonne connaissance'; break;    
  } // fin switch  
  switch ($valuePictoSurchargeFloreM) {
    case 0: $labelEtatSurchargeFloreM = 'Pas de données'; break;
    case 1: $labelEtatSurchargeFloreM = 'Données anciennes'; break;
    case 2: $labelEtatSurchargeFloreM = 'Données récentes'; break;
    case 3: $labelEtatSurchargeFloreM = 'Bonne connaissance'; break;    
  } // fin switch  
  switch ($valuePictoSurchargeGrotte) {
    case 0: $valuePictoSurchargeGrotte = 'Pas de connaissance'; break;
    case 1: $valuePictoSurchargeGrotte = 'Fond sableux'; break;
    case 2: $valuePictoSurchargeGrotte = 'Fond rocheux'; break;
    case 3: $valuePictoSurchargeGrotte = 'Grottes'; break;    
  } // fin switch

  ?>

  <h4>Connaissances :</h4> 
  <!-- Botanique -->
  <div class="lesPicto book_les_pictos_connaissances">
    <?php if($urlOfPictoBotaToDisplay != ''): ?>
      <div class="onePicto Botanique"><?php echo "<img src='$base_url/$urlOfPictoBotaToDisplay' alt='$titleBota' title='$titleBota' />"; ?>
        <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Botanique</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoBotaToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelBota; ?></p></div>            
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
    <!-- Ornithologie -->
    <?php if($urlOfPictoOrniToDisplay != ''): ?>
      <div class="onePicto orni"><?php echo "<img src='$base_url/$urlOfPictoOrniToDisplay' alt='$titleOrnito' title='$titleOrnito' />"; ?>
        <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Ornithologie</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoOrniToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelOrni; ?></p></div>            
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
    <!-- Herpétologie -->
    <?php if($urlOfPictoHerpeToDisplay != ''): ?>
      <div class="onePicto herpe <?php echo $etatHerpe; ?>"><?php echo "<img src='$base_url/$urlOfPictoHerpeToDisplay' alt='$titleHerpe' title='$titleHerpe' />"; ?>
        <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Herpétologie</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoHerpeToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelHerpe; ?></p></div>            
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
    <!-- Mammifères -->
    <?php if($urlOfPictoMamiToDisplay != ''): ?>
      <div class="onePicto mammi <?php echo $etatMami; ?>"><?php echo "<img src='$base_url/$urlOfPictoMamiToDisplay' alt='$titleMami' title='$titleMami' />"; ?>
        <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Mammifères</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoMamiToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelMami; ?></p></div>            
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
    <!-- Chiroptères -->
    <?php if($urlOfPictoChiroToDisplay != ''): ?>
      <div class="onePicto chirop <?php echo $etatChiro; ?>"><?php echo "<img src='$base_url/$urlOfPictoChiroToDisplay' alt='$titleChiro' title='$titleChiro' />"; ?>
        <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Chiroptères</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoChiroToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelChiro; ?></p></div>            
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
    <!-- Invertébrés -->
    <?php if($urlOfPictoInvertToDisplay != ''): ?>
      <div class="onePicto invert <?php echo $etatInvert; ?>"><?php echo "<img src='$base_url/$urlOfPictoInvertToDisplay' alt='$etatInvert' title='$etatInvert' />"; ?>
        <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Invertébrés</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoInvertToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelInvert; ?></p></div>            
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
    <!-- Faune Marine -->
    <div class="onePicto expert connaissance fauneM" title='Faune Marine'>
      <?php 
        if($urlPictoSurchargeFauneM) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeFauneM' alt='$etatFauneM' title='$etatFauneM' />"; 
        else echo "<i>Expert</i>";        
        if($isRemarquableFauneM == '1') echo "<i class='star'>*</i>";
      ?>      
      <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Faune Marine</p>
            <div class="linePicto">
              <?php 
              if($urlPictoSurchargeFauneM != '') echo "<img src='$base_url/$urlPictoSurchargeFauneM'/>"; 
              else echo '<p class="noPicto">Pas de pictogramme</p>';               
              if($urlPictoSurchargeFauneM != '') echo "<p class='labelEtat'>".$labelEtatSurchargeFauneM."</p>";              
              ?>
            </div>
            <div class="remarquable"><?php if($isRemarquableFauneM == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueFauneM != '') echo '<label>Commentaire : </label>'.$comValueFauneM; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Faune Marine</p>            
            <div class="linePicto">
              <?php if($urlPictoSurchargeFauneM != '') echo "<img src='$base_url/$urlPictoSurchargeFauneM'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
              <?php echo '<div class="myFormOnVisu">'.$outputFauneM.'</div>'; ?>              
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>
        </div>
    </div>
    <!-- Flore Marine -->
    <div class="onePicto expert connaissance floreM" title='Flore Marine'>
       <?php 
        if($urlPictoSurchargeFloreM) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeFloreM' alt='$etatFloreM' title='$etatFloreM' />"; 
        else echo "<i>Expert</i>";        
        if($isRemarquableFloreM == '1') echo "<i class='star'>*</i>";
      ?>       
      <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Flore Marine</p>
            <div class="linePicto">
              <?php 
              if($urlPictoSurchargeFloreM != '') echo "<img src='$base_url/$urlPictoSurchargeFloreM'/>"; 
              else echo '<p class="noPicto">Pas de pictogramme</p>';               
              if($urlPictoSurchargeFloreM != '') echo "<p class='labelEtat'>".$labelEtatSurchargeFloreM."</p>"; 
              ?>
            </div>
            <div class="remarquable"><?php if($isRemarquableFloreM == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueFloreM != '') echo '<label>Commentaire : </label>'.$comValueFloreM; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Flore Marine</p>            
            <div class="linePicto">
              <?php if($urlPictoSurchargeFloreM != '') echo "<img src='$base_url/$urlPictoSurchargeFloreM'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
              <?php echo '<div class="myFormOnVisu">'.$outputFloreM.'</div>'; ?>              
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>
        </div>
    </div>
    <!-- Grotte / Fond rocheux -->
    <div class="onePicto expert connaissance grotte" title='Grotte / Fond rocheux'>
      <?php 
        if($urlPictoSurchargeGrotte) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeGrotte' alt='' title='' />"; 
        else echo "<i>Expert</i>";        
        if($isRemarquableGrotte == '1') echo "<i class='star'>*</i>";
      ?>      
      <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Grotte / Fond rocheux</p>
            <div class="linePicto">
              <?php 
              if($urlPictoSurchargeGrotte != '') echo "<img src='$base_url/$urlPictoSurchargeGrotte'/>"; 
              else echo '<p class="noPicto">Pas de pictogramme</p>';               
              if($urlPictoSurchargeGrotte != '') echo "<p class='labelEtat'>".$valuePictoSurchargeGrotte."</p>"; 
              ?>
            </div>
            <div class="remarquable"><?php if($isRemarquableGrotte == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueGrotte != '') echo '<label>Commentaire : </label>'.$comValueGrotte; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Grotte / Fond rocheux</p>            
            <div class="linePicto">
              <?php if($urlPictoSurchargeGrotte != '') echo "<img src='$base_url/$urlPictoSurchargeGrotte'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
              <?php echo '<div class="myFormOnVisu">'.$outputGrotte.'</div>'; ?>              
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>
        </div>
    </div>
    <!-- caractéristique environnentales -->
    <?php if($urlOfPictoEnviroToDisplay != ''): ?>
      <div class="onePicto inviro <?php echo $etatEnviro; ?>"><?php echo "<img src='$base_url/$urlOfPictoEnviroToDisplay' alt='$titleCaractEnv' title='$titleCaractEnv' />"; ?>
        <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Caractéristique environnentales</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEnviroToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelCaractEnv; ?></p></div>            
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
    <!-- Socio économie -->
    <?php if($urlOfPictoEcoToDisplay != ''): ?>
      <div class="onePicto invert <?php echo $etatEco; ?>"><?php echo "<img src='$base_url/$urlOfPictoEcoToDisplay' alt='$titleSocioEco' title='$titleSocioEco' />"; ?>
        <div class="popup"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Etat des connaissances</p>
            <p class="titleTypePicto">Socio économie</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEcoToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelSocioEco; ?></p></div>            
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
  </div>
  

  <?php echo $connaissances; ?>

  <h4>Intérêts :</h4>

  <?php 
  /*-- ----------------------------------------------------------------------------
  -- Intérêts des patrimoines
  -- ----------------------------------------------------------------------------*/

  //Botanique
  $sql = "select b.niveau from picto_intepa_bota b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatBota = $result['niveau'] - 1;
  
  //Ornithologie
  $sql = "select b.niveau from picto_intepa_ornitho b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatOrni = $result['niveau'] - 1;  
  
  //Herpétologie
  $sql = "select b.niveau from picto_intepa_herpeto b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatHerpe = $result['niveau'] - 1;
  
  //Mammifères
  $sql = "select b.niveau from picto_intepa_mamm b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatMami = $result['niveau'] - 1;
  
  //Chiroptères
  $sql = "select b.niveau from picto_intepa_chiro b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatChiro = $result['niveau'] - 1;
  
  //Invertébré
  //Valeur rentré par l'expert

  //Faune marine
  $sql = "select b.niveau from picto_intepa_faunem b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatFauneM = $result['niveau'] - 1;
  
  //Flore marine
  $sql = "select b.niveau from picto_intepa_florem b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatFloreM = $result['niveau'] - 1;
  
  //Grotte et fond rocheux -> Valeur rentré par l'expert

  //Paysage (Terre)
  $sql = "select b.niveau from picto_intepa_paysat b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatPaysT = $result['niveau'] - 1;

  //Paysage (Mer) -> Valeur rentré par l'expert
  
  //Patrimoine bâti -> Valeur rentré par l'expert
    
  //Création de richesse économique (Mer)
  $sql = "select b.niveau from picto_intepa_crem b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatEcoMer = $result['niveau'] - 1;
    
  //Création de richesse économique (Terre)
  $sql = "select b.niveau from picto_intepa_cret b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatEcoTerre = $result['niveau'] - 1;
  
  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Botanique et Interêt des patrimoines                
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Botanique';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsBota[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleBota = $row['title'];
    $labelBota = $row['field_book_value_picto_interet_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Ornithologie et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Ornithologie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsOrni[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleOrni = $row['title'];
    $labelOrni = $row['field_book_value_picto_interet_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Herpétologie et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Herpétologie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsHerpeto[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleHerpeto = $row['title'];
    $labelHerpe = $row['field_book_value_picto_interet_value']; 
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Mammifères et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Mammifères';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsMami[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleMami = $row['title'];
    $labelMami = $row['field_book_value_picto_interet_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Chiroptere et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Chiroptères';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsChiro[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleChiro = $row['title'];
    $labelChiro = $row['field_book_value_picto_interet_value'];
  }

  /*intervention manuel de l'expert pour invertébré*/

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Faune marine et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Faune marine';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsFauneM[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleFauneM = $row['title'];
    $labelFauneM = $row['field_book_value_picto_interet_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Flore marine et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Flore marine';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsFloreM[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleFloreM = $row['title'];
    $labelFloreM = $row['field_book_value_picto_interet_value'];
  }

  /*intervention manuel de l'expert pour Grotte et fond rocheux*/

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Paysage / Terre et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Paysager / Terre';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsPaysT[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titlePaysT = $row['title'];
    $labelPaysT = $row['field_book_value_picto_interet_value'];
  }

  /*intervention manuel de l'expert pour Paysage / Mer */
  /*intervention manuel de l'expert pour Patrimoine bâti */

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Création de richesse économique (Mer) et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Création de richesse économique (Mer)';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEcoMer[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleCreaRichessEcoMer = $row['title'];
    $labelCreaRichessEcoMer = $row['field_book_value_picto_interet_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Création de richesse économique (Terre) et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Création de richesse économique (Terre)';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEcoTerre[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleCreaRichessEcoTerre = $row['title'];
    $labelCreaRichessEcoTerre = $row['field_book_value_picto_interet_value'];
  }

  //On stock le bon picto en fonction de la valeur
  $urlOfPictoBotaToDisplay = $rowsBota[$etatBota];
  $urlOfPictoOrniToDisplay = $rowsOrni[$etatOrni];
  $urlOfPictoHerpetoToDisplay = $rowsHerpeto[$etatHerpe];
  $urlOfPictoMamitoToDisplay = $rowsMami[$etatMami];
  $urlOfPictoChiroToDisplay = $rowsChiro[$etatChiro];
  $urlOfPictoFauneMToDisplay = $rowsFauneM[$etatFauneM];
  $urlOfPictoFloreMToDisplay = $rowsFloreM[$etatFloreM];
  $urlOfPictoPaysTToDisplay = $rowsPaysT[$etatPaysT];
  $urlOfPictoEcoMerToDisplay = $rowsEcoMer[$etatEcoMer];
  $urlOfPictoEcoTerreToDisplay = $rowsEcoTerre[$etatEcoTerre];

  /*
  * BOTANIQUE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> bota
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'botanique' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueBota = $row['field_book_star_com_picto_value'];       
    $isRemarquableBota = $row['field_book_star_on_picto_value'];
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputBota = drupal_get_form($form_id, $node);

  /*
  * ORNITHOLOGIE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'ornithologie' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueOrni = $row['field_book_star_com_picto_value'];       
    $isRemarquableOrni = $row['field_book_star_on_picto_value'];        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputOrni = drupal_get_form($form_id, $node);

  /*
  * HERPETOLOGIE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'herpetologie' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueHerpe = $row['field_book_star_com_picto_value'];       
    $isRemarquableHerpe = $row['field_book_star_on_picto_value'];        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputHerpe = drupal_get_form($form_id, $node);

  /*
  * MAMIFERE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'mamifere' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueMami = $row['field_book_star_com_picto_value'];       
    $isRemarquableMami = $row['field_book_star_on_picto_value'];        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputMami = drupal_get_form($form_id, $node);

  /*
  * CHIROPTERE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'chiroptere' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueChiro = $row['field_book_star_com_picto_value'];       
    $isRemarquableChiro = $row['field_book_star_on_picto_value'];        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputChiro = drupal_get_form($form_id, $node);

  /*
  * INVERTEBRE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'invert' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueInvert = $row['field_book_star_com_picto_value'];       
    $isRemarquableInvert = $row['field_book_star_on_picto_value'];
    $valueOfPictoSurchargeInvert = $row['field_book_value_picto_surcharge_value'];        
    
    //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
    if($valueOfPictoSurchargeInvert != ''){
      //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
      $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargeInvert." AND t.name = 'Invertébrés';";  
      $result1 = db_query($sql1);
      if (!$result1) die('Invalid query: ' . mysql_error());
      else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargeInvert = $row['filepath'];
    }        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputInvert = drupal_get_form($form_id, $node);

  /*
  * FAUNE MARINE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'fauneM' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueFauneM_i = $row['field_book_star_com_picto_value'];       
    $isRemarquableFauneM_i = $row['field_book_star_on_picto_value'];        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputFauneM = drupal_get_form($form_id, $node);

  /*
  * FLORE MARINE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'floreM' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueFloreM_i = $row['field_book_star_com_picto_value'];       
    $isRemarquableFloreM_i = $row['field_book_star_on_picto_value'];        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputFloreM = drupal_get_form($form_id, $node);

  /*
  * GROTTE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'grotte' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueGrotteI = $row['field_book_star_com_picto_value'];       
    $isRemarquableGrotteI = $row['field_book_star_on_picto_value'];        
    $valueOfPictoSurchargeGrotteI = $row['field_book_value_picto_surcharge_value'];        
    
    //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
    if($valueOfPictoSurchargeGrotteI != ''){
      //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
      $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargeGrotteI." AND t.name = 'Grotte / fonds rocheux-sableux';";  
      $result1 = db_query($sql1);
      if (!$result1) die('Invalid query: ' . mysql_error());
      else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargeGrotteI = $row['filepath'];
    }

  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputGrotte = drupal_get_form($form_id, $node);

  /*
  * PAYSAGE / TERRE
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'paysT' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValuePaysT = $row['field_book_star_com_picto_value'];       
    $isRemarquablePaysT = $row['field_book_star_on_picto_value'];
    $valueOfPictoSurchargePaysT = $row['field_book_value_picto_surcharge_value'];        
    
    //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
    if($valueOfPictoSurchargePaysT != ''){
      //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
      $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargePaysT." AND t.name = 'Paysager / Terre';";  
      $result1 = db_query($sql1);
      if (!$result1) die('Invalid query: ' . mysql_error());
      else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargePaysT = $row['filepath'];
    }        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputPaysT = drupal_get_form($form_id, $node);

  /*
  * PAYSAGE / MER
  */
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'paysM' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValuePaysM = $row['field_book_star_com_picto_value'];       
    $isRemarquablePaysM = $row['field_book_star_on_picto_value'];
    $valueOfPictoSurchargePaysM = $row['field_book_value_picto_surcharge_value'];        
    
    //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
    if($valueOfPictoSurchargePaysM != ''){
      //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
      $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargePaysM." AND t.name = 'Paysager / Mer';";  
      $result1 = db_query($sql1);
      if (!$result1) die('Invalid query: ' . mysql_error());
      else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargePaysM = $row['filepath'];
    }        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputPaysM = drupal_get_form($form_id, $node);

  /*
  * PATRIMOINE BATI
  */
  //Get nid of picto_surcharge to load the correct node edit form -> bati
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'bati' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueBati = $row['field_book_star_com_picto_value'];       
    $isRemarquableBati = $row['field_book_star_on_picto_value'];
    $valueOfPictoSurchargeBati = $row['field_book_value_picto_surcharge_value'];        
    
    //Si on a une valeur surchargé alors on va chercher le pictogrammes correspondant
    if($valueOfPictoSurchargeBati != ''){
      //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici bota et interet
      $sql1 = "SELECT d.filepath, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND c.field_book_value_picto_interet_value = ".$valueOfPictoSurchargeBati." AND t.name = 'Patrimoine bâti';";  
      $result1 = db_query($sql1);
      if (!$result1) die('Invalid query: ' . mysql_error());
      else while (  $row  =  db_fetch_array($result1) ) $urlPictoSurchargeBati = $row['filepath'];
    }        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputBati = drupal_get_form($form_id, $node);

  /*
  * CREATION DE RICHESSE ECONOMIQUE - MER
  
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'ecoM' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueEcoM = $row['field_book_star_com_picto_value'];       
    $isRemarquableEcoM = $row['field_book_star_on_picto_value'];        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputEcoM = drupal_get_form($form_id, $node);

  /*
  * CREATION DE RICHESSE ECONOMIQUE - TERRE
  
  //Get nid of picto_surcharge to load the correct node edit form -> orni
  $idPictoMSurcharge = '';
  $sql = "SELECT n.nid, s.field_book_value_picto_surcharge_value, s.field_book_star_com_picto_value, s.field_book_star_on_picto_value FROM drp_node n LEFT JOIN drp_content_type_book_les_pictos_surcharge s ON s.nid = n.nid WHERE n.title='picto surcharge sur:".$nid."' AND s.field_book_type_picto_surcharge_value = 'ecoT' AND s.field_book_genre_picto_surcharge_value = 'interet';";  
  $result = db_query($sql);  
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $idPictoMSurcharge = $row['nid'];  
    $comValueEcoT = $row['field_book_star_com_picto_value'];       
    $isRemarquableEcoT = $row['field_book_star_on_picto_value'];        
  }
  if($idPictoMSurcharge != '') $node = node_load($idPictoMSurcharge);
  //else create a blank node    
  else $node = array('uid' => $user->uid, 'name' => (isset($user->name) ? $user->name : ''), 'type' => $node_type);  
  $outputEcoT = drupal_get_form($form_id, $node);*/

  //Transforme value of picto to label
  switch ($labelBota) {
    case 0: $labelBota = 'Pas de données'; break;
    case 1: $labelBota = 'Faible'; break;
    case 2: $labelBota = 'Moyen'; break;
    case 3: $labelBota = 'Fort'; break;    
  } // fin switch  
  switch ($labelOrni) {
    case 0: $labelOrni = 'Pas de données'; break;
    case 1: $labelOrni = 'Faible'; break;
    case 2: $labelOrni = 'Moyen'; break;
    case 3: $labelOrni = 'Fort'; break;    
  } // fin switch  
  switch ($labelHerpe) {
    case 0: $labelHerpe = 'Pas de données'; break;
    case 1: $labelHerpe = 'Faible'; break;
    case 2: $labelHerpe = 'Moyen'; break;
    case 3: $labelHerpe = 'Fort'; break;    
  } // fin switch 
  switch ($labelMami) {
    case 0: $labelMami = 'Pas de données'; break;
    case 1: $labelMami = 'Faible'; break;
    case 2: $labelMami = 'Moyen'; break;
    case 3: $labelMami = 'Fort'; break;    
  } // fin switch
  switch ($labelChiro) {
    case 0: $labelChiro = 'Pas de données'; break;
    case 1: $labelChiro = 'Faible'; break;
    case 2: $labelChiro = 'Moyen'; break;
    case 3: $labelChiro = 'Fort'; break;    
  } // fin switch   
  switch ($valueOfPictoSurchargeInvert) {
    case 0: $valueOfPictoSurchargeInvert = 'Pas de données'; break;
    case 1: $valueOfPictoSurchargeInvert = 'Faible'; break;
    case 2: $valueOfPictoSurchargeInvert = 'Moyen'; break;
    case 3: $valueOfPictoSurchargeInvert = 'Fort'; break;    
  } // fin switch   
  switch ($labelFauneM) {
    case 0: $labelFauneM = 'Pas de données'; break;
    case 1: $labelFauneM = 'Faible'; break;
    case 2: $labelFauneM = 'Moyen'; break;
    case 3: $labelFauneM = 'Fort'; break;    
  } // fin switch 
  switch ($labelFloreM) {
    case 0: $labelFloreM = 'Pas de données'; break;
    case 1: $labelFloreM = 'Faible'; break;
    case 2: $labelFloreM = 'Moyen'; break;
    case 3: $labelFloreM = 'Fort'; break;    
  } // fin switch  
  switch ($labelPaysT) {
    case 0: $labelPaysT = 'Pas de données'; break;
    case 1: $labelPaysT = 'Faible'; break;
    case 2: $labelPaysT = 'Moyen'; break;
    case 3: $labelPaysT = 'Fort'; break;    
  } // fin switch 
  switch ($valueOfPictoSurchargePaysT) {
    case 0: $valueOfPictoSurchargePaysT = 'Pas de données'; break;
    case 1: $valueOfPictoSurchargePaysT = 'Faible'; break;
    case 2: $valueOfPictoSurchargePaysT = 'Moyen'; break;
    case 3: $valueOfPictoSurchargePaysT = 'Fort'; break;    
  } // fin switch  
  switch ($valueOfPictoSurchargePaysM) {
    case 0: $valueOfPictoSurchargePaysM = 'Pas de données'; break;
    case 1: $valueOfPictoSurchargePaysM = 'Faible'; break;
    case 2: $valueOfPictoSurchargePaysM = 'Moyen'; break;
    case 3: $valueOfPictoSurchargePaysM = 'Fort'; break;    
  } // fin switch  
  switch ($labelCreaRichessEcoMer) {
    case 0: $labelCreaRichessEcoMer = 'Pas de données'; break;
    case 1: $labelCreaRichessEcoMer = 'Faible'; break;
    case 2: $labelCreaRichessEcoMer = 'Moyen'; break;
    case 3: $labelCreaRichessEcoMer = 'Fort'; break;    
  } // fin switch
  switch ($labelCreaRichessEcoTerre) {
    case 0: $labelCreaRichessEcoTerre = 'Pas de données'; break;
    case 1: $labelCreaRichessEcoTerre = 'Faible'; break;
    case 2: $labelCreaRichessEcoTerre = 'Moyen'; break;
    case 3: $labelCreaRichessEcoTerre = 'Fort'; break;    
  } // fin switch  
  switch ($valueOfPictoSurchargeGrotteI) {
    case 0: $valueOfPictoSurchargeGrotteI = 'Pas de connaissance'; break;
    case 1: $valueOfPictoSurchargeGrotteI = 'Faible'; break;
    case 2: $valueOfPictoSurchargeGrotteI = 'Moyen'; break;
    case 3: $valueOfPictoSurchargeGrotteI = 'Fort'; break;    
  } // fin switch
  switch ($valueOfPictoSurchargeBati) {
    case 0: $valueOfPictoSurchargeBati = 'Pas de connaissance'; break;
    case 1: $valueOfPictoSurchargeBati = 'Faible'; break;
    case 2: $valueOfPictoSurchargeBati = 'Moyen'; break;
    case 3: $valueOfPictoSurchargeBati = 'Fort'; break;    
  } // fin switch


  ?>
  
  <!-- Botanique -->
  <div class="lesPicto">
    <?php if($urlOfPictoBotaToDisplay != ''): ?>
      <div class="onePicto expert interet botanique"><?php echo "<img src='$base_url/$urlOfPictoBotaToDisplay' alt='$titleBota' title='$titleBota' />"; ?>
        <?php         
        if($isRemarquableBota == '1') echo "<i class='star'>*</i>";
        ?> 
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Botanique</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoBotaToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelBota; ?></p></div>            
            <div class="remarquable"><?php if($isRemarquableBota == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueBota != '') echo '<label>Commentaire : </label>'.$comValueBota; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Botanique</p>            
            <div class="linePicto">              
              <?php echo '<div class="myFormOnVisu">'.$outputBota.'</div>'; ?>
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>
        </div>
      </div>
    <?php endif; ?>  
    <!-- Ornithologie -->  
    <?php if($urlOfPictoOrniToDisplay != ''): ?>
      <div class="onePicto expert interet ornithologie"><?php echo "<img src='$base_url/$urlOfPictoOrniToDisplay' alt='$titleOrni' title='$titleOrni' />"; ?>        
        <?php         
        if($isRemarquableOrni == '1') echo "<i class='star'>*</i>";
        ?>
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Ornithologie</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoOrniToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelOrni; ?></p></div>
            <div class="remarquable"><?php if($isRemarquableOrni == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueOrni != '') echo '<label>Commentaire : </label>'.$comValueOrni; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Ornithologie</p>            
            <div class="linePicto">              
              <?php echo '<div class="myFormOnVisu">'.$outputOrni.'</div>'; ?>
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>          
        </div>
      </div>
    <?php endif; ?>    
    <!-- Herpétologie --> 
    <?php if($urlOfPictoHerpetoToDisplay != ''): ?>
      <div class="onePicto expert interet herpetologie"><?php echo "<img src='$base_url/$urlOfPictoHerpetoToDisplay' alt='$titleHerpeto' title='$titleHerpeto' />"; ?>      
        <?php         
        if($isRemarquableHerpe == '1') echo "<i class='star'>*</i>";
        ?>
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Herpétologie</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoHerpetoToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelHerpe; ?></p></div>            
            <div class="remarquable"><?php if($isRemarquableHerpe == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueHerpe != '') echo '<label>Commentaire : </label>'.$comValueHerpe; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>  
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Herpétologie</p>            
            <div class="linePicto">              
              <?php echo '<div class="myFormOnVisu">'.$outputHerpe.'</div>'; ?>
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>        
        </div>
      </div>
    <?php endif; ?>    
    <!-- Mammifères -->
    <?php if($urlOfPictoMamitoToDisplay != ''): ?>
      <div class="onePicto expert interet mamifere"><?php echo "<img src='$base_url/$urlOfPictoMamitoToDisplay' alt='$titleMami' title='$titleMami' />"; ?>        
        <?php         
        if($isRemarquableMami == '1') echo "<i class='star'>*</i>";
        ?>
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Mammifères</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoMamitoToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelMami; ?></p></div>            
            <div class="remarquable"><?php if($isRemarquableMami == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueMami != '') echo '<label>Commentaire : </label>'.$comValueMami; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Mammifères</p>            
            <div class="linePicto">              
              <?php echo '<div class="myFormOnVisu">'.$outputMami.'</div>'; ?>
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>          
        </div>
      </div>
    <?php endif; ?>    
    <!-- Chiroptere -->
    <?php if($urlOfPictoChiroToDisplay != ''): ?>
      <div class="onePicto expert interet chiroptere"><?php echo "<img src='$base_url/$urlOfPictoChiroToDisplay' alt='$titleChiro' title='$titleChiro' />"; ?>        
        <?php         
        if($isRemarquableChiro == '1') echo "<i class='star'>*</i>";
        ?>
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Chiroptere</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoChiroToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelChiro; ?></p></div>
            <div class="remarquable"><?php if($isRemarquableChiro == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueChiro != '') echo '<label>Commentaire : </label>'.$comValueChiro; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Chiroptere</p>            
            <div class="linePicto">              
              <?php echo '<div class="myFormOnVisu">'.$outputChiro.'</div>'; ?>
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>           
        </div>
      </div>
    <?php endif; ?>    
    <!-- Invertebré -->
    <div class="onePicto expert interet invert" title='Invertébré'>
      <?php 
        if($urlPictoSurchargeInvert) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeInvert' alt='' title='' />"; 
        else echo "<i>Expert</i>";        
        if($isRemarquableInvert == '1') echo "<i class='star'>*</i>";
      ?>      
      <div class="popup green"><div class="croix">X</div>
        <div class='visu'>
          <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Invertebré</p>
          <div class="linePicto">
            <?php 
            if($urlPictoSurchargeInvert != '') echo "<img src='$base_url/$urlPictoSurchargeInvert'/>"; 
            else echo '<p class="noPicto">Pas de pictogramme</p>';               
            if($urlPictoSurchargeInvert != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargeInvert."</p>"; 
            ?>
          </div>
          <div class="remarquable"><?php if($isRemarquableInvert == '1') echo "* Présence d'un lieu remarquable"; ?></div>
          <div class="commentaire"><?php if($comValueInvert != '') echo '<label>Commentaire : </label>'.$comValueInvert; ?></div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
        </div>
        <div class='edit'>
          <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Invertebré</p>            
          <div class="linePicto">
            <?php if($urlPictoSurchargeInvert != '') echo "<img src='$base_url/$urlPictoSurchargeInvert'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
            <?php echo '<div class="myFormOnVisu">'.$outputInvert.'</div>'; ?>              
          </div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
        </div>
      </div>
    </div>
    <!-- Faune marine -->
    <?php if($urlOfPictoFauneMToDisplay != ''): ?>
      <div class="onePicto expert interet fauneM"><?php echo "<img src='$base_url/$urlOfPictoFauneMToDisplay' alt='$titleFauneM' title='$titleFauneM' />"; ?>        
        <?php         
        if($isRemarquableFauneM_i == '1') echo "<i class='star'>*</i>";
        ?>
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Faune marine</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoFauneMToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelFauneM; ?></p></div>            
            <div class="remarquable"><?php if($isRemarquableFauneM_i == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueFauneM_i != '') echo '<label>Commentaire : </label>'.$comValueFauneM_i; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Faune marine</p>            
            <div class="linePicto">              
              <?php echo '<div class="myFormOnVisu">'.$outputFauneM.'</div>'; ?>
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>          
        </div>
      </div>
    <?php endif; ?>    
    <!-- Flore marine -->
    <?php if($urlOfPictoFloreMToDisplay != ''): ?>
      <div class="onePicto expert interet floreM"><?php echo "<img src='$base_url/$urlOfPictoFloreMToDisplay' alt='$titleFloreM' title='$titleFloreM' />"; ?>      
        <?php         
        if($isRemarquableFloreM_i == '1') echo "<i class='star'>*</i>";
        ?>
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Flore marine</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoFloreMToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelFloreM; ?></p></div>            
            <div class="remarquable"><?php if($isRemarquableFloreM_i == '1') echo "* Présence d'une espèce remarquable"; ?></div>
            <div class="commentaire"><?php if($comValueFloreM_i != '') echo '<label>Commentaire : </label>'.$comValueFloreM_i; ?></div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>
          <div class='edit'>
            <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Flore marine</p>            
            <div class="linePicto">              
              <?php echo '<div class="myFormOnVisu">'.$outputFloreM.'</div>'; ?>
            </div>
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
          </div>      
        </div>
      </div>
    <?php endif; ?>    
    <!-- Grotte / fond rocheux -->
    <div class="onePicto expert interet grotte" title='Grotte et fond rocheux'>
      <?php 
        if($urlPictoSurchargeGrotteI) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeGrotteI' alt='' title='' />"; 
        else echo "<i>Expert</i>";        
        if($isRemarquableGrotteI == '1') echo "<i class='star'>*</i>";
      ?>      
      <div class="popup green"><div class="croix">X</div>
        <div class='visu'>
          <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Grotte / Fond rocheux</p>
          <div class="linePicto">
            <?php 
            if($urlPictoSurchargeGrotteI != '') echo "<img src='$base_url/$urlPictoSurchargeGrotteI'/>"; 
            else echo '<p class="noPicto">Pas de pictogramme</p>';               
            if($urlPictoSurchargeGrotteI != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargeGrotteI."</p>"; 
            ?>
          </div>
          <div class="remarquable"><?php if($isRemarquableGrotteI == '1') echo "* Présence d'un lieu remarquable"; ?></div>
          <div class="commentaire"><?php if($comValueGrotteI != '') echo '<label>Commentaire : </label>'.$comValueGrotteI; ?></div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
        </div>
        <div class='edit'>
          <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Grotte / Fond rocheux</p>            
          <div class="linePicto">
            <?php if($urlPictoSurchargeGrotteI != '') echo "<img src='$base_url/$urlPictoSurchargeGrotteI'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
            <?php echo '<div class="myFormOnVisu">'.$outputGrotte.'</div>'; ?>              
          </div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
        </div>
      </div>
    </div>
    <!-- Paysage / Terre ici (valeur + surcharge)-->
    <?php if($urlOfPictoPaysTToDisplay != '' || $urlPictoSurchargePaysT != ''): ?>
    <div class="onePicto expert interet paysT">
        <?php 
        if($urlPictoSurchargePaysT != '') echo "<img class='surcharge' src='$base_url/$urlPictoSurchargePaysT' alt='' title='' />"; 
        else echo "<img src='$base_url/$urlOfPictoPaysTToDisplay' alt='' title='' />";      
        if($isRemarquablePaysT == '1') echo "<i class='star'>*</i>";
      ?>      
      <div class="popup green"><div class="croix">X</div>
        <div class='visu'>
          <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Paysage / Terre</p>
          <div class="linePicto">
            <?php 
            if($urlPictoSurchargePaysT != '') echo "<img src='$base_url/$urlPictoSurchargePaysT'/>"; 
            else echo "<img src='$base_url/$urlOfPictoPaysTToDisplay'/>"; 
            if($urlPictoSurchargePaysT != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargePaysT."</p>"; 
            else echo "<p class='labelEtat'>".$labelPaysT."</p>"; 
            ?>
          </div>
          <div class="remarquable"><?php if($isRemarquablePaysT == '1') echo "* Présence d'un lieu remarquable"; ?></div>
          <div class="commentaire"><?php if($comValuePaysT != '') echo '<label>Commentaire : </label>'.$comValuePaysT; ?></div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
        </div>
        <div class='edit'>
          <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Paysage / Terre</p>            
          <div class="linePicto">
            <?php 
            if($urlPictoSurchargePaysT != '') echo "<img src='$base_url/$urlPictoSurchargePaysT'/> <p class='desc'>Choisir une valeur pour surcharger le pictogramme</p>";
            else echo "<img src='$base_url/$urlOfPictoPaysTToDisplay'/>";            
            echo '<div class="myFormOnVisu">'.$outputPaysT.'</div>'; 
            ?>              
          </div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
        </div>
      </div>
    </div>
    <?php endif; ?>
    <!-- Paysage / Mer -->
    <div class="onePicto expert interet paysM" title='Paysage / Mer'>
      <?php 
        if($urlPictoSurchargePaysM) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargePaysM' alt='' title='' />"; 
        else echo "<i>Expert</i>";        
        if($isRemarquablePaysM == '1') echo "<i class='star'>*</i>";
      ?>      
      <div class="popup green"><div class="croix">X</div>
        <div class='visu'>
          <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Paysage / Mer</p>
          <div class="linePicto">
            <?php 
            if($urlPictoSurchargePaysM != '') echo "<img src='$base_url/$urlPictoSurchargePaysM'/>"; 
            else echo '<p class="noPicto">Pas de pictogramme</p>';               
            if($urlPictoSurchargePaysM != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargePaysM."</p>"; 
            ?>
          </div>
          <div class="remarquable"><?php if($isRemarquablePaysM == '1') echo "* Présence d'un lieu remarquable"; ?></div>
          <div class="commentaire"><?php if($comValuePaysM != '') echo '<label>Commentaire : </label>'.$comValuePaysM; ?></div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
        </div>
        <div class='edit'>
          <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Paysage / Mer</p>            
          <div class="linePicto">
            <?php if($urlPictoSurchargePaysM != '') echo "<img src='$base_url/$urlPictoSurchargePaysM'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
            <?php echo '<div class="myFormOnVisu">'.$outputPaysM.'</div>'; ?>              
          </div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
        </div>
      </div>
    </div>
    <!-- Patrimoine bâti -->
    <div class="onePicto expert interet bati" title='Patrimoine bâti'>
      <?php 
        if($urlPictoSurchargeBati) echo "<img class='surcharge' src='$base_url/$urlPictoSurchargeBati' alt='' title='' />"; 
        else echo "<i>Expert</i>";        
        if($isRemarquableBati == '1') echo "<i class='star'>*</i>";
      ?>      
      <div class="popup green"><div class="croix">X</div>
        <div class='visu'>
          <div class="actionLine"><a href="" class="visuPicto select">Voir</a><a href="" class="editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Patrimoine bâti</p>
          <div class="linePicto">
            <?php 
            if($urlPictoSurchargeBati != '') echo "<img src='$base_url/$urlPictoSurchargeBati'/>"; 
            else echo '<p class="noPicto">Pas de pictogramme</p>';               
            if($urlPictoSurchargeBati != '') echo "<p class='labelEtat'>".$valueOfPictoSurchargePaysM."</p>"; 
            ?>
          </div>
          <div class="remarquable"><?php if($isRemarquableBati == '1') echo "* Présence d'un lieu remarquable"; ?></div>
          <div class="commentaire"><?php if($comValueBati != '') echo '<label>Commentaire : </label>'.$comValueBati; ?></div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
        </div>
        <div class='edit'>
          <div class="actionLine"><a href="" class="visuPicto">Voir</a><a href="" class="select editPicto">Modifier</a></div>
          <p class="titleGenrePicto">Interêt des patrimoines</p>
          <p class="titleTypePicto">Patrimoine bâti</p>            
          <div class="linePicto">
            <?php if($urlPictoSurchargeBati != '') echo "<img src='$base_url/$urlPictoSurchargeBati'/>"; else echo '<p class="desc">Choisir une valeur pour afficher un pictogramme</p>'; ?>              
            <?php echo '<div class="myFormOnVisu">'.$outputBati.'</div>'; ?>              
          </div>
          <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>         
        </div>
      </div>
    </div>
    <!-- Création de richesse économique (Mer) -->
    <?php if($urlOfPictoEcoMerToDisplay != ''): ?>
      <div class="onePicto noexpert interet ecoM"><?php echo "<img src='$base_url/$urlOfPictoEcoMerToDisplay' alt='$titleCreaRichessEcoMer' title='$titleCreaRichessEcoMer' />"; ?>                
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Création de richesse économique (Mer)</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEcoMerToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelCreaRichessEcoMer; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>    
    <!-- Création de richesse économique (Terre) -->
    <?php if($urlOfPictoEcoTerreToDisplay != ''): ?>
      <div class="onePicto noexpert interet ecoT"><?php echo "<img src='$base_url/$urlOfPictoEcoTerreToDisplay' alt='$titleCreaRichessEcoTerre' title='$titleCreaRichessEcoTerre' />"; ?>                
        <div class="popup green"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Interêt des patrimoines</p>
            <p class="titleTypePicto">Création de richesse économique (Terre)</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEcoTerreToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelCreaRichessEcoTerre; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>                  
        </div>
      </div>
    <?php endif; ?>    
  </div>
  
  <?php echo $interet; ?>
    
  <h4>Pressions :</h4>
  <?php 
  /*-- ----------------------------------------------------------------------------
  -- Pressions
  -- ----------------------------------------------------------------------------*/

  //Desserte par navette  
  $sql = "select b.niveau from picto_press_denav b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatNavette = $result['niveau'];
  
  //Présence de bâti
  $sql = "select b.niveau from picto_press_preba b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatBati = $result['niveau'];
    
  //Activités touristisques
  $sql = "select b.niveau from picto_press_actou b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatTouriste = $result['niveau'];
    
  //Présence d'habitants à l'année
  $sql = "select b.niveau from picto_press_haban b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatHabitant = $result['niveau'];
    
  //Impacts des usages (Terre)
  $sql = "select b.niveau from picto_press_imusat b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatUsageTerre = $result['niveau'];
    
  //Impacts des usages (Mer)
  $sql = "select b.niveau from picto_press_imusam b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatUsageMer = $result['niveau'];
    
  //Espèces envahissantes terrestres
  $sql = "select b.niveau from picto_press_eet b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatEspTerre = $result['niveau'];
    
  //Espèces envahissantes marines
  $sql = "select b.niveau from picto_press_eem b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatEspMer = $result['niveau'];
    
  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Desserte par navette  et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Desserte par navette';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsNavette[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleNavette = $row['title'];
    $labelNavette = $row['field_book_value_picto_pression_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Présence de bâti  et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Présence de bâti';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsBati[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleBati = $row['title'];
    $labelBati = $row['field_book_value_picto_pression_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Activités touristisques et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Activités touristiques';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsTouriste[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleTouriste = $row['title'];
    $labelTouriste = $row['field_book_value_picto_pression_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Présence d'habitants à l'année et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = \"Présence d'habitants à l'année\";";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsHab[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleHab = $row['title'];
    $labelHab = $row['field_book_value_picto_pression_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Impacts des usages (Terre) et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Impact des usages / terre';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsUsageT[$row['field_book_value_picto_pression1_value']] = $row['filepath']; 
    $titleImpactUsageT = $row['title'];
    $labelImpactUsageT = $row['field_book_value_picto_pression1_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Impacts des usages (Mer) et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Impact des usages / mer';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsUsageM[$row['field_book_value_picto_pression1_value']] = $row['filepath']; 
    $titleImpactUsageM = $row['title'];
    $labelImpactUsageM = $row['field_book_value_picto_pression1_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Espèces envahissantes terrestres et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Espèces envahissantes / terrestres';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEspEnvahT[$row['field_book_value_picto_pression1_value']] = $row['filepath']; 
    $titleEspEnvahT = $row['title'];
    $labelEspEnvahT = $row['field_book_value_picto_pression1_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Espèces envahissantes marines et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Espèces envahissantes / marines';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEspEnvahM[$row['field_book_value_picto_pression1_value']] = $row['filepath']; 
    $titleEspEnvahM = $row['title'];
    $labelEspEnvahM = $row['field_book_value_picto_pression1_value'];
  }

  //On stock le bon picto en fonction de la valeur
  $urlOfPictoNavetteToDisplay = $rowsNavette[$etatNavette];
  $urlOfPictoEtatBatiToDisplay = $rowsBati[$etatBati];
  $urlOfPictoTouristeToDisplay = $rowsTouriste[$etatTouriste];
  $urlOfPictoHabToDisplay = $rowsHab[$etatHabitant];
  $urlOfPictoUsageTerreToDisplay = $rowsUsageT[$etatUsageTerre];
  $urlOfPictoUsageMerToDisplay = $rowsUsageM[$etatUsageMer];
  $urlOfPictoEspEnvahTerreToDisplay = $rowsEspEnvahT[$etatEspTerre];
  $urlOfPictoEspEnvahMerToDisplay = $rowsEspEnvahM[$etatEspMer];

  //Transforme value of picto to label
  switch ($labelNavette) {
    case 0: $labelNavette = '?'; break;
    case 1: $labelNavette = 'Non'; break;
    case 2: $labelNavette = 'Oui'; break;
    case 3: $labelNavette = '---'; break;    
  } // fin switch
  switch ($labelBati) {
    case 0: $labelBati = '?'; break;
    case 1: $labelBati = 'Non'; break;
    case 2: $labelBati = 'Oui'; break;
    case 3: $labelBati = '---'; break;    
  } // fin switch
  switch ($labelTouriste) {
    case 0: $labelTouriste = '?'; break;
    case 1: $labelTouriste = 'Non'; break;
    case 2: $labelTouriste = 'Oui'; break;
    case 3: $labelTouriste = '---'; break;    
  } // fin switch
  switch ($labelNavette) {
    case 0: $labelNavette = '?'; break;
    case 1: $labelNavette = 'Non'; break;
    case 2: $labelNavette = 'Oui'; break;
    case 3: $labelNavette = '---'; break;    
  } // fin switch
  switch ($labelHab) {
    case 0: $labelHab = '?'; break;
    case 1: $labelHab = 'Non'; break;
    case 2: $labelHab = 'Oui'; break;
    case 3: $labelHab = '---'; break;    
  } 
  switch ($labelImpactUsageT) {
    case 0: $labelImpactUsageT = '?'; break;
    case 1: $labelImpactUsageT = 'Nul'; break;
    case 2: $labelImpactUsageT = 'Faible'; break;
    case 3: $labelImpactUsageT = 'Moyen'; break;    
    case 4: $labelImpactUsageT = 'Fort'; break;    
  } // fin switch
  switch ($labelImpactUsageM) {
    case 0: $labelImpactUsageM = '?'; break;
    case 1: $labelImpactUsageM = 'Nul'; break;
    case 2: $labelImpactUsageM = 'Faible'; break;
    case 3: $labelImpactUsageM = 'Moyen'; break;    
    case 4: $labelImpactUsageM = 'Fort'; break;    
  } // fin switch
  switch ($labelEspEnvahT) {
    case 0: $labelEspEnvahT = '?'; break;
    case 1: $labelEspEnvahT = 'Nul'; break;
    case 2: $labelEspEnvahT = 'Faible'; break;
    case 3: $labelEspEnvahT = 'Moyen'; break;    
    case 4: $labelEspEnvahT = 'Fort'; break;    
  } // fin switch
  switch ($labelEspEnvahM) {
    case 0: $labelEspEnvahM = '?'; break;
    case 1: $labelEspEnvahM = 'Nul'; break;
    case 2: $labelEspEnvahM = 'Faible'; break;
    case 3: $labelEspEnvahM = 'Moyen'; break;    
    case 4: $labelEspEnvahM = 'Fort'; break;    
  } // fin switch
  
  ?>

  <div class="lesPicto">
    <!-- Desserte par navette -->
    <?php if($urlOfPictoNavetteToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoNavetteToDisplay' alt='$titleNavette' title='$titleNavette' />"; ?>
        <div class="popup red"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Pressions</p>
            <p class="titleTypePicto">Desserte par navette</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoNavetteToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelNavette; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>        
    <!-- Présence de bâti -->
    <?php if($urlOfPictoEtatBatiToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoEtatBatiToDisplay' alt='$titleBati' title='$titleBati' />"; ?>
        <div class="popup red"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Pressions</p>
            <p class="titleTypePicto">Présence de bâti</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEtatBatiToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelBati; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>        
    <!-- Activités touristiques -->
    <?php if($urlOfPictoTouristeToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoTouristeToDisplay' alt='$titleTouriste' title='$titleTouriste' />"; ?>
        <div class="popup red"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Pressions</p>
            <p class="titleTypePicto">Activités touristiques</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoTouristeToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelTouriste; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>        
    <!-- Présence d'habitants à l'année -->
    <?php if($urlOfPictoHabToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoHabToDisplay' alt='$titleHab' title='$titleHab' />"; ?>
        <div class="popup red"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Pressions</p>
            <p class="titleTypePicto">Présence d'habitants à l'année</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoHabToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelHab; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>   
    <!-- Impacts des usages / Terre -->     
    <?php if($urlOfPictoUsageTerreToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoUsageTerreToDisplay' alt='$titleImpactUsageT' title='$titleImpactUsageT' />"; ?>
        <div class="popup red"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Pressions</p>
            <p class="titleTypePicto">Impacts des usages / Terre</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoUsageTerreToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelImpactUsageT; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>        
    <!-- Impacts des usages / Mer -->     
    <?php if($urlOfPictoUsageMerToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoUsageMerToDisplay' alt='$titleImpactUsageM' title='$titleImpactUsageM' />"; ?>
        <div class="popup red"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Pressions</p>
            <p class="titleTypePicto">Impacts des usages / Mer</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoUsageMerToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelImpactUsageM; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>        
    <!-- Espèces envahissantes / Terrestres -->
    <?php if($urlOfPictoEspEnvahTerreToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoEspEnvahTerreToDisplay' alt='$titleEspEnvahT' title='$titleEspEnvahT' />"; ?>
        <div class="popup red"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Pressions</p>
            <p class="titleTypePicto">Espèces envahissantes / Terrestres</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEspEnvahTerreToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelEspEnvahT; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>        
    <!-- Espèces envahissantes / Marines -->
    <?php if($urlOfPictoEspEnvahMerToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoEspEnvahMerToDisplay' alt='$titleEspEnvahM' title='$titleEspEnvahM' />"; ?>
        <div class="popup red"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Pressions</p>
            <p class="titleTypePicto">Espèces envahissantes / Marines</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEspEnvahMerToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelEspEnvahM; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>    
      </div>
    <?php endif; ?>        
  </div>


  <?php echo $pression; ?>

  <h4>Gestion / conservation :</h4>

  <?php 
  /*-- ----------------------------------------------------------------------------
  -- Gestion / Conservation
  -- ----------------------------------------------------------------------------*/

  //Statut de protection terrestre
  $sql = "select b.niveau from picto_gecon_spt b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatProtectionT = $result['niveau'];
  
  //Statut de protection marin
  $sql = "select b.niveau from picto_gecon_spm b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatProtectionM = $result['niveau'];
  
  //Existence d'un gestionnaire
  $sql = "select b.niveau from picto_press_pregest b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatGestion = $result['niveau'];
  
  //Existence d'un gestionnaire sur le site
  $sql = "select b.niveau from picto_press_exgest b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatGestionSite = $result['niveau'];
  
  //Comité de gestion
  $sql = "select b.niveau from picto_press_cogest b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatComiteGestion = $result['niveau'];
  
  //Moyens disponibles
  $sql = "select b.niveau from picto_press_moydi b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatMoyenDispo = $result['niveau'];
  
  //Plan de gestion
  $sql = "select b.niveau from picto_press_plagest b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatPlanGestion = $result['niveau'];
  
  //Accès autorisé sur le site
  $sql = "select b.niveau from picto_press_accaut b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatAccesAutoSite = $result['niveau'];
  
  //Pêche autorisée sur le site
  $sql = "select b.niveau from picto_press_pecaut b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatPecheAutoSite = $result['niveau'];
  
  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Statut de protection terrestre et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Statut de protection terrestre';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsProtecT[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleStatutProtecT = $row['title'];
    $labelStatutProtecT = $row['field_book_value_picto_gestions_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Statut de protection marin et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Statut de protection marin';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsProtecM[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleStatutProtecM = $row['title'];
    $labelStatutProtecM = $row['field_book_value_picto_gestions_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Existence d'un gestionnaire et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = \"Existence d'un gestionnaire\";";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsExistGestion[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleGestion = $row['title'];
    $labelGestion = $row['field_book_value_picto_gestions_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Existence d'un gestionnaire sur le site" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions1_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Présence du gestionnaire sur le site';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsExistGestionSite[$row['field_book_value_picto_gestions1_value']] = $row['filepath']; 
    $titleGestionSite = $row['title'];
    $labelGestionSite = $row['field_book_value_picto_gestions1_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Comité de gestion" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Comité de gestion';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsComiteGestion[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleComiteGestion = $row['title'];
    $labelComiteGestion = $row['field_book_value_picto_gestions_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Moyens disponibles" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions2_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Moyens disponibles';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsMoyensDispo[$row['field_book_value_picto_gestions2_value']] = $row['filepath']; 
    $titleMoyensDispo = $row['title'];
    $labelMoyensDispo = $row['field_book_value_picto_gestions2_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Plan de gestion" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions3_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Plan de gestion';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsPlanGestion[$row['field_book_value_picto_gestions3_value']] = $row['filepath']; 
    $titlePlanGestion = $row['title'];
    $labelPlanGestion = $row['field_book_value_picto_gestions3_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Accès autorisé sur le site" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Accès autorisé sur le site';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsAcces[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleAccesAutoSite = $row['title'];
    $labelAccesAutoSite = $row['field_book_value_picto_gestions_value'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Pêche autorisée sur le site" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Pêche autorisée sur le site';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsPeche[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titlePecheAuto = $row['title'];
    $labelPecheAuto = $row['field_book_value_picto_gestions_value'];
  }

  //On stock le bon picto en fonction de la valeur
  $urlOfPictoProtecTerreToDisplay = $rowsProtecT[$etatProtectionT];
  $urlOfPictoProtecMerToDisplay = $rowsProtecM[$etatProtectionM];
  $urlOfPictoExisteGestionToDisplay = $rowsExistGestion[$etatGestion];
  $urlOfPictoExisteGestionSiteToDisplay = $rowsExistGestionSite[$etatGestionSite];
  $urlOfPictoEtatComiteGestionToDisplay = $rowsComiteGestion[$etatComiteGestion];
  $urlOfPictoMoyensDispoToDisplay = $rowsMoyensDispo[$etatMoyenDispo];
  $urlOfPictoPlanGestionToDisplay = $rowsPlanGestion[$etatPlanGestion];
  $urlOfPictoAccesToDisplay = $rowsAcces[$etatAccesAutoSite];
  $urlOfPictoPecheToDisplay = $rowsPeche[$etatPecheAutoSite];

  //Transforme value of picto to label
  switch ($labelStatutProtecT) {
    case 0: $labelStatutProtecT = '?'; break;
    case 1: $labelStatutProtecT = 'Non'; break;
    case 2: $labelStatutProtecT = 'Oui'; break;
    case 3: $labelStatutProtecT = '---'; break;    
  } // fin switch
  //Transforme value of picto to label
  switch ($labelStatutProtecM) {
    case 0: $labelStatutProtecM = '?'; break;
    case 1: $labelStatutProtecM = 'Non'; break;
    case 2: $labelStatutProtecM = 'Oui'; break;
    case 3: $labelStatutProtecM = '---'; break;    
  } // fin switch
//Transforme value of picto to label
  switch ($labelGestion) {
    case 0: $labelGestion = '?'; break;
    case 1: $labelGestion = 'Non'; break;
    case 2: $labelGestion = 'Oui'; break;
    case 3: $labelGestion = '---'; break;    
  } // fin switch
  switch ($labelGestionSite) {
    case 0: $labelGestionSite = '?'; break;
    case 1: $labelGestionSite = 'Nul'; break;
    case 2: $labelGestionSite = 'Temporaire'; break;
    case 3: $labelGestionSite = 'Permanente'; break;    
  } // fin switch
  switch ($labelComiteGestion) {
    case 0: $labelComiteGestion = '?'; break;
    case 1: $labelComiteGestion = 'Non'; break;
    case 2: $labelComiteGestion = 'Oui'; break;
    case 3: $labelComiteGestion = '---'; break;    
  } // fin switch
  switch ($labelMoyensDispo) {
    case 0: $labelMoyensDispo = '?'; break;
    case 1: $labelMoyensDispo = 'Nuls'; break;
    case 2: $labelMoyensDispo = 'Corrects'; break;
    case 3: $labelMoyensDispo = 'Importants'; break;    
  } // fin switch
  switch ($labelPlanGestion) {
    case 0: $labelPlanGestion = '?'; break;
    case 1: $labelPlanGestion = 'Non'; break;
    case 2: $labelPlanGestion = 'En projet'; break;
    case 3: $labelPlanGestion = 'Oui'; break;    
  } // fin switch
  switch ($labelAccesAutoSite) {
    case 0: $labelAccesAutoSite = '?'; break;
    case 1: $labelAccesAutoSite = 'Non'; break;    
    case 2: $labelAccesAutoSite = 'Oui'; break;    
    case 3: $labelAccesAutoSite = '---'; break;    
  } // fin switch
  switch ($labelPecheAuto) {
    case 0: $labelPecheAuto = '?'; break;
    case 1: $labelPecheAuto = 'Non'; break;    
    case 2: $labelPecheAuto = 'Oui'; break;    
    case 3: $labelPecheAuto = '---'; break;    
  } // fin switch

  ?>

  <div class="lesPicto">
    <!-- Statut de protection terrestre -->
    <?php if($urlOfPictoProtecTerreToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoProtecTerreToDisplay' alt='$titleStatutProtecT' title='$titleStatutProtecT' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Statut de protection terrestre</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoProtecTerreToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelStatutProtecT; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>  
    <!-- Statut de protection marin -->          
    <?php if($urlOfPictoProtecMerToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoProtecMerToDisplay' alt='$titleStatutProtecM' title='$titleStatutProtecM' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Statut de protection marin</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoProtecMerToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelStatutProtecM; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>  
    <!-- Existence d'un gestionaire -->          
    <?php if($urlOfPictoExisteGestionToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoExisteGestionToDisplay' alt='$titleGestion' title='$titleGestion' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Existence d'un gestionaire</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoExisteGestionToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelGestion; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>            
    <!-- Existence d'un gestionaire sur le site -->          
    <?php if($urlOfPictoExisteGestionSiteToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoExisteGestionSiteToDisplay' alt='$titleGestionSite' title='$titleGestionSite' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Existence d'un gestionaire sur le site</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoExisteGestionSiteToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelGestionSite; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>  
    <!-- Comité de gestion -->          
    <?php if($urlOfPictoEtatComiteGestionToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoEtatComiteGestionToDisplay' alt='$titleComiteGestion' title='$titleComiteGestion' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Comité de gestion</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoEtatComiteGestionToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelComiteGestion; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>            
    <!-- Moyens Disponibles -->
    <?php if($urlOfPictoMoyensDispoToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoMoyensDispoToDisplay' alt='$titleMoyensDispo' title='$titleMoyensDispo' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Comité de gestion</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoMoyensDispoToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelMoyensDispo; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>            
    <!-- Plan de gestion -->
    <?php if($urlOfPictoPlanGestionToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoPlanGestionToDisplay' alt='$titlePlanGestion' title='$titlePlanGestion' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Plan de gestion</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoPlanGestionToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelPlanGestion; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>        
    <!-- Accès autorisé sur le site -->    
    <?php if($urlOfPictoAccesToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoAccesToDisplay' alt='$titleAccesAutoSite' title='$titleAccesAutoSite' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Accès autorisé sur le site</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoAccesToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelAccesAutoSite; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>
    <!-- Pêche autorisé sur le site -->            
    <?php if($urlOfPictoPecheToDisplay != ''): ?>
      <div class="onePicto"><?php echo "<img src='$base_url/$urlOfPictoPecheToDisplay' alt='$titlePecheAuto' title='$titlePecheAuto' />"; ?>
        <div class="popup marron"><div class="croix">X</div>
          <div class='visu'>
            <div class="actionLine"><a href="" class="visuPicto select">Voir</a><!-- <a href="" class="editPicto">Modifier</a> --></div>
            <p class="titleGenrePicto">Gestion / Conservation</p>
            <p class="titleTypePicto">Pêche autorisé sur le site</p>
            <div class="linePicto"><img src='<?php echo "$base_url/$urlOfPictoPecheToDisplay"; ?>' alt="titleBota"><p class='labelEtat'><?php echo $labelPecheAuto; ?></p></div>                        
            <a class='linkToBase' href='<?php echo "$base_url/fiche-Ile/$code_ile"; ?>'>Donnée dans la base</a>
          </div>          
        </div>
      </div>
    <?php endif; ?>            
  </div>

  <?php echo $gestion; ?>
    

  <h3>Principales ressources bibliographiques :</h3>
  <div class='indentRight1'>
    
    <?php echo $biblio; ?>
    
  </div>

<?php else: ?>

  <a class='titleIsland' title='Edit' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  <br/>Written by: <i><?php echo $author; ?></i>

  <br/>
  <br/>
  <?php if($url_picture): ?>

    <div>
      <?php echo $url_picture; ?>
    </div>
    
  <?php endif; ?>
  <br/>

  <!-- lien vers la fiche ile -->
  <?php echo  "<a class='linkToFicheIle' href=".$base_url."/fiche-Ile/".$code_ile.">Island sheet</a>"; ?>

  <?php if($tid != ''): ?>
    <!-- Status description physique -->
    <?php print views_embed_view('v_atlas_tab_data_ile', 'block_1', $tid); ?>
    
    <!-- Status de propriete fonciere -->
    <TABLE class='tableRecapIle'>
      <?php print views_embed_view('v_atlas_tab_data_ile', 'block_2', $tid); ?>
    </TABLE>

    <!-- Status de protection internationnal-->
    <br/>
    <TABLE class='tableRecapIle'>
      <TR>
        <td></td>
        <td>Nom</td>
        <td>Année</td>
        <td>Zone concernée</td>        
      </TR>
        <?php print views_embed_view('v_atlas_tab_data_ile', 'block_3', $tid); ?>
    </TABLE>
    

    <!-- Status de protection nationnal-->
    <br/>
    <TABLE class='tableRecapIleN'>
      <TR>
        <td></td>
        <td>Nom</td>
        <td>Année</td>
        <td>Zone concernée</td>        
      </TR>
        <?php print views_embed_view('v_atlas_tab_data_ile', 'block_5', $tid); ?>
    </TABLE>
    
       
    <!-- Status de Gestion -->
    <?php $countNbTotalItem = views_get_view_result('v_atlas_tab_data_ile', 'block_4', $tid); ?>
    <?php if(!(empty($countNbTotalItem[0]))): ?>
    <table class='tableRecapIle'>
      <TR>
        <td></td>
        <td>Nom du gestionnaire</td>
        <td>Année de début de gestion</td>
        <td>Type d'accord</td>
      </TR>
      <?php print views_embed_view('v_atlas_tab_data_ile', 'block_4', $tid); ?> 
      
    </table>
    <br/>
    <?php endif; ?>
    
  <?php endif; ?>

  <?php echo $tab; ?>

  <div class='responsableBloc'>
    <h2>Responsable(s) :</h2>
    <?php $nodeOfSousBassinParent = node_load($idSousBassinParent, $revision = NULL, $reset = NULL);  ?>
    <?php 
    //On récupere un tableau d'uid des utilisateur enregsitré dans le champs "field_ss_bassin_responsable"
    $arrayOfUidOfResponsable = $nodeOfSousBassinParent->field_ss_bassin_responsable;


    //Parcour des uid
    foreach ($arrayOfUidOfResponsable as $value){
        
      //Charge l'utilisateur concerné
      $userCourant = user_load( $value['uid'] );

      //Concaténation des mails des responsables
      $allName .= "<a href=$base_url/user/$value[uid]>".$userCourant->name.'</a><br/>';

    }

    //Nettoyage de la string
    $allName = trim($allName, ",");
    echo $allName;
    ?>
  </div>

  <h3>General description</h3>

  <?php echo $descGen; ?>

  <h4>State of knowledge:</h4>

  <?php echo $connaissances; ?>

  <h4>Interest:</h4>
  <?php echo $interet; ?>
    
  <h4>Pressure and threats:</h4>
  <?php echo $pression; ?>

  <h4>Managment / Conservation:</h4>
  <?php echo $gestion; ?>
    

  <h3>Main bibliographic references:</h3>
  <div class='indentRight1'>
    
    <?php echo $biblio; ?>
    
  </div>

<?php endif; ?>
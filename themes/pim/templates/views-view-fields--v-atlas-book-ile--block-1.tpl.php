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
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Ornithologie et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Ornithologie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsOrni[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];   
    $titleOrnito = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Herpétologie et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Herpétologie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsHerpeto[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
    $titleHerpe = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Mammifères et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Mammifères';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsMami[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
    $titleMami = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Chiroptères et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Chiroptères';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsChiro[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
    $titleChiro = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Invertébrés et connaissance
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Invertébrés';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsInvert[$row['field_book_value_picto_connaiss_value']] = $row['filepath']; 
    $titleInvert = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici caractéristique environnentales
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Caractéristique environnementales';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsCaraEnviro[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
    $titleCaractEnv = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Socie économie
  $sql = "SELECT d.filepath, c.field_book_value_picto_connaiss_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_connaissances c ON c.field_book_picto_connaissance_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_connaiss_value WHERE n.type = 'book_les_pictos_connaissances' AND t.name = 'Socio economie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEco[$row['field_book_value_picto_connaiss_value']] = $row['filepath'];
    $titleSocioEco = $row['title'];    
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

  ?>

  <h4>Connaissances :</h4> 
  
  <div class="lesPicto">
    <?php if($urlOfPictoBotaToDisplay != ''): ?><div class="onePicto bota <?php echo $etatBota; ?>"><?php echo "<img src='$base_url/$urlOfPictoBotaToDisplay' alt='$titleBota' title='$titleBota' />"; ?></div><?php endif; ?>
    <?php if($urlOfPictoOrniToDisplay != ''): ?><div class="onePicto orni <?php echo $etatOrni; ?>"><?php echo "<img src='$base_url/$urlOfPictoOrniToDisplay' alt='$titleOrnito' title='$titleOrnito' />"; ?></div><?php endif; ?>
    <?php if($urlOfPictoHerpeToDisplay != ''): ?><div class="onePicto herpe <?php echo $etatHerpe; ?>"><?php echo "<img src='$base_url/$urlOfPictoHerpeToDisplay' alt='$titleHerpe' title='$titleHerpe' />"; ?></div><?php endif; ?>
    <?php if($urlOfPictoMamiToDisplay != ''): ?><div class="onePicto mammi <?php echo $etatMami; ?>"><?php echo "<img src='$base_url/$urlOfPictoMamiToDisplay' alt='$titleMami' title='$titleMami' />"; ?></div><?php endif; ?>
    <?php if($urlOfPictoChiroToDisplay != ''): ?><div class="onePicto chirop <?php echo $etatChiro; ?>"><?php echo "<img src='$base_url/$urlOfPictoChiroToDisplay' alt='$titleChiro' title='$titleChiro' />"; ?></div><?php endif; ?>
    <?php if($urlOfPictoInvertToDisplay != ''): ?><div class="onePicto invert <?php echo $etatInvert; ?>"><?php echo "<img src='$base_url/$urlOfPictoInvertToDisplay' alt='$etatInvert' title='$etatInvert' />"; ?></div>  <?php endif; ?>
    <?php if($urlOfPictoEnviroToDisplay != ''): ?><div class="onePicto inviro <?php echo $etatEnviro; ?>"><?php echo "<img src='$base_url/$urlOfPictoEnviroToDisplay' alt='$titleCaractEnv' title='$titleCaractEnv' />"; ?></div>  <?php endif; ?>
    <?php if($urlOfPictoEcoToDisplay != ''): ?><div class="onePicto invert <?php echo $etatEco; ?>"><?php echo "<img src='$base_url/$urlOfPictoEcoToDisplay' alt='$titleSocioEco' title='$titleSocioEco' />"; ?></div>  <?php endif; ?>
  </div>
  

  <?php echo $connaissances; ?>

  <h4>Intérêts :</h4>

  <?php 
  /*-- ----------------------------------------------------------------------------
  -- Intérêts des patrimoines
  -- ----------------------------------------------------------------------------*/

  //Botanique
  //...

  //Ornithologie
  $sql = "select b.niveau from picto_intepa_ornitho b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatOrni = $result['niveau'] - 1;
  
  //Herpétologie
  //...

  //Mammifères
  //...

  //Chiroptères
  $sql = "select b.niveau from picto_intepa_chiro b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatChiro = $result['niveau'] - 1;
  
  //Invertébré
  //...

  //Faune marine
  //...

  //Flore marine
  //...

  //Grotte et fond rocheux
  //...

  //Paysage (Terre)
  $sql = "select b.niveau from picto_intepa_paysat b where code_ile = '".$termName."'";           
  $result = db_query($sql);
  $result = db_fetch_array($result); 
  $etatPaysT = $result['niveau'] - 1;
    
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
  
  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Ornithologie et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Ornithologie';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsOrni[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleOrni = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Chiroptere et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Chiroptères';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsChiro[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleChiro = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Paysage / Terre et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Paysager / Terre';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsPaysT[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titlePaysT = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Création de richesse économique (Mer) et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Création de richesse économique (Mer)';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEcoMer[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleCreaRichessEcoMer = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Création de richesse économique (Terre) et Interêt des patrimoines
  $sql = "SELECT d.filepath, c.field_book_value_picto_interet_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_interet c ON c.field_book_picto_interet_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_interet_value WHERE n.type = 'book_les_pictos_interet' AND t.name = 'Création de richesse économique (Terre)';";
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEcoTerre[$row['field_book_value_picto_interet_value']] = $row['filepath']; 
    $titleCreaRichessEcoTerre = $row['title'];
  }

  //On stock le bon picto en fonction de la valeur
  $urlOfPictoOrniToDisplay = $rowsOrni[$etatOrni];
  $urlOfPictoChiroToDisplay = $rowsChiro[$etatChiro];
  $urlOfPictoPaysTToDisplay = $rowsPaysT[$etatPaysT];
  $urlOfPictoEcoMerToDisplay = $rowsEcoMer[$etatEcoMer];
  $urlOfPictoEcoTerreToDisplay = $rowsEcoTerre[$etatEcoTerre];
  ?>
  
  <div class="lesPicto">
    <?php if($urlOfPictoOrniToDisplay != ''): ?><div class="onePicto orni <?php echo $etatOrni; ?>"><?php echo "<img src='$base_url/$urlOfPictoOrniToDisplay' alt='$titleOrni' title='$titleOrni' />"; ?></div><?php endif; ?>    
    <?php if($urlOfPictoChiroToDisplay != ''): ?><div class="onePicto chiro <?php echo $etatChiro; ?>"><?php echo "<img src='$base_url/$urlOfPictoChiroToDisplay' alt='$titleChiro' title='$titleChiro' />"; ?></div><?php endif; ?>    
    <?php if($urlOfPictoPaysTToDisplay != ''): ?><div class="onePicto paysTM <?php echo $etatPaysT; ?>"><?php echo "<img src='$base_url/$urlOfPictoPaysTToDisplay' alt='$titlePaysT' title='$titlePaysT' />"; ?></div><?php endif; ?>    
    <?php if($urlOfPictoEcoMerToDisplay != ''): ?><div class="onePicto ecoM <?php echo $etatEcoMer; ?>"><?php echo "<img src='$base_url/$urlOfPictoEcoMerToDisplay' alt='$titleCreaRichessEcoMer' title='$titleCreaRichessEcoMer' />"; ?></div><?php endif; ?>    
    <?php if($urlOfPictoEcoTerreToDisplay != ''): ?><div class="onePicto ecoT <?php echo $etatEcoTerre; ?>"><?php echo "<img src='$base_url/$urlOfPictoEcoTerreToDisplay' alt='$titleCreaRichessEcoTerre' title='$titleCreaRichessEcoTerre' />"; ?></div><?php endif; ?>    
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
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Présence de bâti  et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Présence de bâti';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsBati[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleBati = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Activités touristisques et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Activités touristiques';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsTouriste[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleTouriste = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Présence d'habitants à l'année et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = \"Présence d'habitants à l'année\";";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsHab[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleHab = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Impacts des usages (Terre) et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Impact des usages / terre';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsUsageT[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleImpactUsageT = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Impacts des usages (Mer) et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Impact des usages / mer';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsUsageM[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleImpactUsageM = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Espèces envahissantes terrestres et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Espèces envahissantes / terrestres';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEspEnvahT[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleEspEnvahT = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Espèces envahissantes marines et Pressions
  $sql = "SELECT d.filepath, c.field_book_value_picto_pression_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_pression c ON c.field_book_picto_pression_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_pression_value WHERE n.type = 'book_les_pictos_pression' AND t.name = 'Espèces envahissantes / marines';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsEspEnvahM[$row['field_book_value_picto_pression_value']] = $row['filepath']; 
    $titleEspEnvahM = $row['title'];
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

  ?>

  <div class="lesPicto">
    <?php if($urlOfPictoNavetteToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoNavetteToDisplay' alt='$titleNavette' title='$titleNavette' />"; ?></div><?php endif; ?>        
    <?php if($urlOfPictoEtatBatiToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoEtatBatiToDisplay' alt='$titleBati' title='$titleBati' />"; ?></div><?php endif; ?>        
    <?php if($urlOfPictoTouristeToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoTouristeToDisplay' alt='$titleTouriste' title='$titleTouriste' />"; ?></div><?php endif; ?>        
    <?php if($urlOfPictoHabToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoHabToDisplay' alt='$titleHab' title='$titleHab' />"; ?></div><?php endif; ?>        
    <?php if($urlOfPictoUsageTerreToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoUsageTerreToDisplay' alt='$titleImpactUsageT' title='$titleImpactUsageT' />"; ?></div><?php endif; ?>        
    <?php if($urlOfPictoUsageMerToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoUsageMerToDisplay' alt='$titleImpactUsageM' title='$titleImpactUsageM' />"; ?></div><?php endif; ?>        
    <?php if($urlOfPictoEspEnvahTerreToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoEspEnvahTerreToDisplay' alt='$titleEspEnvahT' title='$titleEspEnvahT' />"; ?></div><?php endif; ?>        
    <?php if($urlOfPictoEspEnvahMerToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoEspEnvahMerToDisplay' alt='$titleEspEnvahM' title='$titleEspEnvahM' />"; ?></div><?php endif; ?>        
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
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Statut de protection marin et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Statut de protection marin';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsProtecM[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleStatutProtecM = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici Existence d'un gestionnaire et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = \"Existence d'un gestionnaire\";";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsExistGestion[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleGestion = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Existence d'un gestionnaire sur le site" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Présence du gestionnaire sur le site';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsExistGestionSite[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleGestionSite = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Comité de gestion" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Comité de gestion';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsComiteGestion[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleComiteGestion = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Moyens disponibles" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Moyens disponibles';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsMoyensDispo[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleMoyensDispo = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Plan de gestion" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Plan de gestion';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsPlanGestion[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titlePlanGestion = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Accès autorisé sur le site" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Accès autorisé sur le site';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsAcces[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titleAccesAutoSite = $row['title'];
  }

  //On enregistre tous les chemins de pictos en fonction du type de picto (Botanique, Ornitologie...) et de son genre (connaissance, intérêt, pression...) -> ici "Pêche autorisée sur le site" et Gestion / Conservation
  $sql = "SELECT d.filepath, c.field_book_value_picto_gestions_value, n.title FROM drp_files d LEFT JOIN drp_content_type_book_les_pictos_gestions c ON c.field_book_picto_gestions_fid = d.fid LEFT JOIN drp_node n ON n.vid = c.vid LEFT JOIN drp_term_data t ON t.tid = c.field_book_type_picto_gestions_value WHERE n.type = 'book_les_pictos_gestions' AND t.name = 'Pêche autorisée sur le site';";  
  $result = db_query($sql);
  if (!$result) die('Invalid query: ' . mysql_error());
  else while (  $row  =  db_fetch_array($result) ) {
    $rowsPeche[$row['field_book_value_picto_gestions_value']] = $row['filepath']; 
    $titlePecheAuto = $row['title'];
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

  ?>

  <div class="lesPicto">
    <?php if($urlOfPictoProtecTerreToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoProtecTerreToDisplay' alt='$titleStatutProtecT' title='$titleStatutProtecT' />"; ?></div><?php endif; ?>            
    <?php if($urlOfPictoProtecMerToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoProtecMerToDisplay' alt='$titleStatutProtecM' title='$titleStatutProtecM' />"; ?></div><?php endif; ?>            
    <?php if($urlOfPictoExisteGestionToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoExisteGestionToDisplay' alt='$titleGestion' title='$titleGestion' />"; ?></div><?php endif; ?>            
    <?php if($urlOfPictoExisteGestionSiteToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoExisteGestionSiteToDisplay' alt='$titleGestionSite' title='$titleGestionSite' />"; ?></div><?php endif; ?>            
    <?php if($urlOfPictoEtatComiteGestionToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoEtatComiteGestionToDisplay' alt='$titleComiteGestion' title='$titleComiteGestion' />"; ?></div><?php endif; ?>            
    <?php if($urlOfPictoMoyensDispoToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoMoyensDispoToDisplay' alt='$titleMoyensDispo' title='$titleMoyensDispo' />"; ?></div><?php endif; ?>            
    <?php if($urlOfPictoPlanGestionToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoPlanGestionToDisplay' alt='$titlePlanGestion' title='$titlePlanGestion' />"; ?></div><?php endif; ?>            
    <?php if($urlOfPictoAccesToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoAccesToDisplay' alt='$titleAccesAutoSite' title='$titleAccesAutoSite' />"; ?></div><?php endif; ?>            
    <?php if($urlOfPictoPecheToDisplay != ''): ?><div class="onePicto navette <?php echo $etatNavette; ?>"><?php echo "<img src='$base_url/$urlOfPictoPecheToDisplay' alt='$titlePecheAuto' title='$titlePecheAuto' />"; ?></div><?php endif; ?>            
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
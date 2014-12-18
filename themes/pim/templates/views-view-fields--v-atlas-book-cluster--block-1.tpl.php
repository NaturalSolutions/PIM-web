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
/*                   VUE AFFICHE FIELDS OF CLUSTER                         */
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

<?php if ($id == 'field_cluster_have_ile_nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $have_iles = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_connaiss_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $connaissances = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_interet_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $interet = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_pression_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $pression = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_gest_conserv_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $gestion = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_image_fid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $url_picture = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_have_ss_bassin_nid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $have_ss_bassin = $field->content; ?>
  <?php endif; ?>
<?php endif;?>


<?php if ($id == 'field_cluster_biblio_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $biblio = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_autor_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $author = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_desc_gen_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $descGen = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_tab_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $tab = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'field_cluster_code_value') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $field_cluster_code_value = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php if ($id == 'tid') : ?>
  <?php if (!empty($field->content)): ?>
    <?php $tid = $field->content; ?>
  <?php endif; ?>
<?php endif;?>

<?php endforeach; ?>


<?php //echo $field_cluster_code_value; ?><br/>

<!-- Vu qui récupere tout les tid -->
<?php $res = views_get_view_result('v_atlas_book_cluster', 'block_2', $nid); ?>

<?php //parcour des tid 
for($i=0;$i<count($res);$i++){ 
  
  
  //Notre tid courant
  $currentTid = $res[$i]->term_data_node_data_field_cluster_code_tid;

  //Notre nom de terme courant
  $currentTermeName = $res[$i]->term_data_node_data_field_cluster_code_name;

  //On test si c'est une ile ou un archipele (son nom finit par 0)
  $isArchipel = 0;
  if(substr($currentTermeName, -1) == '0') $isArchipel = 1;
  
  
  //Si c'est une archipele
  if($isArchipel == 1){

    //On récupère le terme à partir du tid
    $term = taxonomy_get_term($currentTid);
    
    //On récupère le vid à partir d'un terme
    $vid = $term->vid;
    
    //Avec le vid, on récupère les enfants d'un terme en spécifiant le parent tid égale à notre tid courant
    $var  = taxonomy_get_tree($vid, $parent = $currentTid, $depth = -1, $max_depth = NULL);
    
    //On parcour les enfants pour stocker dans une variable tous les tid
    for($j=0;$j<count($var);$j++){ 

      $allTheTid .= $var[$j]->tid.',';
      $allTheTidCluster .= $var[$j]->tid.',';
    }

  //Sinon => traiter comme une ile
  }else if($isArchipel == 0){ 

    //On ajoute directement l'id dans notre variable qui regroupe tout les tid
    $allTheTid .= $currentTid.',';
    $allTheTidIle .= $currentTid.',';

  }
  
}

//On énlève la dernière virgule des string de tid
$allTheTid = trim($allTheTid, ",");
$allTheTidCluster = trim($allTheTidCluster, ",");
$allTheTidIle = trim($allTheTidIle, ",");
?>

<?php //print_r($allTheTidIle); ?>


<?php if($language->language == 'fr'): ?>

  <a class='titleCulster' title='Editer' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  <br/>Rédigé par : <i><?php echo $author; ?></i>

  <br/>
  <br/>
  <?php if($url_picture): ?>

    <div>
      <?php echo $url_picture; ?>
    </div>

  <?php endif; ?>
  <br/>

  <?php if($allTheTid != ''): ?>
    
    <!-- Recherche des noms d'îles à partir des clusters renseignés -->
    <?php $names = views_get_view_result('v_atlas_tab_data_cluster', 'block_5', $allTheTidCluster); ?>
    

    <?php 
    //On concatène tous les noms d'iles provenant de cluster dans une string
    if(!empty($names)) $allNamesIles = "<div title='Archipel complet' class='icon-cluster'></div>";
    for($i=0; $i<count($names); $i++){
      
      if($names[$i+1]->nid != $names[$i]->nid){ 
        
        $thirdCharOfCurrentTid = substr($names[$i]->term_data_node_data_field_bdi_dp_nom_ile_code_ile_name, 0, 3);
        $thirdCharOfNextTid = substr($names[$i-1]->term_data_node_data_field_bdi_dp_nom_ile_code_ile_name, 0, 3);
        

        if($i != 0 && $thirdCharOfCurrentTid != $thirdCharOfNextTid) $allNamesIles .= "<div title='Archipel complet' class='icon-cluster'></div>";

        $allNamesIles .= "<a href='".$base_url."/fiche-Ile/".$names[$i]->term_data_node_data_field_bdi_dp_nom_ile_code_ile_name."' target='_blank'>".$names[$i]->term_data_node_data_field_bdi_dp_nom_ile_code_ile__term_synonym_name.'</a><br/>'; 
        
      }
    
    } 
    ?>


    <!-- Recherche des noms d'îles à partir des iles renseignés -->
    <?php $names = views_get_view_result('v_atlas_tab_data_cluster', 'block_5', $allTheTidIle); ?>

    <?php //On concatène une icone d'ile
    if(count($names) > 0) $allNamesIles .= "<div title='îles' class='icon-ile'></div>";
    ?>
      
    <?php 
    //On concatène tous les noms d'iles seules dans une string
    for($i=0; $i<count($names); $i++){
      
      if($names[$i+1]->nid != $names[$i]->nid){ 
        $allNamesIles .= "<a href='".$base_url."/fiche-Ile/".$names[$i]->term_data_node_data_field_bdi_dp_nom_ile_code_ile_name."' target='_blank'>".$names[$i]->term_data_node_data_field_bdi_dp_nom_ile_code_ile__term_synonym_name.'</a><br/>'; 
      }
    
    } 
    ?>
    
    <!-- Calcul de la surface emmergé cummulé -->
    <?php $surface = views_get_view_result('v_atlas_tab_data_cluster', 'block_1', $allTheTid); ?>
    
    <?php 
    $surfaceCumule = 0;
    for($i=0; $i<count($surface); $i++){
      if(!empty($surface[$i]->node_data_field_bdi_dp_nom_ile_code_ile_field_bdi_dp_sup_terrestre_ha_value)) $surfaceCumule += $surface[$i]->node_data_field_bdi_dp_nom_ile_code_ile_field_bdi_dp_sup_terrestre_ha_value;
    } 
    ?>

  
    <!-- Recherche du nombre d'îles avec au moins 1 statut de protection -->
    <?php $StatutProtection = views_get_view_result('v_atlas_tab_data_cluster', 'block_2', $allTheTid); ?>
  
    <?php 
    $cptStatut = 0;
    for($i=0; $i<count($StatutProtection); $i++){
      if(!empty($StatutProtection[$i]->term_data_term_hierarchy_name)){

       if($StatutProtection[$i+1]->term_data_node_data_field_bdi_spt_code_ile_ilot_name != $StatutProtection[$i]->term_data_node_data_field_bdi_spt_code_ile_ilot_name && $StatutProtection[$i+1]->term_data_node_data_field_bdi_spt_code_ile_ilot__term_synonym_name != $StatutProtection[$i]->term_data_node_data_field_bdi_spt_code_ile_ilot__term_synonym_name){ 

          $allTidForCalculPourcent .= $StatutProtection[$i]->term_data_node_data_field_bdi_spt_code_ile_ilot_tid.',';

          $codeIles = $StatutProtection[$i]->term_data_node_data_field_bdi_spt_code_ile_ilot_name;
          $allNamesIles2 .= "<a href='".$base_url."/fiche-Ile/".$codeIles."' target='_blank'>".$StatutProtection[$i]->term_data_node_data_field_bdi_spt_code_ile_ilot__term_synonym_name.'</a><br/>';
                    
          $cptStatut++;
        
        }
      } 
    }
    ?>

    <!-- Calcul du % de surface emmergé cummulé possèdant un statut -->
    <?php $allTidForCalculPourcent = trim($allTidForCalculPourcent, ","); ?>
    <?php $surfacePourcentAvcStatut = views_get_view_result('v_atlas_tab_data_cluster', 'block_8', $allTidForCalculPourcent); ?>

    <?php 
    $surfaceCumuleAvecStatut = 0;
    for($i=0; $i<count($surfacePourcentAvcStatut); $i++){
      if(!empty($surfacePourcentAvcStatut[$i]->node_data_field_bdi_dp_nom_ile_code_ile_field_bdi_dp_sup_terrestre_ha_value)) $surfaceCumuleAvecStatut += $surfacePourcentAvcStatut[$i]->node_data_field_bdi_dp_nom_ile_code_ile_field_bdi_dp_sup_terrestre_ha_value;
    } 
    ?>

    
     <!-- Recherche du nombre d'îles avec au moins 1 statut de gestion -->
    <?php $StatutGestion = views_get_view_result('v_atlas_tab_data_cluster', 'block_3', $allTheTid); ?>
    
    <?php 
    $cptGestion = 0;
    for($i=0; $i<count($StatutGestion); $i++){
      if($StatutGestion[$i]->node_data_field_bdi_g_code_ile_ilot_field_bdi_g_exist_gestionnaire_value == 'Oui'){

        if($StatutGestion[$i+1]->term_data_node_data_field_bdi_g_code_ile_ilot_name != $StatutGestion[$i]->term_data_node_data_field_bdi_g_code_ile_ilot_name && $StatutGestion[$i+1]->term_data_node_data_field_bdi_g_code_ile_ilot__term_synonym_name != $StatutGestion[$i]->term_data_node_data_field_bdi_g_code_ile_ilot__term_synonym_name){ 

          $codeIles = $StatutGestion[$i]->term_data_node_data_field_bdi_g_code_ile_ilot_name;
          $allNamesIles3 .= "<a href='".$base_url."/fiche-Ile/".$codeIles."' target='_blank'>".$StatutGestion[$i]->term_data_node_data_field_bdi_g_code_ile_ilot__term_synonym_name.'</a><br/>';
                              
          $cptGestion++;
        
        }
      } 
    }
    ?>

     <!-- Recherche du nombre d'îles avec au moins 1 statut propriete publique -->
    <?php $StatutPropriete_publique = views_get_view_result('v_atlas_tab_data_cluster', 'block_4', $allTheTid); ?>

    <?php 
    $cptPropriete_publique = 0;
    for($i=0; $i<count($StatutPropriete_publique); $i++){
      if($StatutPropriete_publique[$i]->node_data_field_bdi_sp_code_ile_ilot_field_bdi_sp_public_value == 'Oui'){

      if($StatutPropriete_publique[$i+1]->term_data_node_data_field_bdi_sp_code_ile_ilot_name != $StatutPropriete_publique[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot_name && $StatutPropriete_publique[$i+1]->term_data_node_data_field_bdi_sp_code_ile_ilot__term_synonym_name != $StatutPropriete_publique[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot__term_synonym_name){ 

          $codeIles = $StatutPropriete_publique[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot_name;
          $allNamesIles4 .= "<a href='".$base_url."/fiche-Ile/".$codeIles."' target='_blank'>".$StatutPropriete_publique[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot__term_synonym_name.'</a><br/>';
                              
          $cptPropriete_publique++;
        
        }
      } 
    }
    ?>

    <!-- Recherche du nombre d'îles avec au moins 1 statut propriete prive -->
    <?php $StatutPropriete_prive = views_get_view_result('v_atlas_tab_data_cluster', 'block_6', $allTheTid); ?>
    
    <?php 
    $cptPropriete_prive = 0;
    for($i=0; $i<count($StatutPropriete_prive); $i++){
      if($StatutPropriete_prive[$i]->node_data_field_bdi_sp_code_ile_ilot_field_bdi_sp_privee_value == 'Oui'){

        if($StatutPropriete_prive[$i+1]->term_data_node_data_field_bdi_sp_code_ile_ilot_name != $StatutPropriete_prive[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot_name && $StatutPropriete_prive[$i+1]->term_data_node_data_field_bdi_sp_code_ile_ilot__term_synonym_name != $StatutPropriete_prive[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot__term_synonym_name){ 

          $codeIles = $StatutPropriete_prive[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot_name;
          $allNamesIles5 .= "<a href='".$base_url."/fiche-Ile/".$codeIles."' target='_blank'>".$StatutPropriete_prive[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot__term_synonym_name.'</a><br/>';
                    
          $cptPropriete_prive++;
        
        }
      } 
    }
    ?>

    <!-- Recherche du nombre d'îles avec au moins 1 statut propriete prive/publique -->
    <?php $StatutPropriete_prive_publique = views_get_view_result('v_atlas_tab_data_cluster', 'block_7', $allTheTid); ?>
    
    <?php 
    $cptPropriete_prive_publique = 0;
    for($i=0; $i<count($StatutPropriete_prive_publique); $i++){
      if($StatutPropriete_prive_publique[$i]->node_data_field_bdi_sp_code_ile_ilot_field_bdi_sp_privee_value == 'Oui' && $StatutPropriete_prive_publique[$i]->node_data_field_bdi_sp_code_ile_ilot_field_bdi_sp_public_value == 'Oui'){

        
        if($StatutPropriete_prive_publique[$i+1]->term_data_node_data_field_bdi_sp_code_ile_ilot_name != $StatutPropriete_prive_publique[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot_name){ 

          $codeIles = $StatutPropriete_prive_publique[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot_name;
          $allNamesIles6 .= "<a href='".$base_url."/fiche-Ile/".$codeIles."' target='_blank'>".$StatutPropriete_prive_publique[$i]->term_data_node_data_field_bdi_sp_code_ile_ilot__term_synonym_name.'</a><br/>';
                    
          $cptPropriete_prive_publique++;
        
        }
      } 
    }
    ?>
    
      
    <!--  Recap Cluster -->
    <TABLE class='tableRecapIle'>
      <TR>
        <th><center>îles</center></th>
        <th>Surface emergée cumulée<br/><br/><center>(ha)</center></th>
        <th>Surface emergée cumulée avec statut<br/><br/><center>%</center></th>
        <th>Nombre d'îles avec au moins 1 statut de protection</th>
        <th>Nombre d'îles avec au moins 1 gestionnaire</th>
        <th>Nombre d'îles publiques</th>
        <th>Nombre d'îles privées</th>
        <th>Nombre d'îles <br/>privées/<br/>publiques</th>
      </TR>
      <TR>
        <td><?php if(!empty($allNamesIles)) echo $allNamesIles; else echo '-'; ?></td>
        <td><center><?php echo $surfaceCumule; ?></center></td>
        <td><center><?php echo round(((100*$surfaceCumuleAvecStatut) / $surfaceCumule), 2); ?></center></td>
        <td><center><?php echo $cptStatut; ?><br/><small><?php if(!empty($allNamesIles2)) echo $allNamesIles2; ?></small></center></td>
        <td><center><?php echo $cptGestion; ?><br/><small><?php if(!empty($allNamesIles3)) echo $allNamesIles3; ?></small></center></td>
        <td><center><?php echo $cptPropriete_publique; ?><br/><small><?php if(!empty($allNamesIles4)) echo $allNamesIles4; ?></small></center></td>
        <td><center><?php echo $cptPropriete_prive; ?><br/><small><?php if(!empty($allNamesIles5)) echo $allNamesIles5; ?></small></center></td>
        <td><center><?php echo $cptPropriete_prive_publique; ?><br/><small><?php if(!empty($allNamesIles6)) echo $allNamesIles6; ?></small></center></td>
      </TR>
      
    </TABLE>
  <?php endif; ?>


  <?php echo $tab; ?>

  <h3> Description générale</h3>

  <?php echo $descGen; ?>

  <h4>Connaissances :</h4>

  <?php echo $connaissances; ?>

  <h4>Intérêts :</h4>
  <?php echo $interet; ?>
    
  <h4>Pressions :</h4>
  <?php echo $pression; ?>

  <h4>Gestion / conservation :</h4>
  <?php echo $gestion; ?>
    
    


  <h3>Principales ressources bibliographiques :</h3>
  <div class='indentRight1'>
    
    <?php echo $biblio; ?>
    
  </div>

  <!-- <h3>Est présent dans le sous bassin :</h3> -->
  <!-- <div class='indentRight1'> -->
   
   <!-- <?php //echo $have_ss_bassin; ?> -->
    
  <!-- </div> -->

  <h3>Îles présentes dans ce cluster :</h3>
  <div class='indentRight1'>
   
   <?php if($have_iles) echo $have_iles; else echo 'Aucune'; ?>
    
  </div>

<?php else: ?>
  
  <a class='titleCulster' title='Edit' href="<?php echo $base_url; ?>/node/<?php echo $nid; ?>/edit"><h1><?php echo $title; ?></h1></a>
  <br/>Written by: <i><?php echo $author; ?></i>

  <br/>
  <br/>
  <?php if($url_picture): ?>

    <div>
      <?php echo $url_picture; ?>
    </div>
    <!--  <img class='imageMap' src="<?php //echo $base_url.'/sites/default/files/atlas/ss_bassin/'.$url_picture; ?>" alt='' title='' /> -->

  <?php endif; ?>
  <br/>


  <?php echo $tab; ?>

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

  <!-- <h3>Est présent dans le sous bassin :</h3> -->
  <!-- <div class='indentRight1'> -->
   
   <!-- <?php //echo $have_ss_bassin; ?> -->
    
  <!-- </div> -->

  <h3>Islands present in this cluster:</h3>
  <div class='indentRight1'>
   
   <?php if($have_iles) echo $have_iles; else echo 'Aucune'; ?>
    
  </div>

<?php endif; ?>
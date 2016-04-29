<?php
require_once('PIM_ficheIle_commons.inc');


/* http://82.96.149.133/~PIM/drupal_PIM_tests/charts_graphstest/google2 */
/* google javascript API - iframe */
/* function charts_graphs_google2 */
/*--------------------------------------------------------
**  BDN Panorama des Inventaires
**--------------------------------------------------------*/
function pim_fi_charts_inventories_reports ($tid) {
  global $bdni_all_types;
  pim_fi_set_bdni_types();
  
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }

  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  $list_islands = $tid;
  $array_islands = pim_fi_get_archipel_islands($tid);
  if (isset($array_islands) and (!empty($array_islands))) {
    foreach($array_islands as $island_id) {
      $list_islands .= ", ".$island_id;
    }
  }
  
  $title1 = '';
  $speciesnb = get_speciesnb_percompartment($list_islands);
  $speciesOffset = 0;
  $speciesnb = get_Speciesnb_peryear_percompartment($list_islands, $speciesOffset);
  $inventoriesOffset = 0;
  $inventoriesnb = get_Inventorynb_peryear_percompartment($list_islands, $inventoriesOffset);
  
 
  
  /*-----------------------------------------*/
  $compartiment = t('Compartment');
  $year = t('Year');
  $bota = t('Botany');
  $chiro = t('Chiroptera');
  $entomo = t('Arthropoda');
  $mff = t('Marine Species');
  $herpeto = t('Herpetology');
  $mt = t('Terrestrial Mammals');
  $ornitho = t('Ornithology');
  
  $out =  "    <!--Load the AJAX API-->
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart3);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

      // Create the data table 1
      var data = new google.visualization.DataTable();
      //col 0
      data.addColumn('string', '$year');
      //col 1
      data.addColumn('number', '$mff');
      data.addColumn('number', '$bota');
      data.addColumn('number', '$entomo');
      data.addColumn('number', '$herpeto');
      data.addColumn('number', '$ornitho');
      data.addColumn('number', '$mt');
      data.addColumn('number', '$chiro');
      data.addRows([
        $speciesnb
      ]);
      
      var options = {'title':'',
                     'width':'100%',
                     'height':280,
                     'chartArea':{left:20,top:30,width:'75%',height:'75%'},
                     'colors': ['blue','green','orange','purple','#0099c6','#dd4477','red'],
                     'hAxis': {title: '', titleTextStyle: {color: 'black'},
                              textPosition: 'out', textStyle: {color: 'black'}
                              },
                      'legend': 'right'
                     };
      var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
      chart1.draw(data, options);
      
      // Create the data table 2
      var data2 = new google.visualization.DataTable();
      //col 0
      data2.addColumn('string', '$year');
      //col 1
      data2.addColumn('number', '$mff');
      data2.addColumn('number', '$bota');
      data2.addColumn('number', '$entomo');
      data2.addColumn('number', '$herpeto');
      data2.addColumn('number', '$ornitho');
      data2.addColumn('number', '$mt');
      data2.addColumn('number', '$chiro');
      data2.addRows([
        $inventoriesnb
      ]);
      
      var options = {'title':'',
                     'width':'90%',
                     'height':240,
                     'chartArea':{left:20,top:30,width:'75%',height:'75%'},
                     'colors': ['blue','green','orange','purple','#0099c6','#dd4477','red'],
                     'hAxis': {title: '', titleTextStyle: {color: 'black'},
                              textPosition: 'out', textStyle: {color: 'black'}
                              },
                      'legend': 'right'
                     };
      var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
      chart2.draw(data2, options);
    }
    </script>  ";


    $out .= pim_fi_set_pageheader($tid);
    $out .= "<div class='div-titre'>".t('Species number')." - ".t("Observed Species\t")."</div>";
    if ($speciesOffset > 0) {
      $out .= "<div style='padding-top: 5px; padding-left: 26px; font-size: 0.5em'>";
      $out .= t("Note: There are ").$speciesOffset.t(" more years with inventories that could not be displayed");
      $out .= "</div>";
    }
    $out.=  "<div id='chart_div1'></div>";
    
    $out .= "<div class='div-titre'>".t('Data number')." - ".t("Observed Species\t")."</div>";
    if ($inventoriesOffset > 0) {
      $out .= "<div style='padding-top: 5px; padding-left: 26px; font-size: 0.5em'>";
      $out .= t("Note: There are ").$inventoriesOffset.t(" more years with inventories that could not be displayed");
      $out .= "</div>";
    }
    $out.=  "<div id='chart_div2'></div>";
    
    //$out.=  "<div id='chart_div3'>".var_dump($ep_data)."</div>";
    $out .= pim_fi_set_pagefooter($tid);
    
  return $out;
}

function get_speciesnb_percompartment($list_islands) {

  global $bdni_all_types;
  pim_fi_set_bdni_types();
  //var_dump($bdni_all_types);
  
  $i = 0;  
  foreach($bdni_all_types as $bdni_name => $bdni_info) {
    $external_ref = $bdni_info['extRef'];
    $db_names_ep = pim_fi_node2bd($bdni_info['nodeTypes'][0], TRUE);
    
    if ($external_ref == FALSE) {
      $sql = "SELECT count(distinct t.tid) as nb
              FROM {%s} p
              inner join {term_data} t
              ON t.tid = p.%s
              WHERE p.%s in (%s)";
      $args = array($db_names_ep['node_table'],
                    $db_names_ep['node_taxon'],
                    $db_names_ep['ile_term_field'], $list_islands);
    } else {
      $sql = "SELECT count(distinct p.%s) as nb
              FROM {%s} p
              WHERE p.%s in (%s)";
      $args = array($db_names_ep['node_taxon'],
                    $db_names_ep['node_table'],
                    $db_names_ep['ile_term_field'], $list_islands);
    }
    $query = sprintf($sql, $args[0], $args[1], $args[2], $args[3]);
    //print $query;
    $result = db_query($sql, $args);   
    
    while ($record = db_fetch_array($result)) {
      //1 seul record
      $data2[$bdni_name][$i] = 
        array( 'nb' => $record['nb'], 'label' => $bdni_name);
    }
    $i++;
  }
  //return ' ';
  if (isset($data2) and !(empty($data2))) {
    foreach(array_keys($data2) as $compartiment) {
      $values = array(0,0,0,0,0,0,0);
      foreach(array_keys($data2[$compartiment]) as $column) {
        $values[$column] += $data2[$compartiment][$column]['nb'];
      }
      $ep_data .= '[\''.'Species number'.'\', '.$values[0].', '.$values[1].
                ', '.$values[2].', '.$values[3].', '.$values[4].
                ', '.$values[5].', '.$values[6].
                '],';
    }
  }
  return $ep_data;
}

function get_Speciesnb_peryear_percompartment($list_islands, &$offset_ep) {
  global $bdni_all_types;
  pim_fi_set_bdni_types();
  //var_dump($bdni_all_types);
  
  $i = 0;  
  foreach($bdni_all_types as $bdni_name => $bdni_info) {
    $external_ref = $bdni_info['extRef'];
    $db_names_ep = pim_fi_node2bd($bdni_info['nodeTypes'][0], TRUE);
    
    //if ($external_ref == FALSE) {
      $sql = "SELECT count(distinct %s) as nb, year(%s) as myyear
              FROM {%s} 
              WHERE %s in (%s)
              group by myyear";
      $args = array($db_names_ep['node_taxon'],
                    $db_names_ep['node_date'],
                    $db_names_ep['node_table'],
                    $db_names_ep['ile_term_field'], $list_islands);
    //} else {
    
    //}
    $query = sprintf($sql, $args[0], $args[1], $args[2], $args[3], $args[4]);
    //print $query;
    $result = db_query($sql, $args);   
    
    while ($record = db_fetch_array($result)) {
      //1 seul record
      $data2[$record['myyear']][$i] = 
        array( 'nb' => $record['nb'], 'label' => $bdni_name);
    }
    $i++;
  }
  //return ' ';
  if (isset($data2) and !(empty($data2))) {
    ksort($data2);
    $i = 0;
    $offset_ep = count($data2) - 19;
    foreach(array_keys($data2) as $year) {
      if (! is_numeric($year)) continue;
      if ($i < $offset_ep) {
        $i++;
        continue;
      }
      $values = array(0,0,0,0,0,0,0);
      foreach(array_keys($data2[$year]) as $column) {
        $values[$column] += $data2[$year][$column]['nb'];
      }
      $ep_data .= '[\''.$year.'\', '.$values[0].', '.$values[1].
                ', '.$values[2].', '.$values[3].', '.$values[4].
                ', '.$values[5].', '.$values[6].
                '],';
      $i++;
    }
  }
  return $ep_data;
}

function get_Inventorynb_peryear_percompartment($list_islands, &$offset_ep) {
  global $bdni_all_types;
  pim_fi_set_bdni_types();
  //var_dump($bdni_all_types);
  
  $i = 0;  
  foreach($bdni_all_types as $bdni_name => $bdni_info) {
    $db_names_ep = pim_fi_node2bd($bdni_info['nodeTypes'][0], TRUE);
    
    
    $sql = "SELECT count(*) as nb, year(%s) as myyear
            FROM {%s} 
            WHERE %s in (%s)
            group by myyear";
    $args = array($db_names_ep['node_date'],
                  $db_names_ep['node_table'],
                  $db_names_ep['ile_term_field'], $list_islands);
    
    $query = sprintf($sql, $args[0], $args[1], $args[2], $args[3]);
    //print $query;
    $result = db_query($sql, $args);   
    
    while ($record = db_fetch_array($result)) {
      //1 seul record
      $data2[$record['myyear']][$i] = 
        array( 'nb' => $record['nb'], 'label' => $bdni_name);
    }
    $i++;
  }
  //return ' ';
  if (isset($data2) and !(empty($data2))) {
    ksort($data2);
    $i = 0;
    $offset_ep = count($data2) - 19;
    foreach(array_keys($data2) as $year) {
      if (! is_numeric($year)) continue;
      if ($i < $offset_ep) {
        $i++;
        continue;
      }
      $values = array(0,0,0,0,0,0,0);
      foreach(array_keys($data2[$year]) as $column) {
        $values[$column] += $data2[$year][$column]['nb'];
      }
      $ep_data .= '[\''.$year.'\', '.$values[0].', '.$values[1].
                ', '.$values[2].', '.$values[3].', '.$values[4].
                ', '.$values[5].', '.$values[6].
                '],';
      $i++;
    }
  }
  return $ep_data;
}

/*-------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------
**  BDN Inventaire Report
**--------------------------------------------------------*/
function pim_fi_charts_bdn_ireports ($tid, $title, $array_node_type) {
  global $pim_fi_nodetype2url;
  pim_fi_set_nodetype2url();
  
  if (isset($_REQUEST['destination'])) {
    unset($_REQUEST['destination']);
  }
  if (! is_numeric($tid) ) {
    $array_tid = taxonomy_get_term_by_name($tid);
    $tid = $array_tid[0]->tid;
  }
  $list_islands = $tid;
  $array_islands = pim_fi_get_archipel_islands($tid);
  if (isset($array_islands) and (!empty($array_islands))) {
    foreach($array_islands as $island_id) {
      $list_islands .= ", ".$island_id;
    }
  }

  /* UICN monde présents */
  $db_names = pim_fi_node2bd($array_node_type[0], TRUE);
  $title1 = t("Observed Species\t");
  $sql = "select count(p.nid) as nb, t.name AS label, t.weight AS myweight
      from
        (SELECT tid, name, weight
          FROM drp_term_data 
          where vid = 10
          union select 0, 'unknown', 999
        ) t
      LEFT OUTER JOIN 
      {content_type_bd_t_fichetaxon} ft
        ON t.tid = ft.field_bd_t_uicn_monde_value
      left join
      {%s} p
        ON p.%s = ft.%s
        and p.%s in (%s)
      group by label, myweight
      order by myweight
    ";

  
  $result = db_query($sql, 
                    $db_names['node_table'], $db_names['node_taxon'], 
                    $db_names['fichetaxon_fieldtaxon'],
                    $db_names['ile_term_field'], $list_islands);
  while ($record = db_fetch_array($result)) {
    $data1 .= '[\''.$record['label'].'\', '.$record['nb'].'],';
  }
  
  /* UICN monde absent */
  $db_names = pim_fi_node2bd($array_node_type[1], TRUE);
  $title2 = t("Unfound Species ");

  $sql = "select count(p.nid) as nb, t.name AS label, t.weight AS myweight
          from
            (SELECT tid, name, weight
              FROM drp_term_data 
              where vid = 10
              union select 0, 'unknown', 999
            ) t
          LEFT OUTER JOIN 
          {content_type_bd_t_fichetaxon} ft
            ON t.tid = ft.field_bd_t_uicn_monde_value
          left join
            {%s} p
          ON p.%s = ft.%s
            and p.%s in (%s)
          group by label, myweight
          order by myweight
         ";
  $result = db_query($sql, 
                    $db_names['node_table'], $db_names['node_taxon'], 
                    $db_names['fichetaxon_fieldtaxon'],
                    $db_names['ile_term_field'], $list_islands);  
  while ($record = db_fetch_array($result)) {
    $data2 .= '[\''.$record['label'].'\', '.$record['nb'].'],';
  }
  
  /*----------------------*/
  /* UICN Medit présents */
  $db_names = pim_fi_node2bd($array_node_type[0], TRUE);
  $title3 = t("Observed Species\t");
    $sql = "select count(p.nid) as nb, t.name AS label, t.weight AS myweight
          from
            (SELECT tid, name, weight
              FROM drp_term_data 
              where vid = 10
              union select 0, 'unknown', 999
            ) t
          LEFT OUTER JOIN 
          {content_type_bd_t_fichetaxon} ft
            ON t.tid = ft.field_bd_t_uicn_medit_value
          left join
            {%s} p
          ON p.%s = ft.%s
            and p.%s in (%s)
          group by label, myweight
          order by myweight
         ";
  $result = db_query($sql, 
                    $db_names['node_table'], $db_names['node_taxon'], 
                    $db_names['fichetaxon_fieldtaxon'],
                    $db_names['ile_term_field'], $list_islands);  
  while ($record = db_fetch_array($result)) {
    $data3 .= '[\''.$record['label'].'\', '.$record['nb'].'],';
  }
  
  /* UICN Medit absent */
  $db_names = pim_fi_node2bd($array_node_type[1], TRUE);
  $title4 = t("Unfound Species ");
  $sql = "select count(p.nid) as nb, t.name AS label, t.weight AS myweight
          from
            (SELECT tid, name, weight
              FROM drp_term_data 
              where vid = 10
              union select 0, 'unknown', 999
            ) t
          LEFT OUTER JOIN 
          {content_type_bd_t_fichetaxon} ft
            ON t.tid = ft.field_bd_t_uicn_medit_value
          left join
            {%s} p
          ON p.%s = ft.%s
            and p.%s in (%s)
          group by label, myweight
          order by myweight
         ";
  $result = db_query($sql, 
                    $db_names['node_table'], $db_names['node_taxon'], 
                    $db_names['fichetaxon_fieldtaxon'],
                    $db_names['ile_term_field'], $list_islands);  
  while ($record = db_fetch_array($result)) {
    $data4 .= '[\''.$record['label'].'\', '.$record['nb'].'],';
  }
  
  /*----------------------*/
  /* Nombre d'inventaires */
  $db_names1 = pim_fi_node2bd($array_node_type[0], TRUE);
  $db_names2 = pim_fi_node2bd($array_node_type[1], TRUE);
  $sql = "SELECT SUM(T.nb_ep) as n_ep, SUM(T.nb_ea) as n_ea, T.myyear as y
          FROM
          (SELECT count(*) AS nb_ep, 0 as nb_ea, year(%s) as myyear
            FROM {%s}
            where %s in (%s)
            group by myyear
          union
          SELECT 0 as nb_ep, count(*) AS nb_ea, year(%s) as myyear
            FROM {%s}
            where %s in (%s)
            group by myyear
          ) T
        group by y
        order by y
        ";
/*
  print sprintf($sql, $db_names1['node_date'],
                     $db_names1['node_table'],
                     $db_names2['node_date'],
                     $db_names2['node_table']
                     );
  */
  $result = db_query($sql, $db_names1['node_date'],
                     $db_names1['node_table'],
                     $db_names1['ile_term_field'], $list_islands,
                     $db_names2['node_date'],
                     $db_names2['node_table'],
                     $db_names2['ile_term_field'], $list_islands
                     );
 
  while ($record = db_fetch_array($result)) {
    $data5 .= '[\''.$record['y'].'\', '.$record['n_ep'].', '.$record['n_ea'].'],';
  }
       
  $out = "    <!--Load the AJAX API-->
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart1);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart1() {

      // Create the data table 1 IUCN Monde EP
      var data1 = new google.visualization.DataTable();
      data1.addColumn('string', 'Topping');
      data1.addColumn('number', 'Slices');
      data1.addRows([
        $data1
      ]);
    //colors: EX noir, EW violet, CR rouge, EN orange, VU jaune, NT vert clair, LC vert foncé, DD gris1, NE gris2, unknown gris3
      var options = {'title':'$title1',
                     'width':250,
                     'height':180,
                     'chartArea':{left:20,top:30,width:'100%',height:'75%'},
           'colors': ['#000000', '#990099', '#D81E05', '#ff9900', '#F9E814', '#15d723', '#109618', '#C0C0C0', '#94948d', '#6b6b65']
           };
      var chart1 = new google.visualization.PieChart(document.getElementById('chart_div1'));
      chart1.draw(data1, options);
      
      // Create the data table 2
      var data2 = new google.visualization.DataTable();
      data2.addColumn('string', 'Topping');
      data2.addColumn('number', 'Slices');
      data2.addRows([
        $data2
      ]);
      //colors: EX noir, EW violet, CR rouge, EN orange, VU jaune, NT vert clair, LC vert foncé, DD gris1, NE gris2, unknown gris3
      var options = {'title':'$title2',
                     'width':250,
                     'height':180,
                     'chartArea':{left:20,top:30,width:'100%',height:'75%'},
           'colors': ['#000000', '#990099', '#D81E05', '#ff9900', '#F9E814', '#15d723', '#109618', '#C0C0C0', '#94948d', '#6b6b65']
           };
      var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
      chart2.draw(data2, options);
      
    }
    </script>  ";
    
    $out .= "<script type='text/javascript'>
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart2);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart2() {

      // Create the data table 3
      var data1 = new google.visualization.DataTable();
      data1.addColumn('string', 'Topping');
      data1.addColumn('number', 'Slices');
      data1.addRows([
        $data3
      ]);
      //colors: EX noir, EW violet, CR rouge, EN orange, VU jaune, NT vert clair, LC vert foncé, DD gris1, NE gris2, unknown gris3
      var options = {'title':'$title3',
                     'width':250,
                     'height':180,
                     'chartArea':{left:20,top:30,width:'100%',height:'75%'},
           'colors': ['#000000', '#990099', '#D81E05', '#ff9900', '#F9E814', '#15d723', '#109618', '#C0C0C0', '#94948d', '#6b6b65']
           };
      var chart1 = new google.visualization.PieChart(document.getElementById('chart_div3'));
      chart1.draw(data1, options);
      
      // Create the data table 4
      var data2 = new google.visualization.DataTable();
      data2.addColumn('string', 'Topping');
      data2.addColumn('number', 'Slices');
      data2.addRows([
        $data4
      ]);
      //colors: EX noir, EW violet, CR rouge, EN orange, VU jaune, NT vert clair, LC vert foncé, DD gris1, NE gris2, unknown gris3
      var options = {'title':'$title4',
                     'width':250,
                     'height':180,
                     'chartArea':{left:20,top:30,width:'100%',height:'75%'},
           'colors': ['#000000', '#990099', '#D81E05', '#ff9900', '#F9E814', '#15d723', '#109618', '#C0C0C0', '#94948d', '#6b6b65']
           };
      var chart2 = new google.visualization.PieChart(document.getElementById('chart_div4'));
      chart2.draw(data2, options);
      
    }
    </script>  ";
    
    $out .= "<script type='text/javascript'>
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart3);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart3() {

      // Create the data table 5
      var data1 = new google.visualization.DataTable();
      data1.addColumn('string', 'Year');
      data1.addColumn('number', '".$pim_fi_nodetype2url[$array_node_type[0]]['title']."');
      data1.addColumn('number', '".t('Unfound Species\t')."');
      data1.addRows([
        $data5
      ]);
      var options = {'title':'',
                     'width':'100%',
                     'height':240,
                     'chartArea':{left:20,top:30,right:0,width:'75%',height:'75%'},
                     'hAxis': {title: '', titleTextStyle: {color: 'black'},
                              textPosition: 'out', textStyle: {color: 'black'}
                              },
                      'legend': 'right'
                     };
      var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_div5'));
      chart1.draw(data1, options);
      
    }
    </script>  ";
    
    $out .= pim_fi_set_pageheader($tid);
    $out .= "<div class='table-titre'>".$title."</div>";
    $out .= "<table><tbody>";
    
    $out .= "<tr><td class='tr-titre'>UICN ".t('World')."</td></tr>";
    $out .= "<tr>";
    $out.=  "<td><div id='chart_div1'></div></td>";
    $out.=  "<td><div id='chart_div2'></div></td>";
    $out .= "</tr>";
    
    $out .= "<tr><td class='tr-titre'>UICN ".t('Mediterranean')."</td></tr>";
    $out .= "<tr>";
    $out.=  "<td><div id='chart_div3'></div></td>";
    $out.=  "<td><div id='chart_div4'></div></td>";
    $out .= "</tr>";
    $out .= "</tbody></table>";
  $out .= "<table><tbody>";
    $out .= "<tr class='tr-titre'>".t('Data number')."</tr>";
    $out .= "<tr>";
    $out.=  "<td class='td-full'><div id='chart_div5'></div></td>";
    $out .= "</tr>";
    
    $out .= "</tbody></table>";
    $out .= pim_fi_set_pagefooter($tid);
  return $out;
}

<?php

// TSA
function calculator_tsa($form, $form_state) {

	$form = array();

  if(isset($form_state['storage'])){
    $form['result'] = array(
      '#markup' => $form_state['storage']['result'],
    );
  }

  // Pizza Diameter (inches)
  $def_diameter = (isset($_POST['diameter'])) ? $_POST['diameter'] : null;
  $form['diameter'] = array(
    '#type' => 'textfield',
    '#title' => t('Pizza Diameter (inches)'),
    '#default_value' => $def_diameter,
    '#size' => 20,
    '#required' => TRUE,
    '#rules' => array(
      'numeric', 
    ),
  );

  // Number of TSA Ovens
  $def_number = (isset($_POST['number'])) ? $_POST['number'] : null;
  $form['number'] = array(
    '#type' => 'textfield',
    '#title' => t('Number of TSA Ovens'),
    '#default_value' => $def_number,
    '#size' => 20,
    '#required' => TRUE,
    '#rules' => array(
      'numeric', 
      'range[1,10]',
    ),
  );

  // Conveyor Speed (minutes)
  $def_speed = (isset($_POST['speed'])) ? $_POST['speed'] : null;
  $form['speed'] = array(
    '#type' => 'textfield',
    '#title' => t('Conveyor Speed (mm:ss)'),
    '#default_value' => $def_speed,
    '#size' => 20,
    '#required' => TRUE,
    '#description' => 'As low as 3 minutes, as high as 20 minutes!',
    '#rules' => array(
      //'regexp[/^([0-2]?[0-9]):([0-5]?[0-9])$/]',//'range[3,20]',
    ),
  );

  // Submit
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Calculate'),
  );
  
  return $form;
    
}

/**
 * Implements hook_submit().
 */
function calculator_tsa_submit($form, &$form_state){

  $diameter = $form_state['values']['diameter'];
  $number = $form_state['values']['number'];
  $a_speed = explode(':', $form_state['values']['speed']);
  $min = (int)$a_speed[0];
  $sec = (isset($a_speed[1])) ? (int)$a_speed[1]/60 : 0;
  $speed = $min+$sec;
  //$speed = $form_state['values']['speed'];

  // $length =IF(B15=1,32,IF(B15=2,64,(IF(B15=3,96,IF(B15=4,128,IF(B15=5,160,IF(B15=6,192,IF(B15=7,224,IF(B15=8,256,IF(B15=9,288,IF(B15=10,320,"###")))))))))))

  $length = 32*$number;
  
  $depth = 18;
  $tod = round(($speed/$length)*($length+$diameter),2); // ROUNDUP((B16/G14)*(G14+B14),2);
  $capacity = round(((($length+$diameter)*$depth)/($diameter*$diameter))*(60/$tod),2); // ROUNDUP((((G14+B14)*G15)/(B14^2))*(60/B23),2)

  $result = '<div class="messages status">';
  $result .= '<ul>';
  $result .= '<li>Bake Chamber Length (inches): '.$length.'</li>';
  $result .= '<li>Bake Chamber Depth (inches): '.$depth.'</li>';
  // $result .= '<li>Calculated TOD (minutes): '.$tod.' <i>minutes to bake one pizza</i></li>';
  $result .= '<li>Calculated Capacity/Hour: '.$capacity.' <i>pizzas fully baked in one hour</i></li>';
  $result .= '</ul>';
  $result .= '</div>';

  $form_state['storage']['result'] = $result;

  $form_state['rebuild'] = TRUE;

}



// TSB
function calculator_tsb($form, $form_state) {

  $form = array();

  if(isset($form_state['storage'])){
    $form['result'] = array(
      '#markup' => $form_state['storage']['result'],
    );
  }

  // Pizza Diameter (inches)
  $def_diameter = (isset($_POST['diameter'])) ? $_POST['diameter'] : null;
  $form['diameter'] = array(
    '#type' => 'textfield',
    '#title' => t('Pizza Diameter (inches)'),
    '#default_value' => $def_diameter,
    '#size' => 20,
    '#required' => TRUE,
    '#rules' => array(
      'numeric', 
    ),
  );

  // Number of TSB Ovens
  $def_number = (isset($_POST['number'])) ? $_POST['number'] : null;
  $form['number'] = array(
    '#type' => 'textfield',
    '#title' => t('Number of TSB Ovens'),
    '#default_value' => $def_number,
    '#size' => 20,
    '#required' => TRUE,
    '#rules' => array(
      'numeric', 
      'range[1,10]',
    ),
  );

  // Conveyor Speed (minutes)
  $def_speed = (isset($_POST['speed'])) ? $_POST['speed'] : null;
  $form['speed'] = array(
    '#type' => 'textfield',
    '#title' => t('Conveyor Speed (mm:ss)'),
    '#default_value' => $def_speed,
    '#size' => 20,
    '#required' => TRUE,
    '#description' => 'As low as 3 minutes, as high as 20 minutes!',
    '#rules' => array(
      //'regexp[/^([0-2]?[0-9]):([0-5]?[0-9])$/]',//'range[3,20]',
    ),
  );

  // Submit
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Calculate'),
  );
  
  return $form;
    
}

/**
 * Implements hook_submit().
 */
function calculator_tsb_submit($form, &$form_state){

  $diameter = $form_state['values']['diameter'];
  $number = $form_state['values']['number'];
  $a_speed = explode(':', $form_state['values']['speed']);
  $min = (int)$a_speed[0];
  $sec = (isset($a_speed[1])) ? (int)$a_speed[1]/60 : 0;
  $speed = $min+$sec;
  // $speed = $form_state['values']['speed'];

  $length = 45*$number; // =IF(B15=1,45,IF(B15=2,90,(IF(B15=3,135,IF(B15=4,180,IF(B15=5,225,IF(B15=6,270,IF(B15=7,315,IF(B15=8,360,IF(B15=9,405,IF(B15=10,450,"###")))))))))))

  $depth = 24; // 
  $tod = round(($speed/$length)*($length+$diameter),2); // ROUNDUP((B16/G14)*(G14+B14),2);
  $capacity = round(((($length+$diameter)*$depth)/($diameter*$diameter))*(60/$tod),2); // ROUNDUP((((G14+B14)*G15)/(B14^2))*(60/B23),2)

  $result = '<div class="messages status">';
  $result .= '<ul>';
  $result .= '<li>Bake Chamber Length (inches): '.$length.'</li>';
  $result .= '<li>Bake Chamber Depth (inches): '.$depth.'</li>';
  // $result .= '<li>Calculated TOD (minutes): '.$tod.' <i>minutes to bake one pizza</i></li>';
  $result .= '<li>Calculated Capacity/Hour: '.$capacity.' <i>pizzas fully baked in one hour</i></li>';
  $result .= '</ul>';
  $result .= '</div>';

  $form_state['storage']['result'] = $result;

  $form_state['rebuild'] = TRUE;

}
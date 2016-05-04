<?php

// Find a store
function find_store($form, $form_state) {

	$form = array();

  if(isset($form_state['storage'])){
    $form['result'] = array(
      '#markup' => $form_state['storage']['result'],
    );
  }

  $form['description'] = array(
    '#markup' => '<p>'.t('Enter a ZIP code or city and state').'</p>',
  );

  // ZIP code
  $zip_code = (isset($_POST['zip_code'])) ? $_POST['zip_code'] : null;
  $form['zip_code'] = array(
    '#type' => 'textfield',
    '#title' => t('ZIP code'),
    '#default_value' => $zip_code,
    '#size' => 20,
    // '#required' => TRUE,
    '#rules' => array(
      'numeric', 
    ),
  );

  $form['or'] = array(
    '#markup' => t('- OR -'),
  );

  // City
  $city = (isset($_POST['city'])) ? $_POST['city'] : null;
  $form['city'] = array(
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => $city,
    '#size' => 40,
    // '#required' => TRUE,
  );

  // State
  $states = array(
    '-1' => 'Select',
    'AL' => 'Alabama',
    'AK' => 'Alaska',
    'AZ' => 'Arizona',
    'AR' => 'Arkansas',
    'CA' => 'California',
    'CO' => 'Colorado',
    'CT' => 'Connecticut',
    'DE' => 'Delaware',
    'DC' => 'District Of Columbia',
    'FL' => 'Florida',
    'GA' => 'Georgia',
    'HI' => 'Hawaii',
    'ID' => 'Idaho',
    'IL' => 'Illinois',
    'IN' => 'Indiana',
    'IA' => 'Iowa',
    'KS' => 'Kansas',
    'KY' => 'Kentucky',
    'LA' => 'Louisiana',
    'ME' => 'Maine',
    'MD' => 'Maryland',
    'MA' => 'Massachusetts',
    'MI' => 'Michigan',
    'MN' => 'Minnesota',
    'MS' => 'Mississippi',
    'MO' => 'Missouri',
    'MT' => 'Montana',
    'NE' => 'Nebraska',
    'NV' => 'Nevada',
    'NH' => 'New Hampshire',
    'NJ' => 'New Jersey',
    'NM' => 'New Mexico',
    'NY' => 'New York',
    'NC' => 'North Carolina',
    'ND' => 'North Dakota',
    'OH' => 'Ohio',
    'OK' => 'Oklahoma',
    'OR' => 'Oregon',
    'PA' => 'Pennsylvania',
    'RI' => 'Rhode Island',
    'SC' => 'South Carolina',
    'SD' => 'South Dakota',
    'TN' => 'Tennessee',
    'TX' => 'Texas',
    'UT' => 'Utah',
    'VT' => 'Vermont',
    'VA' => 'Virginia',
    'WA' => 'Washington',
    'WV' => 'West Virginia',
    'WI' => 'Wisconsin',
    'WY' => 'Wyoming',
  );

  $state = (isset($_POST['state'])) ? $_POST['state'] : null;
  $form['state'] = array(
    '#type' => 'select',
    '#title' => t('States'),
    '#options' => $states,
    '#default_value' => $state,
    // '#required' => TRUE,
  );

  // Submit
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Find a store'),
  );

  // Use current location
  $form['submit_current'] = array(
    '#type' => 'submit',
    '#value' => t('Use my current location'),
  );

  return $form;
    
}

/**
 * Implements hook_validate().
 */
// function find_store_validate($node, $form, &$form_state) {}

/**
 * Implements hook_submit().
 */
function find_store_submit($form, &$form_state){

  $clicked_button = $form_state['clicked_button']['#value'];

  /**
   * Find a store
   */
  if($clicked_button == 'Find a store') {
    $address = '';
    $zip_code = $form_state['values']['zip_code'];
    $city = $form_state['values']['city'];
    $state = $form_state['values']['state'];

    // Geocode an address
    $address = $zip_code; // '4925 Gair Ave, Terrace, BC';
    
    if($zip_code) {
      $address = $zip_code;
    } 
    else {
      if($state !== '-1' && $city !== '') {
        $address = $city .','. $state;
      }
      if($state == '-1' && $city !== '') {
        $address = $city;
      }
      if($state != '-1' && $city == '') {
        $address = $state;
      }
    }

    // dsm($state);
    // dsm($address);

    $point = geocoder('google', $address);
    
    $geocoder_formatted_address = $point->data['geocoder_formatted_address'];
    $longitude = $point->coords[0];
    $latitude = $point->coords[1];
    
    $result = '<div class="messages status">';
    $result .= '<ul id="find-a-store">';
    $result .= '<li><i>'.$geocoder_formatted_address.'</i></li>';
    
    // node of content type 'our dealer'
    $stores = array();
    $nodes = node_load_multiple(array(), array('type' => 'our_dealer'));
    foreach($nodes as $node) {
      // dsm($node);
      $title = $node->title;
      $country = $node->field_address['und'][0]['country'];
      $administrative_area = $node->field_address['und'][0]['administrative_area'];
      $locality = $node->field_address['und'][0]['locality'];
      $thoroughfare = $node->field_address['und'][0]['thoroughfare'];
      $postal_code = $node->field_address['und'][0]['postal_code'];
      $lon = $node->field_geofield['und'][0]['lon'];
      $lat = $node->field_geofield['und'][0]['lat'];
      $distance_miles = distance($latitude, $longitude, $lat, $lon, "M");
      $distance_miles = round($distance_miles);
      
      $store = array(
        'title' => $title,
        'locality' => $locality,
        'thoroughfare' => $thoroughfare,
        'distance_miles' => $distance_miles,
        );
      $stores[$distance_miles] = $store;

    }
  }

  /**
   * Use my current location
   */
  if($clicked_button == 'Use my current location') {
    $ip_address = geoip_ip_address();
    $location = geoip_city($ip_address);

    $current_location = '';
    if(isset($location->city)) $current_location .= $location->city . ', ';
    if(isset($location->postal_code)) $current_location .= $location->postal_code . ', ';
    if(isset($location->region)) $current_location .= $location->region . ', ';
    if(isset($location->country_name)) $current_location .= $location->country_name; 

    $latitude = $location->latitude;
    $longitude = $location->longitude;

    $result = '<div class="messages status">';
    $result .= '<ul id="find-a-store">';
    $result .= '<li><i>'.$current_location.'</i></li>';
    
    // node of content type 'our dealer'
    $stores = array();
    $nodes = node_load_multiple(array(), array('type' => 'our_dealer'));
    foreach($nodes as $node) {
      // dsm($node);
      $title = $node->title;
      $country = $node->field_address['und'][0]['country'];
      $administrative_area = $node->field_address['und'][0]['administrative_area'];
      $locality = $node->field_address['und'][0]['locality'];
      $thoroughfare = $node->field_address['und'][0]['thoroughfare'];
      $postal_code = $node->field_address['und'][0]['postal_code'];
      $lon = $node->field_geofield['und'][0]['lon'];
      $lat = $node->field_geofield['und'][0]['lat'];
      $distance_miles = distance($latitude, $longitude, $lat, $lon, "M");
      $distance_miles = round($distance_miles);
      
      $store = array(
        'title' => $title,
        'locality' => $locality,
        'thoroughfare' => $thoroughfare,
        'distance_miles' => $distance_miles,
        );
      $stores[$distance_miles] = $store;

    }

  }

  $keys = array_keys($stores);
  $distance_nearest = min($keys);
  $nearest_store = $stores[$distance_nearest];

  $result .= '<li>';
  $result .= $nearest_store['title'].'<br/>';
  $result .= $nearest_store['locality'].', '.$nearest_store['thoroughfare'].'<br/>';
  $result .= $nearest_store['distance_miles'].' Miles<br/>';
  $result .= '</li>';

  $result .= '</ul>';
  $result .= '</div>';

  $form_state['storage']['result'] = $result;

  $form_state['rebuild'] = TRUE;

}

/**
 * Distance
 * 'M' is statute miles (default)
 * 'K' is kilometers
 * 'N' is nautical miles
 */
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);
  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
    return ($miles * 0.8684);
  } else {
    return $miles;
  }

}
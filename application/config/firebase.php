<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Inci_Firebase
*
* Version: 1.0
*
* Author: 
 * 
* Added Awesomeness: 
 * 
* Created:  2017
*
* Description:  
*
* Requirements: PHP5 or above
*
*/
/*
 | -------------------------------------------------------------------------
 | Authentication options.
 | -------------------------------------------------------------------------
 | 
 */
$config['FIREBASE_DATABASE_URL']      = "https://hide-an-snap.firebaseio.com/";       // Firebase Database Url
$config['FIREBASE_GET']               = "GET"; // Admin Email, admin@example.com
$config['FIREBASE_POST']              = 'POST';           // Add to a list of data in our Firebase database. Every time we send a POST request, the Firebase client generates a unique key, like messages/users/<unique-id>/<data>
$config['FIREBASE_PUT']               = 'PUT';             // Write or replace data to a defined path, like messages/users/user1/<data>
$config['FIREBASE_PATCH']             = 'PATCH';             // Update some of the keys for a defined path without replacing all of the data.
$config['FIREBASE_DELETE']            = "DELETE";                   // Remove data from the specified Firebase database reference.



/* End of file firebase.php */
/* Location: ./application/config/firebase.php */

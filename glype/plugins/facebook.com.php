<?php
/*****************************************************************
* Plugin: Facebook
* Coding by: BiiBuFlubb on 31/01/2011
******************************************************************/

/**
 * Sending to Facebook a User Agent that have Firefox on Win7 
 */
function preRequest() {

   global $toSet;
   $toSet[CURLOPT_USERAGENT] = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; de; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13';

} 
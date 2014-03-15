<?php
// CONFIG
$location = "http://location_of_this_script/";

//SET XML HEADER
header('Content-type: text/xml');

//CONSTRUCT RSS FEED HEADERS
//$output  = '<rss version="2.0">';
$output  = '<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:rawvoice="http://www.rawvoice.com/rawvoiceRssModule/" version="2.0">';
$output .= '<channel>';
$output .= '<title>Podcast dump</title>';
$output .= '<description>Podcast directory containing various files</description>';
$output .= '<link>'.$location.'</link>';
$output .= '<itunes:image href="' . $location . 'podcasts.jpg"/>';

if ($handle = opendir('./')) {
  while (false !== ($entry = readdir($handle))) {
    if ($entry == '.' or $entry == '..' or $entry == 'index.php' or $entry == 'podcasts.jpg') continue;
    $link    = $location.$entry;
    $size    = filesize("./".$entry);
    $pubdate = filemtime("./".$entry);
    $output .= '<item>';
    $output .= '<title>'.$entry.'</title>';
    $output .= '<description>'.$entry.'</description>';
    $output .= '<link>'.$link.'</link>';
    $output .= '<enclosure url="'.$link.'" length="'.$size.'" type="audio/mpeg"/>';
    $output .= '<pubDate>'.date("r", $pubdate).'</pubDate>';
    $output .= '</item> ';
  }
  closedir($handle);
}

//CLOSE RSS FEED
$output .= '</channel>';
$output .= '</rss>';

 //SEND COMPLETE RSS FEED TO BROWSER
 echo $output;
 ?>

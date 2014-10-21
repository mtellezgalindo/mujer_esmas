<div class="title">Fotogalerías</div>
<ul class="gallery">
<?
  //global $Ringo; 
  //include('ringo.config.php');
  include  PATH_GALLERIES.'xmlGalleries.php';
 // include ("../include_links.php"); 
  $object = $Ringo->factory('cms_gallery');
  //extract($Ringo->factory('conform')->getObjects(564));
  $parmas = array( 
  'terms' =>   isset($_REQUEST['terms']) ? urlencode(utf8_decode($_REQUEST['terms'])) : NULL,
  'order' => isset($_REQUEST['order']) ? $_REQUEST['order'] : '2',
  'pp' =>  isset($_REQUEST['npp']) ? $_REQUEST['npp'] : 8,
  'canal' =>  isset($_REQUEST['canal']) ? $_REQUEST['canal'] : 5,
  'canal_gallery' =>  isset($_REQUEST['canal']) ? $_REQUEST['canal'] : 5,
  'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : '0',
  'value' => isset($_REQUEST['value']) ? $_REQUEST['value'] : '',
  'guid' => isset($_REQUEST['guid']) ? $_REQUEST['guid'] : '',
  'nx' => isset($_REQUEST['nx']) ? $_REQUEST['nx'] : '',
  'mode' => isset($_REQUEST['mode']) ? $_REQUEST['mode'] : ''
  );
  $click 	= "parent.articlesForm.notesJS.CreateGalleryRelation";
  $wsdl   = "http://galerias.esmas.com/galleries/xmlGalleries.php";
  $string = getXMLGalleries($parmas);
	if($string != ''){
	 $xml= $object->getService($string); 
	 $total    = $object->getServiceTotal();
		foreach($xml as $K => $row){
			$id    	   = $row->id;
			$src   	   = $row->thumbnail;
			$preview   = $row->url;
			$date  	   = $row->release_date;
			$url  	   = $row->url;
			$id_canal  = $row->id_canal;
			$title 	   = preg_replace("/\r\n|\n|\r/","",addslashes(utf8_decode($row->title)));
			$title2	   = preg_replace("/\r\n|\n|\r/","",(utf8_decode($row->title)));
			$desc      = preg_replace("/\r\n|\n|\r/","",addslashes(utf8_decode($row->description)));
			$onclick   = "$click('$src','$id',{
			id:'$id',id_canal:'$id_canal',title:'$title',description:'$desc' ,url:'$url',release_date:'$date',thumbnail:'$src'
			});";
			$params1   = "{
			id_canal:'$id_canal',title:'$title',description:'$desc' ,url:'$url',release_date:'$date',thumbnail:'$src',id:$id
			}";
  			echo	"<li style='background-image:url($src)'><a rel='bookmark' href=\"http://m.esmas.com/iphone/mujer/fotos/m/$id\" alt='$title2' title='$title2' target='_blank'><img src='http://i2.esmas.com/canal30/img/spacer.gif' border='0' height='70' width='70' alt='$title2' title='$title2'></a></li>";				
			}?>
<div style="clear:both"></div>
</ul>
<?	} ?> 
//HOME
<div class="title">Fotogalerías</div>
<ul class="gallery noBottomed">
<?
  include  PATH_GALLERIES.'xmlGalleries.php';
  $object = $Ringo->factory('cms_gallery');
  $parmas = array( 
  'terms' =>   isset($_REQUEST['terms']) ? urlencode(utf8_decode($_REQUEST['terms'])) : NULL,
  'order' => isset($_REQUEST['order']) ? $_REQUEST['order'] : '2',
  'pp' =>  isset($_REQUEST['npp']) ? $_REQUEST['npp'] : 8,
  'canal' =>  isset($_REQUEST['canal']) ? $_REQUEST['canal'] : 2,
  'canal_gallery' =>  isset($_REQUEST['canal']) ? $_REQUEST['canal'] : 2,
  'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : '0',
  'value' => isset($_REQUEST['value']) ? $_REQUEST['value'] : '',
  'guid' => isset($_REQUEST['guid']) ? $_REQUEST['guid'] : '',
  'nx' => isset($_REQUEST['nx']) ? $_REQUEST['nx'] : '',
  'mode' => isset($_REQUEST['mode']) ? $_REQUEST['mode'] : ''
  );
  $click 	= "parent.articlesForm.notesJS.CreateGalleryRelation";
  $wsdl   = "http://galerias.esmas.com/galleries/xmlGalleries.php";
   
  $string = getXMLGalleries($parmas);
  echo "<pre>";print_r($parmas);echo "</pre>";
  echo ($string);
  
	if($string != ''){
	 $xml= $object->getService($string);
		echo "<pre>";print_r($xml);echo "</pre>";	 
	 $total    = $object->getServiceTotal();
		foreach($xml as $K => $row){
			echo "<b>".$row->url."</b><br>";
			$id    	   = $row->id;
			$src   	   = $row->thumbnail;
			$preview   = $row->url;
			$date  	   = $row->release_date;
			$url  	   = $row->url;
			$id_canal  = $row->id_canal;
			$title 	   = preg_replace("/\r\n|\n|\r/","",addslashes(utf8_decode($row->title)));
			$title2	   = preg_replace("/\r\n|\n|\r/","",(utf8_decode($row->title)));
			$desc      = preg_replace("/\r\n|\n|\r/","",addslashes(utf8_decode($row->description)));
			$find		  = 'http://televisa.esmas.com/entretenimiento/telenovelas/';
			$find2      = 'http://especiales.televisa.com/';
			
			$dominio1 = substr ($url, 0, 54);
			?><!-- Dominio 1: <?=$dominio1;?> --><?
			$dominio2 = substr ($url, 0, 31);
			?><!-- Dominio 2: <?=$dominio2;?> --><?
			if($dominio1 == $find){
				$url_mov  =str_replace($find, 'http://m.telenovelas.televisa.com/entretenimiento/telenovelas/', $url);
			}else if ($dominio2 == $find2){
				$url_mov  =str_replace($find2, 'http://m.especiales.televisa.com/', $url);
			}else{
				$url_mov  =str_replace('http://www2.esmas.com/', 'http://m.esmas.com/', $url);
			}
			
			$onclick   = "$click('$src','$id',{
			id:'$id',id_canal:'$id_canal',title:'$title',description:'$desc' ,url:'$url',release_date:'$date',thumbnail:'$src'
			});";
			$params1   = "{
			id_canal:'$id_canal',title:'$title',description:'$desc' ,url:'$url',release_date:'$date',thumbnail:'$src',id:$id
			}";
  			echo	"<li style='background-image:url($src)'><a rel='bookmark' href='$url_mov' alt='$title2' title='$title2' target='_blank'><img src='http://i2.esmas.com/canal30/img/spacer.gif' border='0' height='70' width='70' alt='$title2' title='$title2'></a></li>";				
			}?>
<div style="clear:both"></div>
</ul>
<?	} ?>
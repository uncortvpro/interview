<?
include_once('simple_html_dom.php');
class Tags{ 
	function main($link){
		$a=0;
		$img=0;
		$html = file_get_html($link);
		$date=date("d/m/y h:i:s"); 
		$info="$date\n";
		$info.="Теги href:\n";
		echo "<ul> <b>href:</b>";

		foreach($html->find('a') as $element){
				echo '<li>'.$element->href . '</li>';
				$info.="$element->href\n";
				$a++;
			}

		echo "</ul>";
		echo "<ul> <b>src:</b>";
		$info.="\nТеги src:\n";
		
		foreach($html->find('img') as $element){
				echo '<li>'.$element->src . '</li>';
				$info.="$element->src\n";
				$img++;
			}

		echo "</ul>";
		echo "Кол-во ссылок(&lta&gt): ".$a.'<br>';
		echo "Кол-во изображений(&ltimg&gt): ".$img.'<br>';

		$info.="\nКол-во ссылок(<a>):$a\nКол-во изображений(<img>):$img\n\n\n\n\n";
		$this->write($info);
		}
		function write($info){
			file_put_contents("tags.txt",$info, FILE_APPEND);
		}
}
$link1=new Tags();
$link1->main('photos.html');//в скобках вписуйте желаемую ссылку(по умолчанию локальный файл)
?>
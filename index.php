<?
include_once('simple_html_dom.php');
class Tags{ 
	private $link;
	private $info;
	public function __construct($link)
	{
		$this->link=$link;
		$this->main();
	}
	private function get_link(){
		return $this->link;
	}
	private function set_info($info){
		$this->info=$info;
	}
	private function get_info(){
		return $this->info;
	}
	private function main(){
		$link=$this->get_link();
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
		$this->set_info($info);
		$this->check();
		}
		private function write($info){
			$move=file_put_contents("tags.txt",$info, FILE_APPEND);
			if(!$move)
			{
				throw new Exception('Файл не обновлен');
			}	
		}
		private function check(){
			try{
				$this->write($this->get_info());
				echo "Файл успешно обновлен!";
			}
			catch(Exception $ex){
				echo $ex->getMessage();
			}
		}
}
$link1=new Tags('https://nostalgic-euclid-8ce2b2.netlify.app/');//в скобках вписуйте желаемую ссылку(по умолчанию локальный файл)
?>
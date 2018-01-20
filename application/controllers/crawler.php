<?php
class Crawler extends MY_Controller{
	function __construct(){
		parent::__construct();
		header('Content-Type: text/html; charset=utf-8');
		$this->load->helper(array('htmldom', 'curl' ));
	}
	
	public function index(){
		$msg = '';
		$response = '';
		$cmd = $this->input->get_post('c_check');
		if(!empty($cmd)){
			$c_namespace = $this->input->get_post('c_namespace');
			if(!empty($c_namespace)){
				$c_element = $this->input->get_post('c_element');
				if(!empty($c_element)){
					$c_url = $this->input->get_post('c_url');
					if(!empty($c_url)){
						$response = $this->crawler_run($c_url,$c_namespace,$c_element);
						
					}else{
						$msg = 'Vui lòng Nhập url cần lấy text';
					}
				}else{
					$msg = 'Vui lòng Nhập Tên Element (Class hoặc ID nội dung)';
				}
			}else{
				$msg = 'Vui lòng chọn Sử Dụng element ';
			}
		}
		$data = array(
			'title' => "Crawler Text",
			'msg' => $msg,
			'response' => $response,
		);
		$this->parser->parse('main',$data);
	}
	public function crawler_run($url,$namespace,$element){
		if(!empty($element)){
			$html = getCURL($url);
			$output=array();
			$string= str_get_html($html);
			if($namespace==1){
				$list = $string->find('#'.$element);
			}else{
				$list = $string->find('.'.$element);
			}
			$i=1;
			foreach ($list as $key => $val){
				return $this->regex_word_html($val->innertext);
			}
		}
	}
		
	private function regex_word_html($text, $allowed_tags = '<img>,<p>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<h7>,<u>,<b>,<ul>,<li>,<br>,<hr>')
	{
		//mb_regex_encoding('UTF-8');
		$search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
		//$replace = array('\'', '\'', '"', '"', '-');
		// $text = preg_replace($search, $replace, $text);
		if(mb_stripos($text, '/*') !== FALSE){
			$text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
		}
		$text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
		$text = strip_tags($text, $allowed_tags);
		$text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
		$search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
		//$replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
		//$text = preg_replace($search, $replace, $text);
		$num_matches = preg_match_all("/\<!--/u", $text, $matches);
		if($num_matches){
			$text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
		}
		$text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $text);
		$text = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $text);
		$text = preg_replace('/class=".*?"/', '', $text);
		$text = preg_replace('/align=".*?"/', '', $text);
		$text = preg_replace('/style=".*?"/', '', $text);

		$text = preg_replace('#<img (.+) style="(.+)" />#isU', '<img alt="title" data-natural-width="500" $1 style="width: 545px;">', $text);
		$pattern_alt = '/alt="([^"]*)"/';
		$alt = '';
		preg_match($pattern_alt, $text, $matches_alt);
		if(!isset($matches_alt[1])){	
			$alt = '';
		}else{
		
			$alt = $matches_alt[1];
		}
		$text2 = preg_replace('/(<img[^>]+>)/','<table align="center" border="0" cellpadding="3" cellspacing="0" class="tplCaption" style="width: 100%;"><tbody><tr><td>$1</td></tr><tr><td><p class="Image">'.$alt.'</p></td></tr></tbody></table>',$text);


		return $text2;
	}
	
	
}
?>
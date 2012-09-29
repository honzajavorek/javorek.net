<?php

final class TwitterControl extends AgregatorControl {

	private function parse($tweet) {
		$texy = new TemplateTexy();
		TexyConfigurator::safeMode($texy);
		return str_replace('<!-- by Texy2! -->', '', $texy->process(preg_replace(
			array(
				'#^[^:]+:#u',
				'#(?<!\\S)@([^\\W]+)#u',
				'#(?<!\\S)\\#([^\\W]+)#u',
			),
			array(
				'',
				'<a href="http://www.twitter.com/\\1">@\\1</a>',
				'<a href="http://search.twitter.com/search?q=%23\\1">#\\1</a>',
			),
			$tweet
		), TRUE));
	}
	
	public function render($limit = 5) {
		$this->template->setFile(dirname(__FILE__) . '/TwitterControl.phtml');
		$this->presenter->prepareTemplate($this->template);
		
		try {
			$feed = new RemoteFeed($this->uri);
			$feed->expiration = 60 * 2;
			$channel = $feed->data->channel;
			$items = array();
			
			for ($i = 0; $i < $limit && isset($channel->item[$i]); $i++) {
				$items[] = array(
					'date' => strtotime($channel->item[$i]->pubDate),
					'link' => $channel->item[$i]->guid,
					'status' => $this->parse($channel->item[$i]->title),
				);
			}
	        
			$this->template->sorry = FALSE;
	        $this->template->items = $items;
	        $this->template->render();
	        
		} catch (IOException $e) {
			$this->template->sorry = TRUE;
			$this->template->render();
		}
	}

}

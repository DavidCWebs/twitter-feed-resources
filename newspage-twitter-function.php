<?php
/* News Page Twitter */

function carawebs_newspage_twitter() {
	
	// The header
	?><h2 class="twitter_headline"><a href="http://twitter.com/EXP_Eng">@EXP_Eng</a></h2><?php
	
	if (wp_is_mobile()) { // Check to see if it is a mobile device
		
		// If so, display a single tweet in a div class "shortbox"
		
		?><div class="shortbox"><?php
			$client ='EXP_Eng';
			
			$tweets = getTweets($client, 1);
			//$tweets = getTweets(EXP_Eng, 1);
			
			if(is_array($tweets)){

					// to use with intents
					echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

					foreach($tweets as $tweet){

						if($tweet['text']){
							$the_tweet = $tweet['text'];
							
							if(is_array($tweet['entities']['user_mentions'])){
								foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
									
									$the_tweet = preg_replace(
										'/@'.$user_mention['screen_name'].'/i',
										'<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
										$the_tweet);
														
								}
							}

							// ii. Hashtags must link to a twitter.com search with the hashtag as the query.
							if(is_array($tweet['entities']['hashtags'])){
								foreach($tweet['entities']['hashtags'] as $key => $hashtag){
									$the_tweet = preg_replace(
										'/#'.$hashtag['text'].'/i',
										'<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
										$the_tweet);
								}
							}

							// iii. Links in Tweet text must be displayed using the display_url
							//      field in the URL entities API response, and link to the original t.co url field.
							if(is_array($tweet['entities']['urls'])){
								foreach($tweet['entities']['urls'] as $key => $link){
									$the_tweet = preg_replace(
										'`'.$link['url'].'`',
										'<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
										$the_tweet);
								}
							}
							
							// since RT disabled don't display EXP_Eng screen-name, since this is already in the title
							
							
								//echo '<a href="http://twitter.com/EXP_Eng" target="_blank">@EXP_Eng</a><br>' . $the_tweet;
								echo '<p>' . $the_tweet . '</p>';
							

							// 3. Tweet Actions
							//    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
							//    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
							// get the sprite or images from twitter's developers resource and update your stylesheet
							echo '
							<div class="twitter_intents">
								<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a> 
								<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a> 
								<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a>
							</div>';


							// 4. Tweet Timestamp
							//    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
							// 5. Tweet Permalink
							//    The Tweet timestamp must always be linked to the Tweet permalink.
							echo 
							
							/*'
							<p class="timestamp">
								<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
									'.date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours')).'
								</a>
							</p>';// -8 GMT for Pacific Standard Time*/
							
							'
							<p class="timestamp">
								<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
									'.date('G:i M dS',strtotime($tweet['created_at'])).'
								</a>
							</p>';// GMT
							
							} else {
							echo '
							<br /><br />
							<a href="http://twitter.com/EXP_Eng" target="_blank">Click here to read EXP_Eng\'S Twitter feed</a>';
							}
					}
				}
				
				?></div><?php
		
	}
	
	else {
	
	// Display three tweets in a div class "tallbox"
		
	?><div class="tallbox"><?php
	
	$client ='EXP_Eng';
	
	$tweets = getTweets($client, 3);
	//$tweets = getTweets(EXP_Eng, 3);
	
	if(is_array($tweets)){

			// to use with intents
			//echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

			foreach($tweets as $tweet){

				if($tweet['text']){
					$the_tweet = $tweet['text'];
					
					if(is_array($tweet['entities']['user_mentions'])){
						foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
							$the_tweet = preg_replace(
								'/@'.$user_mention['screen_name'].'/i',
								'<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
								$the_tweet);
						}
					}

					// ii. Hashtags must link to a twitter.com search with the hashtag as the query.
					if(is_array($tweet['entities']['hashtags'])){
						foreach($tweet['entities']['hashtags'] as $key => $hashtag){
							$the_tweet = preg_replace(
								'/#'.$hashtag['text'].'/i',
								'<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
								$the_tweet);
						}
					}

					// iii. Links in Tweet text must be displayed using the display_url
					//      field in the URL entities API response, and link to the original t.co url field.
					if(is_array($tweet['entities']['urls'])){
						foreach($tweet['entities']['urls'] as $key => $link){
							$the_tweet = preg_replace(
								'`'.$link['url'].'`',
								'<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
								$the_tweet);
						}
					}

					//echo '<a href="http://twitter.com/EXP_Eng" target="_blank">@EXP_Eng</a><br>' . $the_tweet;
					echo '<p>' . $the_tweet . '</p>';


					// 3. Tweet Actions
					//    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
					//    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
					// get the sprite or images from twitter's developers resource and update your stylesheet
					echo '
					<div class="twitter_intents">
						<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'">Reply</a> 
						<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'">Retweet</a> 
						<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'">Favorite</a>
					</div>';


					// 4. Tweet Timestamp
					//    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
					// 5. Tweet Permalink
					//    The Tweet timestamp must always be linked to the Tweet permalink.
					echo 
					
					/*'
					<p class="timestamp">
						<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
							'.date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours')).'
						</a>
					</p>';// -8 GMT for Pacific Standard Time*/
					
					'
					<p class="timestamp">
						<a href="https://twitter.com/EXP_Eng/status/'.$tweet['id_str'].'" target="_blank">
							'.date('G:i M dS',strtotime($tweet['created_at'])).'
						</a>
					</p>';// GMT
					
					} else {
					echo '
					<br /><br />
					<a href="http://twitter.com/EXP_Eng" target="_blank">Click here to read EXP_Eng\'S Twitter feed</a>';
					}
			}
		}
		
		?></div><?php
		
	}
	
}

add_action('hook_top_twitter_feed', 'carawebs_newspage_twitter');

/*====================================================================*/

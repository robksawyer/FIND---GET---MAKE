<div style="padding:15px 0 100px 0;background:#ececec;width:100%;margin:0 0 0 0;color:#000000;">
	<div style="width:516px;background:white;margin:15px auto;overflow:auto;font-family:'helvetica'">
		<div style="background:black;min-height:20px;width:100%;padding:0;margin:0 auto">&nbsp;</div>
		<div style="width:440px;margin:0 auto">
			<?php 
				if(!empty($user['User']['fullname'])){
					$user_name = $user['User']['fullname'];
				}else{
					$user_name = $user['User']['username'];
				}
			?>
			<h1 style="font-size:20px;margin:40px 0 20px 0;color:#000000;"><?php echo $this->Html->link($user_name,Router::url(array('ajax'=>false,'controller'=>'users','action'=>'profile',$user['User']['username']),true),array('style'=>'color:#ef3f23')); ?> followed you</h1>
			<?php
				echo $this->element('email-user-block',array('cache'=>false,'user'=>$user));
			?>
			<h3><?php echo $user_name; ?> is followed by <?php echo $followers_known['count']; ?> you know.</h3>
			<ul style="position: relative;font-size: 12px;left: 5px;color: #999;list-style-type: none;padding-left: 5px;">
			<?php
				/*
					TODO Loop through $followers_known and spit out their avatar images.
				*/
				foreach($followers_known['people'] as $followed_user){
					echo "<li>";
					echo $this->element('email-avatar',array('cache'=>false,'user'=>$followed_user,'height'=>32));
					echo "</li>";
				}
			?>
			</ul>
			<div style="width:100%;clear:both;"></div>
			<?php
			if($followers_known['count'] > 15){
				echo "<div style='position: relative;font-size: 12px;'>";
				echo $this->Html->link('See all followers',Router::url(array(
																								'ajax'=>false,
																								'plugin'=>'',
																								'controller'=>'user_followings',
																								'action'=>'followers',$followed_user['User']['username']
																								),true)
																						);
				echo "</div>";
			}
			?>
			<?php if(!empty($recent_products)): ?>
			<h3 style="color:#000000;"><?php echo $user_name; ?> recently added the following products:</h3>
			<div style="position: relative;text-align: center;margin: 10px 0 10px 0;">
			<?php
				/*
					Loop through $recent_products (max 3) and spit out their images and links.
				*/
				foreach($recent_products as $product){
					if(!empty($product['Attachment'][0]['path_small'])){
						$imageURL = Router::url($product['Attachment'][0]['path_small'],true);
						echo $this->Html->image($imageURL,
									array('url'=>Router::url(array('ajax'=>false,
																			'admin'=>false,
																			'controller'=>'products',
																			'action'=>'view',$product['Product']['id'])
																			,true),
											'style'=>'float:left;margin-right: 5px;height: 100px;max-width: 100px;border: none;'	
											)
								);
					}
				}
			?>
			</div>
			<?php endif; ?>
		</div>
		<div style="width:100%;clear:both;"></div>
		<div style="background:black;width:516px;margin:25px auto 25px;font-size:12px;text-align:center;overflow:auto;color:#ffffff;padding:15px 0px 15px 0px;">
			Sent from <?php echo $this->Html->link("FIND | GET | MAKE",'http://www.find-get-make.com',array('target'=>'_blank','style'=>'color:#ffffff')); ?> | <?php echo $this->Html->link("Edit Email Notifications",Router::url(array('ajax'=>false,'controller'=>'settings','action'=>'notifications'),true),array('target'=>'_blank','style'=>'color:#ffffff')); ?>
		</div>
		<div style="width:516px;background:white;margin:15px auto;overflow:auto;font-family:'helvetica'">
        <div style="width:440px;margin:0 auto"></div>
      </div>
	</div>
</div>
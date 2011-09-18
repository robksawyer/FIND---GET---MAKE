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
			<h1 style="font-size:20px;margin:40px 0 20px 0;color:#000000;"><?php echo $this->Html->link($user_name,Router::url(array('ajax'=>false,'controller'=>'users','action'=>'profile',$user['User']['username']),true),array('style'=>'color:#ef3f23')); ?> liked the product <?php echo $this->Html->link($item['Product']['name'],Router::url(array('ajax'=>false,'plugin'=>'','controller'=>'products','action'=>'view',$item['Product']['id']),true),array('style'=>'color:#ef3f23')); ?>.</h1>
			<div style="position:relative;text-align: center;">
			<?php
			//Show the image of the product
			if(!empty($item['Attachment'])):
			$imagePath = Router::url($item['Attachment'][0]['path_med'],true);
			echo $this->Html->image($imagePath,array('url'=>Router::url(array('ajax'=>false,'plugin'=>'','controller'=>'products','action'=>'view',$item['Product']['id']),true),
												'alt'=>$item['Product']['name']
												)
						);
			endif;
			?>
			</div>
			<div style="width:100%;clear:both;"></div>
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
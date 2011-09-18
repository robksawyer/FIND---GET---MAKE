<div style="padding:15px 0 100px 0;background:#ececec;width:100%;margin:0 0 0 0">
	<div style="width:516px;background:white;margin:15px auto;overflow:auto;font-family:'helvetica'">
		<div style="background:black;min-height:20px;width:100%;padding:0;margin:0 auto">&nbsp;</div>
		<div style="width:440px;margin:0 auto">
			<?php 
				if(!empty($user['User']['fullname'])){
					$user_name = $user['User']['fullname'];
				}else{
					$user_name = $user['User']['username'];
				}
				$ownership_type_nicename = "";
				switch($ownership_type){
					case "want":
						$ownership_type_nicename = "wants";
						break;
					
					case "has":
						$ownership_type_nicename = "has";
						break;
						
				}
			?>
			<h1 style="font-size:20px;margin:40px 0 20px 0"><?php echo $this->Html->link($user_name,Router::url(array('ajax'=>false,'controller'=>'users','action'=>'profile',$user['User']['username']),true)); ?> <?php echo $ownership_type_nicename; ?> the product <?php echo $this->Html->link($product['Product']['name'],Router::url(array('ajax'=>false,'plugin'=>'','controller'=>'products','action'=>'view',$product['Product']['id']),true)); ?>.</h1>
			<div style="position:relative;text-align: center;">
			<?php
			//Show the image of the product
			if(!empty($product['Attachment'])):
			$imagePath = Router::url($product['Attachment'][0]['path_med'],true);
			echo $this->Html->image($imagePath,array('url'=>array('ajax'=>false,'plugin'=>'','controller'=>'products','action'=>'view',$product['Product']['id']),
												'alt'=>$product['Product']['name']
												)
						);
			endif;
			?>
			</div>
			<div style="width:100%;clear:both;"></div>
			<?php if(!empty($recent_products)): ?>
			<h3><?php echo $user_name."'s"; ?> recently added the following products:</h3>
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
		<div style="width:516px;margin:25px auto 25px;background:transparent;font-size:12px;text-align:center;overflow:auto">
			Sent from <?php echo $this->Html->link("FIND | GET | MAKE",'http://www.find-get-make.com',array('target'=>'_blank')); ?> | <?php echo $this->Html->link("Edit Email Notifications",Router::url(array('ajax'=>false,'controller'=>'settings','action'=>'notifications'),true),array('target'=>'_blank')); ?>
		</div>
		<div style="width:516px;background:white;margin:15px auto;overflow:auto;font-family:'helvetica'">
        <div style="width:440px;margin:0 auto"></div>
      </div>
	</div>
</div>
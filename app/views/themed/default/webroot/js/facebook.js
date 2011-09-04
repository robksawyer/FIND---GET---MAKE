var Facebook={
	//fx:[]
};
Facebook.disconnect=function(options){
	refresh_page({
		url:'/_facebook/disconnect',
		onComplete:function(data){
			if(options.msg){
				console.log(options.msg+': '+data);
			}
			if(options.reload){
				reload_page();
			}
		}
	});
}

/*Facebook.togglePublish=function(checkbox){
	var add=null,type=null,value=checkbox.getProperty('checked');
	if(checkbox.id=='publish_like'){
		add=$('added_like');
		type='like';
	}else if(checkbox.id=='publish_upload'){
		add=$('added_upload');
		type='upload';
	}
	checkbox.disabled=true;
	add.setStyle('opacity',0.99);
	if(value){
		add.setStyle('color','#148c00');
		add.innerHTML='adding...';
	}else{
		add.setStyle('color','#f75342');
		add.innerHTML='removing...';
	}
	refresh_page({
		jdata:{type:type,value:value},
		url:'/_facebook/toggle_publish',
		onComplete:function(){
			checkbox.disabled=false;
			add.innerHTML='saved!';
			if(Facebook.fx[type]){
				Facebook.fx[type].stop();
			}
			Facebook.fx[type]=new Fx.Style(add,'opacity',{duration:3000}).start(0.99,0);
		}
	});
}*/

Facebook.login=function(){
	var session=FB.getSession();
	if(session!==null){
		refresh_page({jdata:{
			facebook_id:session.uid,
			access_token:session.access_token
		},url:'/signup',
		onComplete:function(data){
			if(data=='ok'){
				window.location='/';
			}}
		});
	}
	return false;
}
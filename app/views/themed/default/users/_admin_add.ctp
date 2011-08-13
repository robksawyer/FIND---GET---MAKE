<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('fullname');
		echo $this->Form->input('username');
		echo $form->input('email',array('label'=>'Your email address:','after'=>'Your email address will NOT be shared or visible on your profile.'));
		echo $this->Form->input('password');
		echo $this->Form->input('password_confirm',array('type'=>'password'));
		echo $this->Form->input('about');
		echo $this->Form->input('birthday',array('dateFormat'=>'MDY','timeFormat'=>'NONE','selected'=>strtotime('08-02-1984'),'minYear'=> date('Y') - 90,'maxYear' => date('Y')-10));
		echo $this->Form->input('url',array(
														'label'=>'Blog/Website URL',
														'after'=>'<span class="after">Make sure you add the protocol <i>i.e.</i>, http://.</span>'
														));
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('country_id',array('empty' => '-- Select a Country --'));
		echo $this->Form->input('slug',array('type'=>'hidden'));
		echo $this->Form->input('lastLogin',array('type'=>'hidden'));
		echo $this->Form->input('remember_me',array('type'=>'hidden','value'=>'0'));
		echo $this->Form->input('active',array('type'=>'hidden','value'=>'1'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Create', true));?>
</div>
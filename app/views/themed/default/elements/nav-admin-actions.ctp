<div id="admin-actions">
	<ul>
		<li>
			<?php
			echo $this->Html->link(__('ACL Management', true), '/admin/acl/')." | ";
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link('Add a bug','http://find-get-make.lighthouseapp.com',array('title'=>'Add a bug','target'=>'_blank'));
			?>
		</li>
		<li>
			<?php
			echo $this->Html->link('Flag Management','/admin/flags',array('title'=>'Manage the items that people have flagged.'))." | ";
			?>
		</li>
		<li>
			<?php 
			if ($this->Cupcake->user() && $this->Cupcake->hasAccess('admin')):
				echo $this->Html->link(__d('forum', 'Forum Admin', true), '/admin/forum/home')." | ";
			endif;
			?>
		</li>
	</ul>
</div>
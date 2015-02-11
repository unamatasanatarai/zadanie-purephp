<div class="col-md-12">
	<hr>
		<h1>Welcome</h1>
	<hr>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Statistics</h4></div>
		<div class="panel-body">
			<div class="list-group">
				<span class="list-group-item">Users: <span class="pull-right"><?php echo $user_count; ?></span></span>
				<span class="list-group-item">Permissions: <span class="pull-right"><?php echo $perm_count; ?></span></span>
			</div>
			<a href="<?php echo \Network\QueryRouter::url(array('c' => 'Users', 'a' => 'index')); ?>" class="btn btn-lg btn-primary">Manage users</a>
		</div>
	</div>
</div>

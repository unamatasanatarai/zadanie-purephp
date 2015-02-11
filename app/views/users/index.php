<div class="col-md-12">
	<hr>
		<h1>Users <a href="<?php echo \Network\QueryRouter::url(array('c' => 'Users', 'a' => 'add')); ?>" class="btn btn-xs btn-primary">Add user</a>
		</h1>
	<hr>
</div>

<?php echo $this->render('elements/notification'); ?>

<nav class="col-md-12">
	<ul class="pagination">
		<?php for ($i = 0; $i < $paginate['total']; $i++): ?>
			<li<?php if ($i == $paginate['current']){echo ' class="active"';} ?>><a href="<?php echo \Network\QueryRouter::url(array('page' => $i)); ?>"><?php echo $i+1; ?></a>
		<?php endfor; ?>
	</ul>
</nav>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>E-Mail</th>
						<th>Permissions</th>
						<th class="text-center" colspan=4>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo $user['id']; ?></td>
							<td><?php echo h($user['firstname']); ?> <?php echo h($user['lastname']); ?></td>
							<td><?php echo h($user['email']); ?></td>
							<td>
								<?php foreach($user['permissions'] as $permission):?>
									<?php echo $permission; ?><br>
								<?php endforeach; ?>
							</td>
							<td class="text-center"><a href="<?php echo \Network\QueryRouter::url(array('a' => 'edit', 'id' => $user['id'])); ?>" class="btn btn-xs btn-warning">Edit</a></td>
							<td class="text-center"><a href="<?php echo \Network\QueryRouter::url(array('a' => 'delete', 'id' => $user['id'])); ?>" class="btn btn-xs btn-danger" data-remote="delete">Delete</a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<nav class="col-md-12">
	<ul class="pagination">
		<?php for ($i = 0; $i < $paginate['total']; $i++): ?>
			<li<?php if ($i == $paginate['current']){echo ' class="active"';} ?>><a href="<?php echo \Network\QueryRouter::url(array('page' => $i)); ?>"><?php echo $i+1; ?></a>
		<?php endfor; ?>
	</ul>
</nav>
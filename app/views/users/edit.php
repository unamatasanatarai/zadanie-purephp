<div class="col-md-12">
	<hr>
		<h1>Users / Edit <small> <?php echo h($old_data['User']['firstname']); ?>  <?php echo h($old_data['User']['lastname']); ?></small></h1>
	<hr>
</div>
<?php echo $this->render('elements/notification'); ?>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">

		<form action="" method="post" class="form-horizontal">

		<div class="form-group<?php if (isset($errors['firstname'])){echo ' has-error';} ?>">
			<label for="firstname" class="col-md-2" class="control-label">Firstname</label>
			<div class="col-md-5">
				<input type="text" name="data[User][firstname]" id="firstname" class="form-control" value="<?php echo array_get($old_data['User'], 'firstname', ''); ?>">
			</div>
			<?php if (isset($errors['firstname'])): ?>
				<label for="firstname" class="control-label"><?php echo $errors['firstname']; ?></label>
			<?php endif; ?>
		</div>

		<div class="form-group<?php if (isset($errors['lastname'])){echo ' has-error';} ?>">
			<label for="lastname" class="col-md-2" class="control-label">Lastname</label>
			<div class="col-md-5">
				<input type="text" name="data[User][lastname]" id="lastname" class="form-control" value="<?php echo array_get($old_data['User'], 'lastname', ''); ?>">
			</div>
			<?php if (isset($errors['lastname'])): ?>
				<label for="lastname" class="control-label"><?php echo $errors['lastname']; ?></label>
			<?php endif; ?>
		</div>

		<div class="form-group<?php if (isset($errors['email'])){echo ' has-error';} ?>">
			<label for="email" class="col-md-2" class="control-label">E-Mail</label>
			<div class="col-md-5">
				<input type="text" name="data[User][email]" id="email" class="form-control" value="<?php echo array_get($old_data['User'], 'email', ''); ?>">
			</div>
			<?php if (isset($errors['email'])): ?>
				<label for="email" class="control-label"><?php echo $errors['email']; ?></label>
			<?php endif; ?>
		</div>

		<div class="form-group<?php if (isset($errors['password'])){echo ' has-error';} ?>">
			<label for="password" class="col-md-2" class="control-label">Password</label>
			<div class="col-md-5">
				<input type="password" name="data[User][password]" id="password" class="form-control">
			</div>
			<?php if (isset($errors['password'])): ?>
				<label for="password" class="control-label"><?php echo $errors['password']; ?></label>
			<?php endif; ?>
		</div>


		<div class="form-group">
			<label for="" class="col-md-2" class="control-label">Permissions</label>
			<div class="col-md-5">
				<ul>
					<?php foreach($permissions as $permission): ?>
						<li>
							<label>
								<input type="checkbox" name="data[Permission][<?php echo $permission['id']; ?>]" value="<?php echo $permission['id']; ?>"<?php if(isset($old_data['Permission'][$permission['id']])){echo ' checked';} ?>>
								<?php echo $permission['name']; ?>
							</label>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<input type="submit" value="save" class="btn btn-primary btn-md col-md-6">
			</div>
		</div>

		</form>
		</div>
	</div>
</div>
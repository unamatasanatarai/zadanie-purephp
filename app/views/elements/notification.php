<?php if (\Session\Notification::get()): ?>
	<div class="col-md-12">
		<?php echo \Session\Notification::fetch(); ?>
	</div>
<?php endif; ?>
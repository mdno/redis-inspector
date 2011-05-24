<code><?php echo "KEYS $curkey"?></code>

<?php if (!$keys) { ?>

	<div class="notice">No keys found in db <?php echo REDIS_DB ?>. Try selecting another database in config.php.</div>

<?php } else { ?>

	<ul>
	<?php
	foreach ($keys as $key) :
		
		if (!empty($key['type'])) {
			echo "<li><span class='key-type'>{$key['type']}</a> <a href='?a=key&key={$key['name']}' class='full-key'>{$key['name']}</a></li>";				} else { 
			echo "<li><a href='?prefix={$key['name']}' class='part-key'>{$key['name']}:*</a></li>";	
		}
		
	endforeach;
	?>
	</ul>
<?php } ?>

<small><?php echo number_format($total, 0, ',', '.')." keys in ".round($runtime,5)." seconds"?></small>
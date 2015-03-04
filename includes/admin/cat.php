<article>
	<div class="heading">Add/Delete Category</div>
	<div class="art_body" id="category_art">
	<?php
		$sql = mysql_query("SELECT * FROM category");
		echo "Total categories: ".mysql_num_rows($sql);
	?>
		<table border="0" width="100%">
			<tr>
				<td id="addcat">Add Category:<br>
					<form action="back/category.php" method="post">
						<input type="text" placeholder="Enter category" name="cat">
						<input type="submit" value="Add">
					</form>
				</td>
				<td id="deletecat">Delete Category:<br>
					<div id="show_cat">
					<?php
						while($qr = mysql_fetch_assoc($sql)){
							$id = $qr['id'];
							echo "<a href='back/category.php?id=$id'>".$qr['category']."</a><br>";
						}
					?>
					</div>
				</td>
			</tr>
		</table>
	</div>
</article>
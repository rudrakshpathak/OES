<article>
	<div class="heading">Create Exam Schedule</div>
	<div class="art_body" id="con_body">
		<form action="back/conductback.php" method="post">
			<table border="0" width="100%" id="conduct_table">
				<tr>
					<td width="150px">
						Select Category:</td><td><?php show_categories(); ?>
					</td>
				</tr>
				<tr>
					<td width="150px">
						Number of questions:</td><td><input type="number" min="10" max="300" name="no_of_questions" required>
					</td>
				</tr>
				<tr>
					<td>
						Questions difficulties:</td><td>
						<input type="radio" name="diff" id="diff1" value="1" class="radio_button" required>
						<label for="diff1">Easy</label>
						<input type="radio" name="diff" id="diff2" value="2" class="radio_button" required>
						<label for="diff2">Moderate</label>
						<input type="radio" name="diff" id="diff3" value="3" class="radio_button" required>
						<label for="diff3">Difficult</label>
						<input type="radio" name="diff" id="diff4" value="4" class="radio_button" required>
						<label for="diff4">Mixed</label>
					</td>
				</tr>
				<tr>
					<td>
						Exam date and time:</td><td><input type="date" name="date" required>
						<input type="time" name="time" required>
					</td>
				</tr>
				<tr>
					<td>Exam Total Time:</td>
					<td><input type="number" id="total_time_range" min="20" max="180" name="total_time" required> mins</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Set Exam" class="submit_button"><td>(questions will be selected randomly)</td>
					</td>
				</tr>
			</table>
		</form>
	</div>
</article>
<article id="insert_art">
	<div class="heading">Insert Question</div>
	<div class="art_body">
		<table border="0" weight="100%" height="100%" id="insert_table" class="section_table">
			<form action="back/insertback.php" method="post">
				<tr valign="top">
					<td>Question: </td>
					<td><textarea placeholder="Question" name="question" maxlength="1000" cols="100" rows="10" required></textarea></td>
				</tr>
				<tr>
					<td>Option 1: </td>
					<td><input type="text" placeholder="Option 1" name="option1" class="option_input" maxlength="200" required></td>
				</tr>
				<tr>
					<td>Option 2: </td>
					<td><input type="text" placeholder="Option 2" name="option2" class="option_input" maxlength="200" required></td>
				</tr>
				<tr>
					<td>Option 3: </td>
					<td><input type="text" placeholder="Option 3" name="option3" class="option_input" maxlength="200" required></td>
				</tr>
				<tr>
					<td>Option 4: </td>
					<td><input type="text" placeholder="Option 4" name="option4" class="option_input" maxlength="200" required></td>
				</tr>
				<tr>
					<td>Correct Option: </td>
					<td>
						<input type="radio" name="correct" id="cop1" value="1" class="radio_button" required><label for="cop1">Option 1</label>
						<input type="radio" name="correct" id="cop2" value="2" class="radio_button" required><label for="cop2">Option 2</label>
						<input type="radio" name="correct" id="cop3" value="3" class="radio_button" required><label for="cop3">Option 3</label>
						<input type="radio" name="correct" id="cop4" value="4" class="radio_button" required><label for="cop4">Option 4</label>
					</td>
				</tr>
				<tr>
					<td>Category: </td>
					<td><?php show_categories(); ?></td>
				</tr>
				<tr>
					<td>Difficult: </td>
					<td>
						<input type="radio" name="diff" id="diff1" value="1" class="radio_button" required><label for="diff1">Easy</label>
						<input type="radio" name="diff" id="diff2" value="2" class="radio_button" required><label for="diff2">Moderate</label>
						<input type="radio" name="diff" id="diff3" value="3" class="radio_button" required><label for="diff3">Difficult</label>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Insert"class="submit_button"></td>
				</tr>
			</form>
		</table>
	</div>
</article>
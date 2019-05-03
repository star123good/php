<?php
$b = protect($_GET['b']);

if($b == "add") {
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>FAQ</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Add question</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
			<?php
			if(isset($_POST['btn_add'])) {
				$question = protect($_POST['question']);
				$answer = addslashes($_POST['answer']);
				$check = $db->query("SELECT * FROM easyex_faq WHERE question='$question'");
				if(empty($question) or empty($answer)) { echo error("All fields are required."); }
				elseif($check->num_rows>0) { echo error("This question already exists."); }
				else {
					$time = time();
					$insert = $db->query("INSERT easyex_faq (question,answer,created) VALUES ('$question','$answer','$time')");
					echo success("Question <b>$question</b> was added successfully.");
				}	
			}
			?>
			
			<form action="" method="POST">
				<div class="form-group">
									<label>Question</label>
									<input type="text" class="form-control" name="question">
								</div>
								<div class="form-group">
									<label>Answer</label>
									<textarea class="cleditor" rows="15" name="answer"></textarea>
								</div>
				<button type="submit" class="btn btn-primary" name="btn_add"><i class="fa fa-plus"></i> Add</button>
			</form>		
		</div>
	</div>
	</div>
	<?php
} elseif($b == "edit") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_faq WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=faq"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>FAQ</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Edit question</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
			<?php
			if(isset($_POST['btn_save'])) {
				$question = protect($_POST['question']);
				$answer = addslashes($_POST['answer']);
				$check = $db->query("SELECT * FROM easyex_faq WHERE question='$question'");
				if(empty($question) or empty($answer)) { echo error("All fields are required."); }
				elseif($row['question'] !== $question && $check->num_rows>0) { echo error("This question already exists."); }
				else {
					$time = time();
					$update = $db->query("UPDATE easyex_faq SET question='$question',answer='$answer',updated='$time' WHERE id='$row[id]'");
					$query = $db->query("SELECT * FROM easyex_faq WHERE id='$id'");
					$row = $query->fetch_assoc();
					echo success("Your changes was saved successfully.");
				}	
			}
			?>
			
			<form action="" method="POST">
					<div class="form-group">
									<label>Question</label>
									<input type="text" class="form-control" name="question" value="<?php echo $row['question']; ?>">
								</div>
								<div class="form-group">
									<label>Answer</label>
									<textarea class="cleditor" rows="15" name="answer"><?php echo $row['answer']; ?></textarea>
								</div>
				<button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
			</form>
		</div>
	</div>
	</div>
	<?php
} elseif($b == "delete") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_faq WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=faq"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>FAQ</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Delete question</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
			<?php
			if(isset($_GET['confirm'])) {
				$delete = $db->query("DELETE FROM easyex_faq WHERE id='$row[id]'");
				echo success("Question <b>$row[question]</b> was deleted.");
			} else {
				echo info("Are you sure you want to delete question <b>$row[question]</b>?");
				echo '<a href="./?a=faq&b=delete&id='.$row[id].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=faq" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
			}
			?>
		</div>
	</div></div>
	<?php
} else {
?>
<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>FAQ</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li><a href="./?a=faq&b=add"><i class="fa fa-plus"></i> Add</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-3">

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="50%">Question</th>
					<th width="20%">Created on</th>
					<th width="20%">Updated on</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
				$limit = 20;
				$startpoint = ($page * $limit) - $limit;
				if($page == 1) {
					$i = 1;
				} else {
					$i = $page * $limit;
				}
				$statement = "easyex_faq";
				$query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
				if($query->num_rows>0) {
					while($row = $query->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $row['question']; ?></td>
							<td><?php if($row['created']) { echo '<span class="label label-default">'.date("d/m/Y H:i:s".$row[created]).'</span>'; } else { echo '-'; } ?></td>
							<td><?php if($row['updated']) { echo '<span class="label label-default">'.date("d/m/Y H:i:s".$row[updated]).'</span>'; } else { echo '-'; } ?></td>
							<td>
								<a href="./?a=faq&b=edit&id=<?php echo $row['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
								<a href="./?a=faq&b=delete&id=<?php echo $row['id']; ?>" title="Delete"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php
					}
				} else {
					echo '<tr><td colspan="4">Still no have faq.</td></tr>';
				}
				?>
			</tbody>
		</table>
		<?php
		$ver = "./?a=faq";
		if(admin_pagination($statement,$ver,$limit,$page)) {
			echo admin_pagination($statement,$ver,$limit,$page);
		}
		?>
	</div>
	</div>
</div>
<?php
}
?>
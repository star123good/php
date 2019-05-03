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
                        <h1>Pages</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Add page</li>
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
				$title = protect($_POST['title']);
				$prefix = protect($_POST['prefix']);
				$content = addslashes($_POST['content']);
				$check = $db->query("SELECT * FROM easyex_pages WHERE prefix='$prefix'");
				if(empty($title) or empty($prefix) or empty($content)) { echo error("All fields are required."); }
				elseif(!isValidUsername($prefix)) { echo error("Please enter valid prefix."); }
				elseif($check->num_rows>0) { echo error("This prefix is already used. Please choose another. "); }
				else {
					$page = $settings['url']."page/".$prefix;
					$link = '<a href="'.$page.'" target="_blank">'.$page.'</a>';
					$time = time();
					$insert = $db->query("INSERT easyex_pages (title,prefix,content,created) VALUES ('$title','$prefix','$content','$time')");
					echo success("Page was created successfully. Preview link: $link");
				}	
			}
			?>
			
			<form action="" method="POST">
				<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="title">
								</div>
								<div class="form-group">
									<label>Prefix</label>
									<div class="input-group">
									  <span class="input-group-addon"><?php echo $settings['url']; ?>page/</span>
									  <input type="text" class="form-control" name="prefix">
									</div>
									<small>Use latin characters and symbols - and _. Do not make spaces between words.</small>
								</div>
								<div class="form-group">
									<label>Content</label>
									<textarea class="cleditor" rows="15" name="content"></textarea>
								</div>
				<button type="submit" class="btn btn-primary" name="btn_add"><i class="fa fa-plus"></i> Add</button>
			</form>		
		</div>
	</div>
	</div>
	<?php
} elseif($b == "edit") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_pages WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=pages"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pages</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Edit page</li>
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
				$title = protect($_POST['title']);
				$prefix = protect($_POST['prefix']);
				$content = addslashes($_POST['content']);
				if($row['prefix'] == "terms-and-conditions" or $row['prefix'] == "about" or $row['prefix'] == "privacy-policy") { $prefix = $row['prefix']; }
				$check = $db->query("SELECT * FROM easyex_pages WHERE prefix='$prefix'");
				if(empty($title) or empty($prefix) or empty($content)) { echo error("All fields are required."); }
				elseif(!isValidUsername($prefix)) { echo error("Please enter valid prefix."); }
				elseif($row['prefix'] !== $prefix && $check->num_rows>0) { echo error("This prefix is already used. Please choose another. "); }
				else {
					$page = $settings['url']."page/".$prefix;
					$link = '<a href="'.$page.'" target="_blank">'.$page.'</a>';
					$time = time();
					$update = $db->query("UPDATE easyex_pages SET title='$title',prefix='$prefix',content='$content',updated='$time' WHERE id='$row[id]'");
					$query = $db->query("SELECT * FROM easyex_pages WHERE id='$id'");
					$row = $query->fetch_assoc();
					echo success("Page was updated successfully. Preview link: $link");
				}	
			}
			?>
			
			<form action="" method="POST">
					<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>">
								</div>
								<div class="form-group">
									<label>Prefix</label>
									<div class="input-group">
									  <span class="input-group-addon"><?php echo $settings['url']; ?>page/</span>
									  <input type="text" class="form-control" <?php if($row['prefix'] == "terms-and-conditions" or $row['prefix'] == "about" or $row['prefix'] == "privacy-policy") { echo 'disabled'; } ?> name="prefix" value="<?php echo $row['prefix']; ?>">
									</div>
									<small>Use latin characters and symbols - and _. Do not make spaces between words.</small>
								</div>
								<div class="form-group">
									<label>Content</label>
									<textarea class="cleditor" rows="15" name="content"><?php echo $row['content']; ?></textarea>
								</div>
				<button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
			</form>
		</div>
	</div>
	</div>
	<?php
} elseif($b == "delete") {
	$id = protect($_GET['id']);
	$query = $db->query("SELECT * FROM easyex_pages WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=pages"); }
	$row = $query->fetch_assoc();
	if($row['prefix'] == "terms-of-services" or $row['prefix'] == "about" or $row['prefix'] == "privacy-policy") {
		header("Location: ./?a=pages");
	}
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pages</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Delete page</li>
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
				$delete = $db->query("DELETE FROM easyex_pages WHERE id='$row[id]'");
				echo success("Page <b>$row[title]</b> was deleted.");
			} else {
				echo info("Are you sure you want to delete page <b>$row[title]</b>?");
				echo '<a href="./?a=pages&b=delete&id='.$row[id].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=pages" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
			}
			?>
		</div>
	</div>
	</div>
	<?php
} else {
?>
<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pages</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li><a href="./?a=pages&b=add"><i class="fa fa-plus"></i> Add</a></li>
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
					<th width="30%">Title</th>
					<th width="20%">Prefix</th>
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
				$statement = "easyex_pages";
				$query = $db->query("SELECT * FROM {$statement} ORDER BY id LIMIT {$startpoint} , {$limit}");
				if($query->num_rows>0) {
					while($row = $query->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $row['title']; ?></td>
							<td><?php echo $row['prefix']; ?></td>
							<td><?php if($row['created']) { echo '<span class="label label-default">'.date("d/m/Y H:i:s".$row[created]).'</span>'; } else { echo '-'; } ?></td>
							<td><?php if($row['updated']) { echo '<span class="label label-default">'.date("d/m/Y H:i:s".$row[updated]).'</span>'; } else { echo '-'; } ?></td>
							<td>
								<a href="./?a=pages&b=edit&id=<?php echo $row['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a> 
								<?php if($row['prefix'] == "terms-and-conditions" or $row['prefix'] == "about" or $row['prefix'] == "privacy-policy") { } else { ?>
								<a href="./?a=pages&b=delete&id=<?php echo $row['id']; ?>" title="Delete"><i class="fa fa-times"></i></a>
								<?php } ?>
							</td>
						</tr>
						<?php
					}
				} else {
					echo '<tr><td colspan="5">Still no have pages. <a href="./?a=pages&b=add">Click here</a> to add.</td></tr>';
				}
				?>
			</tbody>
		</table>
		<?php
		$ver = "./?a=rates";
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
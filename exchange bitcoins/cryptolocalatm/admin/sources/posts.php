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
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Add post</li>
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
				$author = protect($_POST['author']);
				$short_content = protect($_POST['short_content']);
				$content = addslashes($_POST['content']);
				$check = $db->query("SELECT * FROM easyex_pages WHERE title='$title'");
				if(empty($title) or empty($author) or empty($short_content) or empty($content)) { echo error("All fields are required."); }
				elseif($check->num_rows>0) { echo error("Already have post with title <b>$title</b>."); }
				else {
					$time = time();
					$insert = $db->query("INSERT easyex_posts (title,author,short_content,content,created,views) VALUES ('$title','$author','$short_content','$content','$time','0')");
					$query = $db->query("SELECT * FROM easyex_posts ORDER BY id DESC LIMIT 1");
					$row = $query->fetch_assoc();
					$page = $settings['url']."post/".$row['id']."/".CreatePostURL($row['title']);
					$link = '<a href="'.$page.'" target="_blank">'.$page.'</a>';
					echo success("Post was created successfully. Preview link: $link");
				}	
			}
			?>
			
			<form action="" method="POST">
				<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="title">
								</div>
								<div class="form-group">
									<label>Author</label>
									<input type="text" class="form-control" name="author">
								</div>
								<div class="form-group">
									<label>Short content</label>
									<textarea class="form-control" name="short_content" rows="2"></textarea>
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
	$query = $db->query("SELECT * FROM easyex_posts WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=posts"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Edit post</li>
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
				$author = protect($_POST['author']);
				$short_content = protect($_POST['short_content']);
				$content = addslashes($_POST['content']);
				if(empty($title) or empty($author) or empty($short_content) or empty($content)) { echo error("All fields are required."); }
				else {
					$page = $settings['url']."post/".$row['id']."/".CreatePostURL($row['title']);
					$link = '<a href="'.$page.'" target="_blank">'.$page.'</a>';
					$time = time();
					$update = $db->query("UPDATE easyex_posts SET title='$title',author='$author',short_content='$short_content',content='$content',updated='$time' WHERE id='$row[id]'");
					echo success("Post was updated successfully. Preview link: $link");
					$query = $db->query("SELECT * FROM easyex_posts WHERE id='$id'");
					$row = $query->fetch_assoc();
				}	
			}
			?>
			
			<form action="" method="POST">
					<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>">
								</div>
								<div class="form-group">
									<label>Author</label>
									<input type="text" class="form-control" name="author" value="<?php echo $row['author']; ?>">
								</div>
								<div class="form-group">
									<label>Short content</label>
									<textarea class="form-control" name="short_content" rows="2"><?php echo $row['short_content']; ?></textarea>
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
	$query = $db->query("SELECT * FROM easyex_posts WHERE id='$id'");
	if($query->num_rows==0) { header("Location: ./?a=posts"); }
	$row = $query->fetch_assoc();
	?>
	<br>
		<br>
		<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li>Delete post</li>
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
				$delete = $db->query("DELETE FROM easyex_posts WHERE id='$row[id]'");
				echo success("Post <b>$row[title]</b> was deleted.");
			} else {
				echo info("Are you sure you want to delete post <b>$row[title]</b>?");
				echo '<a href="./?a=posts&b=delete&id='.$row[id].'&confirm=1" class="btn btn-success"><i class="fa fa-check"></i> Yes</a>&nbsp;&nbsp;
					<a href="./?a=posts" class="btn btn-danger"><i class="fa fa-times"></i> No</a>';
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
                        <h1>Blog</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
							<li><a href="./?a=posts&b=add"><i class="fa fa-plus"></i> Add</a></li>
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
					<th width="20%">Author</th>
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
				$statement = "easyex_posts";
				$query = $db->query("SELECT * FROM {$statement} ORDER BY id LIMIT {$startpoint} , {$limit}");
				if($query->num_rows>0) {
					while($row = $query->fetch_assoc()) {
						?>
						<tr>
							<td><a href="<?php echo $settings['url']."post/".$row['id']."/".CreatePostURL($row['title']); ?>" target="_blank"><?php echo $row['title']; ?></a></td>
							<td><?php echo $row['author']; ?></td>
							<td><?php if($row['created']) { echo '<span class="label label-default">'.date("d/m/Y H:i:s".$row[created]).'</span>'; } else { echo '-'; } ?></td>
							<td><?php if($row['updated']) { echo '<span class="label label-default">'.date("d/m/Y H:i:s".$row[updated]).'</span>'; } else { echo '-'; } ?></td>
							<td>
								<a href="./?a=posts&b=edit&id=<?php echo $row['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a> 
								<a href="./?a=posts&b=delete&id=<?php echo $row['id']; ?>" title="Delete"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php
					}
				} else {
					echo '<tr><td colspan="5">Still no have posts. <a href="./?a=posts&b=add">Click here</a> to add.</td></tr>';
				}
				?>
			</tbody>
		</table>
		<?php
		$ver = "./?a=posts";
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
<!doctype html>
<html>
<head>
    <title>Export to Word</title>
    <style>
        .word-table {
            border:1px solid black !important; 
            border-collapse: collapse !important;
            width: 100%;
        }
        .word-table tr th, .word-table tr td{
            border:1px solid black !important; 
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <h2>Post List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
		<th>Created Date</th>
		<th>Title</th>
		<th>Description</th>
		<th>Image</th>
		<th>Status</th>
		<th>Tags</th>
		<th>Keyword</th>
		<th>Url</th>
		<th>Views</th>
		<th>Likes</th>
		<th>Id User</th>
		<th>Id Category</th>
		<th>Id Tag</th>
		
        </tr><?php
        foreach ($post_data as $post)
        {
            ?>
            <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $post->created_date ?></td>
		      <td><?php echo $post->title ?></td>
		      <td><?php echo $post->description ?></td>
		      <td><?php echo $post->image ?></td>
		      <td><?php echo $post->status ?></td>
		      <td><?php echo $post->tags ?></td>
		      <td><?php echo $post->keyword ?></td>
		      <td><?php echo $post->url ?></td>
		      <td><?php echo $post->views ?></td>
		      <td><?php echo $post->likes ?></td>
		      <td><?php echo $post->id_user ?></td>
		      <td><?php echo $post->id_category ?></td>
		      <td><?php echo $post->id_tag ?></td>	
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
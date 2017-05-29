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
    <h2>Category List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
		<th>Name</th>
		<th>Icon</th>
		<th>Image</th>
		<th>Url</th>
		<th>Status</th>
		
        </tr><?php
        foreach ($category_data as $category)
        {
            ?>
            <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $category->name ?></td>
		      <td><?php echo $category->icon ?></td>
		      <td><?php echo $category->image ?></td>
		      <td><?php echo $category->url ?></td>
		      <td><?php echo $category->status ?></td>	
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
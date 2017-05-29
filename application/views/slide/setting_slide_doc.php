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
    <h2>Setting_slide List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
		<th>Name</th>
		<th>Description</th>
		<th>Image</th>
		<th>Status</th>
		
        </tr><?php
        foreach ($slide_data as $slide)
        {
            ?>
            <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $slide->name ?></td>
		      <td><?php echo $slide->description ?></td>
		      <td><?php echo $slide->image ?></td>
		      <td><?php echo $slide->status ?></td>	
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
<div class="row m-1 p-3">
        
    <!-- Create todo section -->
    <div class="col-auto px-0 mx-0 mr-2">
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
</div>

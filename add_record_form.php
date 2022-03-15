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
    <form action="add_category.php" method="post"
          id="add_category_form">
        <label></label>
        <input type="input" name="name"><br/><br/>
        <input type="input" name="date">
        <input id="add_category_button" type="submit" value="Add">

    </form>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
</div>

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
        <input class="form-control form-control-lg border-0 add-todo-input bg-transparent rounded" type="text" placeholder="Add new event name">
        <input class="form-control form-control-lg border-0 add-todo-input bg-transparent rounded" type="text" placeholder="Add new event date">
        <button input id="add_category_button" type="submit" value="Add" type="button" class="btn btn-primary">Add</button>
        

    </form>
                   
                </div>
</div>

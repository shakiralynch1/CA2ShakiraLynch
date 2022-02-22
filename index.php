<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php
include('includes/header.php');
?>
<h1>Record List</h1>

<aside>
<!-- display a list of categories -->
<h2>Categories</h2>
<div class="calendar shadow bg-white p-5">
  <div class="d-flex align-items-center"><i class="fa fa-calendar fa-3x mr-3"></i>
    <h2 class="month font-weight-bold mb-0 text-uppercase">December 2019</h2>
  </div>
  <p class="font-italic text-muted mb-5">No events for this day.</p>
  <ol class="day-names list-unstyled">
    <li class="font-weight-bold text-uppercase">Sun</li>
    <li class="font-weight-bold text-uppercase">Mon</li>
    <li class="font-weight-bold text-uppercase">Tue</li>
    <li class="font-weight-bold text-uppercase">Wed</li>
    <li class="font-weight-bold text-uppercase">Thu</li>
    <li class="font-weight-bold text-uppercase">Fri</li>
    <li class="font-weight-bold text-uppercase">Sat</li>
  </ol>

  <ol class="days list-unstyled">
    <li>
      <div class="date">1</div>
      <div class="event bg-success">Event with Long Name</div>
    </li>
    <li>
      <div class="date">2</div>
    </li>
    <li>
      <div class="date">3</div>
    </li>
    <li>
      <div class="date">4</div>
    </li>
    <li>
      <div class="date">5</div>
    </li>
    <li>
      <div class="date">6</div>
    </li>
    <li>
      <div class="date">7</div>
    </li>
    <li>
      <div class="date">8</div>
    </li>
    <li>
      <div class="date">9</div>
    </li>
    <li>
      <div class="date">10</div>
    </li>
    <li>
      <div class="date">11</div>
    </li>
    <li>
      <div class="date">12</div>
    </li>
    <li>
      <div class="date">13</div>
      <div class="event all-day begin span-2 bg-warning">Event Name</div>
    </li>
    <li>
      <div class="date">14</div>
    </li>
    <li>
      <div class="date">15</div>
      <div class="event all-day end bg-success">Event Name</div>
    </li>
    <li>
      <div class="date">16</div>
    </li>
    <li>
      <div class="date">17</div>
    </li>
    <li>
      <div class="date">18</div>
    </li>
    <li>
      <div class="date">19</div>
    </li>
    <li>
      <div class="date">20</div>
    </li>
    <li>
      <div class="date">21</div>
      <div class="event bg-primary">Event Name</div>
      <div class="event bg-success">Event Name</div>
    </li>
    <li>
      <div class="date">22</div>
      <div class="event bg-info">Event with Longer Name</div>
    </li>
    <li>
      <div class="date">23</div>
    </li>
    <li>
      <div class="date">24</div>
    </li>
    <li>
      <div class="date">25</div>
    </li>
    <li>
      <div class="date">26</div>
    </li>
    <li>
      <div class="date">27</div>
    </li>
    <li>
      <div class="date">28</div>
    </li>
    <li>
      <div class="date">29</div>
    </li>
    <li>
      <div class="date">30</div>
    </li>
    <li>
      <div class="date">31</div>
    </li>
    <li class="outside">
      <div class="date">1</div>
    </li>
    <li class="outside">
      <div class="date">2</div>
    </li>
    <li class="outside">
      <div class="date">3</div>
    </li>
    <li class="outside">
      <div class="date">4</div>
    </li>
  </ol>
</div>
</div>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
<li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<section>
<!-- display a table of records -->
<h2><?php echo $category_name; ?></h2>
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td><img src="image_uploads/<?php echo $record['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $record['name']; ?></td>
<td class="right"><?php echo $record['price']; ?></td>
<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_record_form.php">Add Record</a></p>
<p><a href="category_list.php">Manage Categories</a></p>
</section>
<?php
include('includes/footer.php');
?>
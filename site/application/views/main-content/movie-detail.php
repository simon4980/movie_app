<nav class="row">
    <div class="col-xs-12">
        <ul class="nav nav-pills">
            <li class="active"><a href="/movie/addmovie">Add</a></li>
            <li><a href="/movie/<?php echo $objMovie->getUrl(); ?>/edit">Edit</a></li>
            <li><a href="/movie/<?php echo $objMovie->getUrl(); ?>/delete">Delete</a></li>
        </ul>
    </div>
</nav>
<div class="row">
    <div class="col-xs-12">
        <h1>
            <?php echo $objMovie->getDisplayValue('title'); ?>
        </h1>
    </div>
</div>
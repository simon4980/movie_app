<script>
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<nav class="row">
    <div class="col-xs-12">
        <ul class="nav nav-pills pull-right">
            <li><a href="/movie/addmovie">Add</a></li>
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
        <div id="rating">
            <?php for ($x = 0; $x < $rating; $x++) {  ?>
                <a type="button" data-movie_id="<?php echo $objMovie->getId(); ?>" class="<?php echo (($had_voted) ? 'disabled':''); ?>">
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                </a>
            <?php } ?>
            <?php for ($x = 0; $x <  5 - $rating; $x++) {  ?>
                <a type="button" data-movie_id="<?php echo $objMovie->getId(); ?>" class="<?php echo (($had_voted) ? 'disabled':''); ?>">
                    <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                </a>
            <?php } ?>
            (<span id="votes_count"><?php echo $num_votes; ?></span> votes)
        </div>
        <ul>
            <li><b>Type: </b><?php echo $objMovie->getDisplayValue('format'); ?></li>
            <li><b>Length: </b>
                <?php if ($objMovie->getLength() >= 60) { ?>
                <?php echo date('g', mktime(0,$objMovie->getDisplayValue('length'))); ?> hour(s)
                <?php } ?>
                <?php echo date('i ', mktime(0,$objMovie->getDisplayValue('length')));?> minute(s)
                (<?php echo $objMovie->getDisplayValue('length'); ?> minutes)</li>
            <li><b>Release Year: </b><?php echo $objMovie->getDisplayValue('releaseyear'); ?></li>

        </ul>
    </div>
</div>
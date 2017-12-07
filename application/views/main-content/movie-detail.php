<script>
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<nav class="row">
    <div class="col-xs-12">
        <ul class="nav nav-pills pull-right">
            <li><a href="/movie/<?php echo $objMovie->getUrl(); ?>/edit">Edit</a></li>
            <li><a href="#" data-toggle="modal" data-target="#modal-delete">Delete</a></li>
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

<!-- Modal -->
<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you wish to delete <?php echo $objMovie->getDisplayValue('title'); ?>.
                    It will be gone forever. Bye bye movie.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="/movie/<?php echo $objMovie->getUrl();?>/delete" type="button" class="btn btn-primary">Confirm Delete</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
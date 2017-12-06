<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h2>Movies</h2></div>
            <table class="table table-striped">
                <tr>
                <th>
                    Title
                    <?php if ($sortby == 'title' and $sortdir == 'asc') { ?>
                        <a href="/movies?sortby=title&sortdir=desc" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></a>
                    <?php } else { ?>
                        <a href="/movies?sortby=title&sortdir=asc" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></a>
                    <?php } ?>
                </th>
                <th>
                    Format
                    <?php if ($sortby == 'format' and $sortdir == 'asc') { ?>
                        <a href="/movies?sortby=format&sortdir=desc" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></a>
                    <?php } else { ?>
                        <a href="/movies?sortby=format&sortdir=asc" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></a>
                    <?php } ?>
                </th>
                <th>
                    Length
                    <?php if ($sortby == 'length' and $sortdir == 'asc') { ?>
                        <a href="/movies?sortby=length&sortdir=desc" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></a>
                    <?php } else { ?>
                        <a href="/movies?sortby=length&sortdir=asc" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></a>
                    <?php } ?>
                </th>
                <th>
                    Release Year
                    <?php if ($sortby == 'release_year' and $sortdir == 'asc') { ?>
                        <a href="/movies?sortby=release_year&sortdir=desc" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></a>
                    <?php } else { ?>
                        <a href="/movies?sortby=release_year&sortdir=asc" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></a>
                    <?php } ?>
                </th>
                </tr>
                <?php foreach ($movie_collection->getMovieCollection() as $objMovie) { ?>
                <tr>
                    <td><a href="/movie/<?php echo $objMovie->getUrl(); ?>"><?php echo $objMovie->getDisplayValue('title'); ?></a></td>
                    <td><?php echo $objMovie->getDisplayValue('format'); ?></td>
                    <td>
                        <?php echo date('g', mktime(0,$objMovie->getDisplayValue('length'))); ?> hour(s)
                        <?php echo date('i ', mktime(0,$objMovie->getDisplayValue('length')));?> minute(s)
                    </td>
                    <td><?php echo $objMovie->getDisplayValue('releaseyear'); ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
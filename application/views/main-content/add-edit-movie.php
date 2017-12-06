<div class="row">
    <div class="col-xs-12">
        <h1>
            <?php if ($objMovie->getId() > 0) { ?>
                Updating Movie: <?php echo $objMovie->getTitle(); ?>
            <?php } else { ?>
                Adding New Movie
            <?php } ?>
        </h1>
    </div>
</div>
<?php
if (validation_errors()) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo validation_errors(); ?>
        </div>
    </div>
    <?php
}
?>
<?php echo form_open(); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <label><span>Title:</span>
                <?php
                echo form_input(
                    'title',
                    $objMovie->getTitle(),
                    array(
                        'class' => 'form-control',
                        'maxlength' => '50',
                        'required' => 'required'
                    )
                );
                ?>
            </label>
        </div>
        <div class="col-xs-12 col-sm-6">
            <label><span>Format:</span>
                <?php
                echo form_dropdown(
                    'format',
                    array(
                        '' => '(select)',
                        "DVD" => "DVD",
                        'Streaming' => 'Streaming',
                        'VHS' => 'VHS'
                    ),
                    $objMovie->getFormat(),
                    array(
                        'required' => 'required',
                        'class' => 'form-control'
                    )
                );
                ?>
            </label>
        </div>
        <div class="col-xs-12 col-sm-6">
            <label><span>Length(minutes):</span>
                <?php
                echo form_input(
                    'length',
                    $objMovie->getLength(),
                    array(
                        'class' => 'form-control',
                        'maxlength' => '3',
                        'required' => 'required'
                    )
                );
                ?>
            </label>
        </div>
        <div class="col-xs-12 col-sm-6">
            <label><span>Release Year:</span>
                <?php
                echo form_input(
                    'release_year',
                    $objMovie->getReleaseYear(),
                    array(
                        'class' => 'form-control',
                        'maxlength' => '4',
                        'required' => 'required'
                    )
                );
                ?>
            </label>
        </div>
        <div class="col-xs-12 text-center btn-container">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/movie/<?php echo $objMovie->getUrl(); ?>" class="btn btn-default">Cancel</a>
        </div>
    </div>
    <?php
    $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );
    ?>
    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
</form>
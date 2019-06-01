<?php if( isset($detail['s_id']) && !empty($detail['s_id']) ) { ?>
<div>
    <h2 style="margin-top: 10px;"><?php _e('Youtube video', 'youtube') ; ?></h2>
    <iframe type="text/html" width="425" height="344" src="https://www.youtube.com/embed/<?php echo $detail['s_id']; ?>" frameborder="0"></iframe>
</div>
<?php } ?>
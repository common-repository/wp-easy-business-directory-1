<form method="post" action="options.php">
    <?php settings_fields( 'baw-wpeasybd-group' ); ?>
    <table class="form-table">
<!--    <tr valign="top">
        <th scope="row">Google Maps Status</th>
        <td><input type="text" name="googlemaps" value="<?php echo get_option('googlemaps'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Google API KEY</th>
        <td><input type="text" name="googlemapsapi" value="<?php echo get_option('googlemapsapi'); ?>" /></td>
        </tr>
-->        
        <tr valign="top">
        <th scope="row">Business Wordpress Permalink</th>
        <td><input type="text" name="buspage" value="<?php echo get_option('buspage'); ?>" /></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
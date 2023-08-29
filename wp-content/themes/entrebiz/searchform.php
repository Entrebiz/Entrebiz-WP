<?php
/**
 * Template for displaying search forms in Twenty Eleven
 *
 * @since 1.0
 */
?>
<form method="get" class="rodller-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <a href="javascript:void(0)" class="rodller-searchform-opener"><span class="ion-ios-search-strong"></span></a>
    <div class="rodller-search-input-wrapper">
        <input type="text" class="field" name="s" placeholder="<?php esc_attr_e( 'Search', 'rodller' ); ?>..." required/>
        <button type="submit" class="rodller-submit rodller-searchsubmit" name="submit"><span class="ion-ios-search-strong"></span></button>
    </div>
</form>
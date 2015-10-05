<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) );?>" >
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <label class="screen-reader-text" for="s"><?php echo __('Search for:', 'konnichi-an');?></label>
      <input type="text" class="mdl-textfield__input" value="<?php echo get_search_query();?>" name="s" id="s" />
      <label class="mdl-textfield__label" for="s"><?php echo __('Search for:', 'konnichi-an');?></label>
    </div>
    <input type="submit" id="searchsubmit" class="mdl-button mdl-js-button" value="<?php echo __('Search', 'konnichi-an');?>" />
  </form>

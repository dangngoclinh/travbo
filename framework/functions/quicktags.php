<?php
function travbo_mf_block_quicktag()
{
    if (wp_script_is('quicktags')) {
        ?>
        <script type="text/javascript">
            QTags.addButton('btn-mf-block-1', 'mf-block-1', block_1_func, '', 'b+1', 'add mf block', 30);
            QTags.addButton('btn-mf-block-2', 'mf-block-2', block_2_func, '', 'b+2', 'add mf block', 30);
            QTags.addButton('btn-mf-block-3', 'mf-block-3', block_3_func, '', 'b+3', 'add mf block', 30);
            QTags.addButton('btn-mf-block-5', 'mf-block-5', block_5_func, '', 'b+3', 'add mf block', 30);

            function block_1_func() {
                QTags.insertContent("[mf_block_1 type='recent' cat='' posts_number='5']");
            }

            function block_2_func() {
                QTags.insertContent("[mf_block_2 posts_number='5' column1='cat' column1_title='Column 1 Title' cat1='1,2' column2='cat' column2_title='Column 2 Title' cat2='3,4']");
            }

            function block_3_func() {
                QTags.insertContent("[mf_block_3 posts_number='5' type='cat' cat='1,2' title='Block 3']");
            }

            function block_5_func() {
                QTags.insertContent("[mf_block_5 posts_number='5' type='cat' cat='1,2' rand='false' readmore='true']");
            }
        </script>
        <?php
    }
}

add_action('admin_print_footer_scripts', 'travbo_mf_block_quicktag');

function travbo_mf_block_1_panel()
{
    ?>
    <div id="travbo_mf_block_1_panel" class="wp-core-ui has-text-field" style="display: none;" role="dialog"
         aria-labelledby="link-modal-title">
        <form id="wp-link" tabindex="-1">
            <input type="hidden" id="_ajax_linking_nonce" name="_ajax_linking_nonce" value="46de6a923f"/>

            <h1 id="link-modal-title">Insert/edit link</h1>
            <button type="button" id="wp-link-close"><span class="screen-reader-text">Close</span></button>
            <div id="link-selector">
                <div id="link-options">
                    <p class="howto" id="wplink-enter-url">Enter the destination URL</p>

                    <div>
                        <label><span>URL</span>
                            <input id="wp-link-url" type="text" aria-describedby="wplink-enter-url"/></label>
                    </div>
                    <div class="wp-link-text-field">
                        <label><span>Link Text</span>
                            <input id="wp-link-text" type="text"/></label>
                    </div>
                    <div class="link-target">
                        <label><span></span>
                            <input type="checkbox" id="wp-link-target"/> Open link in a new tab</label>
                    </div>
                </div>
                <p class="howto" id="wplink-link-existing-content">Or link to existing content</p>

                <div id="search-panel">
                    <div class="link-search-wrapper">
                        <label>
                            <span class="search-label">Search</span>
                            <input type="search" id="wp-link-search" class="link-search-field" autocomplete="off"
                                   aria-describedby="wplink-link-existing-content"/>
                            <span class="spinner"></span>
                        </label>
                    </div>
                    <div id="search-results" class="query-results" tabindex="0">
                        <ul></ul>
                        <div class="river-waiting">
                            <span class="spinner"></span>
                        </div>
                    </div>
                    <div id="most-recent-results" class="query-results" tabindex="0">
                        <div class="query-notice" id="query-notice-message">
                            <em class="query-notice-default">No search term specified. Showing recent items.</em>
                            <em class="query-notice-hint screen-reader-text">Search or use up and down arrow keys to
                                select an item.</em>
                        </div>
                        <ul></ul>
                        <div class="river-waiting">
                            <span class="spinner"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submitbox">
                <div id="wp-link-cancel">
                    <button type="button" class="button">Cancel</button>
                </div>
                <div id="wp-link-update">
                    <input type="submit" value="Add Link" class="button button-primary" id="wp-link-submit"
                           name="wp-link-submit">
                </div>
            </div>
        </form>
    </div>
    <?php
}

add_action('in_admin_footer', 'travbo_mf_block_1_panel', 100);
<?php
function move_admin_bar_to_footer() {
    // Early: Remove WP's default top margin
    if ( is_user_logged_in() && !is_admin() && is_admin_bar_showing() ) {
        // Remove the top bump earlier in the load process
        add_action('init', function() {
            remove_action('wp_head', '_admin_bar_bump_cb');
        });

        // Inject CSS at the right time
        add_action('wp_head', function() {
            echo '<style>
                #wpadminbar {
                    position: fixed !important;
                    bottom: 0;
                    top: auto !important;
                    width: 100% !important;
                    z-index: 9999;
                }
                    .at-bottom:not(.is-short-page) #wpadminbar {
                   transform:translatey(100%);
        }

                html {
                    margin-top: 0 !important;
                }
                body.admin-bar {
                }
            </style>';
        });
    }
}
add_action('after_setup_theme', 'move_admin_bar_to_footer');

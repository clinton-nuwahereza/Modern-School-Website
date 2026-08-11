<div class="theme-offer">
   <?php
        // Check if the demo import has been completed
        $business_school_demo_import_completed = get_option('business_school_demo_import_completed', false);

        // If the demo import is completed, display the "View Site" button
        if ($business_school_demo_import_completed) {
            echo '<br>';
            echo '<div class="success">Demo Import Successful</div>';
            echo '<br>';
            echo '<hr>';
            echo '<br>';
            echo '<span>' . esc_html__( 'You can now visit your site or customize it further.', 'business-school' ) . '</span>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<div class="view-site-btn">';
            echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
            echo '<a href="' . esc_url( admin_url('customize.php') ) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">Customize Demo Content</a>';
            echo '</div>';
        }
     // POST and update the customizer and other related data of Business School
    if ( isset( $_POST['submit'] ) ) {
        echo '<div class="plugin-notice">';
            // Check if Classic Blog Grid plugin is installed
            if (!is_plugin_active('classic-blog-grid/classic-blog-grid.php')) {
                // Plugin slug and file path for Classic Blog Grid
                $business_school_plugin_slug = 'classic-blog-grid';
                $business_school_plugin_file = 'classic-blog-grid/classic-blog-grid.php';
            
                // Check if Classic Blog Grid is installed and activated
                if ( ! is_plugin_active( $business_school_plugin_file ) ) {
            
                    // Check if Classic Blog Grid is installed
                    $business_school_installed_plugins = get_plugins();
                    if ( ! isset( $business_school_installed_plugins[ $business_school_plugin_file ] ) ) {
            
                        // Include necessary files to install plugins
                        include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
                        include_once( ABSPATH . 'wp-admin/includes/file.php' );
                        include_once( ABSPATH . 'wp-admin/includes/misc.php' );
                        include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
            
                        // Download and install Classic Blog Grid
                        $business_school_upgrader = new Plugin_Upgrader();
                        $business_school_upgrader->install( 'https://downloads.wordpress.org/plugin/classic-blog-grid.latest-stable.zip' );
                    }
            
                    // Activate the Classic Blog Grid plugin after installation (if needed)
                    activate_plugin( $business_school_plugin_file );
                }
            }
        echo '</div>';
        // ------- Create Main Menu --------
        $business_school_menuname = 'Primary Menu';
        $business_school_bpmenulocation = 'primary';
        $business_school_menu_exists = wp_get_nav_menu_object( $business_school_menuname );
    
        if (!$business_school_menu_exists) {
            // Create a new menu
            $business_school_menu_id = wp_create_nav_menu($business_school_menuname);

            // Define pages to be created
            $business_school_pages = array(
                'home' => array(
                    'title' => 'Home',
                    'template' => '/templates/template-home-page.php'
                ),
                'about-us' => array(
                    'title' => 'About Us',
                    'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
                ),
                'pages' => array(
                    'title' => 'Pages',
                    'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
                ),
                'blogs' => array(
                    'title' => 'Blogs',
                    'content' => ''
                ),
            );

            $business_school_page_ids = array();

            // Loop through the pages and create them if they don’t exist
            foreach ($business_school_pages as $business_school_slug => $business_school_data) {
                $business_school_existing_page = get_page_by_path($business_school_slug);

                if ($business_school_existing_page) {
                    // If the page already exists, use its ID
                    $business_school_page_id = $business_school_existing_page->ID;
                } else {
                    // Create a new page
                    $business_school_page_data = array(
                        'post_type'    => 'page',
                        'post_title'   => $business_school_data['title'],
                        'post_content' => isset($business_school_data['content']) ? $business_school_data['content'] : '',
                        'post_status'  => 'publish',
                        'post_author'  => get_current_user_id(), // Set author dynamically
                        'post_name'    => $business_school_slug,
                    );

                    $business_school_page_id = wp_insert_post($business_school_page_data);

                    // Assign custom page template if specified
                    if (!empty($business_school_data['template'])) {
                        update_post_meta($business_school_page_id, '_wp_page_template', $business_school_data['template']);
                    }
                }

                // Store the page IDs
                $business_school_page_ids[$business_school_slug] = $business_school_page_id;
            }

            // Set homepage and blog page
            update_option('page_for_posts', $business_school_page_ids['blogs']);
            update_option('page_on_front', $business_school_page_ids['home']);
            update_option('show_on_front', 'page');

            // Define menu items
            $business_school_menu_items = array(
                'home',
                'about-us',
                'pages',
                'blogs',
            );

            // Add menu items dynamically
            foreach ($business_school_menu_items as $business_school_slug) {
                wp_update_nav_menu_item($business_school_menu_id, 0, array(
                    'menu-item-title' => esc_html($business_school_pages[$business_school_slug]['title']),
                    'menu-item-url' => get_permalink($business_school_page_ids[$business_school_slug]),
                    'menu-item-status' => 'publish',
                    'menu-item-object-id' => $business_school_page_ids[$business_school_slug],
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type',
                ));
            }

            // Assign menu to theme location
            $business_school_locations = get_theme_mod('nav_menu_locations', array());
            $business_school_locations[$business_school_bpmenulocation] = $business_school_menu_id;
            set_theme_mod('nav_menu_locations', $business_school_locations);
        }

        //Logo
        set_theme_mod( 'business_school_the_custom_logo', esc_url( get_template_directory_uri().'/images/Logo.png'));

        //Header Section
        set_theme_mod( 'business_school_top_bar', true);
        set_theme_mod( 'business_school_phone_number', '+123 456 7890');
        set_theme_mod( 'business_school_email_address', 'business@example.com');
        set_theme_mod( 'business_school_contact_us_text', 'Contact Us');

        //Social Media Section
        set_theme_mod( 'business_school_fb_link', 'https://www.facebook.com');
        set_theme_mod( 'business_school_insta_link', 'https://www.instagram.com');
        set_theme_mod( 'business_school_googleplus_link', 'https://www.googleplus.com');
        set_theme_mod( 'business_school_youtube_link', 'https://www.youtube.com');

        //Slider Section
        set_theme_mod( 'business_school_slider', true);
        set_theme_mod( 'business_school_slider_top_text', 'LEARN FROM TODAY');
        set_theme_mod( 'business_school_button_text', 'Get Started');
        
        $business_school_slider_category_id = wp_create_category('Slider');

        // Set the category in theme mods for the slider section
        set_theme_mod('business_school_slider_cat', 'Slider'); // Update with correct category ID
        
        // Titles for the three posts
        $business_school_titles = array(
            'Education Creates a Better Future',
            'Empowering Students Every Day',
            'Modern Learning with Classic Values'
        );                
        // Create three demo posts and assign them to the 'Slider' category
        for ($business_school_i = 1; $business_school_i <= 3; $business_school_i++) {
            $business_school_title = $business_school_titles[$business_school_i - 1];
            $business_school_content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
        
            // Prepare the post object
            $business_school_my_post = array(
                'post_title'    => wp_strip_all_tags($business_school_title),
                'post_content'  => $business_school_content,
                'post_status'   => 'publish',
                'post_type'     => 'post',
                'post_category' => array($business_school_slider_category_id),
            );
        
            // Insert the post into the database
            $business_school_post_id = wp_insert_post($business_school_my_post);
        
            // If the post was successfully created, set the featured image
            if ($business_school_post_id && !is_wp_error($business_school_post_id)) {
                // Set the image URL based on the current slider index
                $business_school_image_url = esc_url(get_stylesheet_directory_uri() . '/images/slider' . $business_school_i . '.png');
                $business_school_upload_dir = wp_upload_dir();
        
                // Download the image data using wp_remote_get()
                $business_school_response = wp_remote_get($business_school_image_url);
                if (!is_wp_error($business_school_response)) {
                    $business_school_image_data = wp_remote_retrieve_body($business_school_response);
        
                    if (!empty($business_school_image_data)) {
                        // Handle the file upload process
                        $business_school_image_name = 'slider' . $business_school_i . '.png';
                        $business_school_unique_file_name = wp_unique_filename($business_school_upload_dir['path'], $business_school_image_name);
                        $business_school_file = $business_school_upload_dir['path'] . '/' . $business_school_unique_file_name;
        
                        // Save the image file to the uploads directory
                        global $wp_filesystem;
                        WP_Filesystem();
                        $wp_filesystem->put_contents($business_school_file, $business_school_image_data);
        
                        // Check file type and prepare for attachment
                        $business_school_wp_filetype = wp_check_filetype($business_school_unique_file_name, null);
                        $business_school_attachment = array(
                            'post_mime_type' => $business_school_wp_filetype['type'],
                            'post_title'     => sanitize_file_name($business_school_unique_file_name),
                            'post_content'   => '',
                            'post_status'    => 'inherit',
                        );
        
                        // Insert the image into the media library and set it as the post's featured image
                        $business_school_attach_id = wp_insert_attachment($business_school_attachment, $business_school_file, $business_school_post_id);
                        $business_school_attach_data = wp_generate_attachment_metadata($business_school_attach_id, $business_school_file);
                        wp_update_attachment_metadata($business_school_attach_id, $business_school_attach_data);
                        set_post_thumbnail($business_school_post_id, $business_school_attach_id);
                    }
                }
            }
        }

        //About Section
        set_theme_mod( 'business_school_disabled_pgboxes', true);
        set_theme_mod( 'business_school_about_title', 'About Our University');
        set_theme_mod( 'business_school_abt_image_first', esc_url( get_template_directory_uri().'/images/about1.png'));
        set_theme_mod( 'business_school_abt_image_second', esc_url( get_template_directory_uri().'/images/about2.png'));
        $business_school_about_texts = array(
            1 => 'Dramatically re-engineer value added systems via mission',
            2 => 'Access more then 100K online courses',
            3 => 'Learn the high-impact skills that top companies want'
        );
    
        for ($business_school_i = 1; $business_school_i <= 3; $business_school_i++) {
            set_theme_mod('business_school_about_sentence' . $business_school_i, $business_school_about_texts[$business_school_i]);
        }
        
        // Function to fetch or create a page using WP_Query
        function get_or_create_page_by_title( $business_school_page_title, $business_school_page_content = '' ) {
            $business_school_args = array(
                'post_type'      => 'page',
                'title'          => $business_school_page_title,
                'post_status'    => 'publish',
                'posts_per_page' => 1,
                'fields'         => 'ids'
            );
            $business_school_query = new WP_Query( $business_school_args );

            if ( ! empty( $business_school_query->posts ) ) {
                return $business_school_query->posts[0];
            } else {
                // Create the page if it doesn't exist
                $business_school_page_id = wp_insert_post( array(
                    'post_type'    => 'page',
                    'post_title'   => $business_school_page_title,
                    'post_content' => $business_school_page_content,
                    'post_status'  => 'publish',
                    'post_author'  => 1
                ));
                return $business_school_page_id;
            }
        }

        // Create Page
        $business_school_page_title = 'Welcome to Business School.';
        $business_school_page_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.';
        $business_school_page_id = get_or_create_page_by_title( $business_school_page_title, $business_school_page_content );

        if ( $business_school_page_id ) {
            set_theme_mod( 'business_school_about_pageboxes', $business_school_page_id );
        } else {
            error_log('Failed to create or fetch the "Welcome to Corporate Business Theme" page.');
        }

        $business_school_image_url = get_template_directory_uri().'/images/about.png';
        $business_school_image_id = media_sideload_image($business_school_image_url, $business_school_page_id, null, 'id');
        if (!is_wp_error($business_school_image_id)) {
            // Set the downloaded image as the post's featured image
            set_post_thumbnail($business_school_page_id, $business_school_image_id);
        }       

        // Show success message and the "View Site" button
        update_option('business_school_demo_import_completed', true);
        echo '<br>';
        echo '<div class="success">Demo Import Successful</div>';
        echo '<br>';
        echo '<hr>';
        echo '<br>';
        echo '<span>' . esc_html__( 'You can now visit your site or customize it further.', 'business-school' ) . '</span>';
        echo '<br>';
    }
     ?>
    <ul>
        <li>
        <?php 
        // Check if the form is submitted
        if ( !isset( $_POST['submit'] ) ) : ?>
            <!-- Show demo importer form only if it's not submitted -->
            <?php if (!get_option('business_school_demo_import_completed')) : ?>
                <span><?php echo esc_html( 'Click on the below content to get demo content installed.', 'business-school' ); ?></span>
                <br><br>
                <hr><br>
                <b class="note"><?php echo esc_html('Note :', 'business-school' ); ?></b><br><br>
                <small><b><?php echo esc_html('Please take a backup if your website is already live with data. This importer will overwrite existing data.', 'business-school' ); ?></b></small><br><br>
                <form id="demo-importer-form" action="" method="POST" onsubmit="return runDemoImport();">
                    <input type="submit" name="submit" value="<?php echo esc_attr('Run Importer','business-school'); ?>" class="button button-primary button-large">
                </form>
                <script type="text/javascript">
                    function runDemoImport() {
                        if (confirm('Do you really want to do this?')) {
                            document.getElementById('demo-import-loader').style.display = 'block';
                            return true;
                        }
                        return false;
                    }
                </script>
             <?php endif; ?>
         <?php 
        endif; 

        // Show "View Site" button after form submission
        if ( isset( $_POST['submit'] ) ) {
        echo '<div class="view-site-btn">';
        echo '<a href="' . esc_url(home_url()) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">View Site</a>';
        echo '<a href="' . esc_url( admin_url('customize.php') ) . '" class="button button-primary button-large" style="margin-top: 10px;" target="_blank">Customize Demo Content</a>';
        echo '</div>';
        }
        ?>
        </li>
    </ul>
 </div>
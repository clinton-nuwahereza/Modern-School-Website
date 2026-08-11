<?php
/**
 * Retrieving the values:
 * Show Page Banner = get_post_meta( get_the_ID(), 'author_personal_blog_show-page-banner', true )
 * Content Layout = get_post_meta( get_the_ID(), 'author_personal_blog_content-layout', true )
 * Sidebar Settings = get_post_meta( get_the_ID(), 'author_personal_blog_sidebar-settings', true )
 */
class Author_Personal_Blog_Meta_Box {
	private $config = '{
	    "title": "Author Personal Blog Settings",
	    "prefix": "author_personal_blog_",
	    "domain": "author-personal-blog",
	    "class_name": "Author_Personal_Blog_Meta_Box",
	    "post-type": ["post", "page"],
	    "context": "side",
	    "priority": "default",
	    "fields": [
	        {
	            "type": "select",
	            "label": "Show Page Banner",
	            "default": "customizer",
	            "options": "customizer : Customizer\r\nshow : Show\r\nhide : Hide",
	            "id": "author_personal_blog_show-page-banner"
	        },
	        {
	            "type": "select",
	            "label": "Content Layout",
	            "default": "default",
	            "options": "default : Default Layout\r\nstretched : Full Width Stretched",
	            "id": "author_personal_blog_content-layout"
	        },
	        {
	            "type": "select",
	            "label": "Sidebar Settings",
	            "default": "no",
	            "options": "customizer : Customizer\r\nright : Right Sidebar\r\nleft : Left Sidebar\r\nno : No Sidebar",
	            "id": "author_personal_blog_sidebar-settings"
	        }
	    ]
	}';

	public function __construct() {
		$this->config = json_decode( $this->config, true );
		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
		add_action( 'save_post', [ $this, 'save_post' ] );
	}

	public function add_meta_boxes() {
		foreach ( $this->config['post-type'] as $screen ) {
			add_meta_box(
				sanitize_title( $this->config['title'] ),
				$this->config['title'],
				[ $this, 'add_meta_box_callback' ],
				$screen,
				$this->config['context'],
				$this->config['priority']
			);
		}
	}

	public function save_post( $post_id ) {
		foreach ( $this->config['fields'] as $field ) {
			switch ( $field['type'] ) {
				default:
					if ( isset( $_POST[ $field['id'] ] ) ) {
						$sanitized = sanitize_text_field( $_POST[ $field['id'] ] );
						update_post_meta( $post_id, $field['id'], $sanitized );
					}
			}
		}
	}

	public function add_meta_box_callback() {
		$this->fields_div();
	}

	public function fields_div() {
        global $post;
        $post_type = $post->post_type;

        foreach ( $this->config['fields'] as $field ) {
            // Check if post type is 'page', if so, show all fields
            // Otherwise, show only sidebar settings
            if ( $post_type === 'page' || $field['id'] === 'author_personal_blog_sidebar-settings' ) {
                ?><div class="components-base-control">
                    <div class="components-base-control__field"><?php
                        $this->label( $field );
                        $this->field( $field );
                    ?></div>
                </div><?php
            }
        }
    }

	private function label( $field ) {
		switch ( $field['type'] ) {
			default:
				printf(
					'<label class="components-base-control__label" for="%s">%s</label>',
					$field['id'], $field['label']
				);
		}
	}

	private function field( $field ) {
		switch ( $field['type'] ) {
			case 'select':
				$this->select( $field );
				break;
			default:
				$this->input( $field );
		}
	}

	private function input( $field ) {
		printf(
			'<input class="components-text-control__input %s" id="%s" name="%s" %s type="%s" value="%s">',
			isset( $field['class'] ) ? $field['class'] : '',
			$field['id'], $field['id'],
			isset( $field['pattern'] ) ? "pattern='{$field['pattern']}'" : '',
			$field['type'],
			$this->value( $field )
		);
	}

	private function select( $field ) {
		printf(
			'<select id="%s" name="%s">%s</select>',
			$field['id'], $field['id'],
			$this->select_options( $field )
		);
	}

	private function select_selected( $field, $current ) {
		$value = $this->value( $field );
		if ( $value === $current ) {
			return 'selected';
		}
		return '';
	}

	private function select_options( $field ) {
		$output = [];
		$options = explode( "\r\n", $field['options'] );
		$i = 0;
		foreach ( $options as $option ) {
			$pair = explode( ':', $option );
			$pair = array_map( 'trim', $pair );
			$output[] = sprintf(
				'<option %s value="%s"> %s</option>',
				$this->select_selected( $field, $pair[0] ),
				$pair[0], $pair[1]
			);
			$i++;
		}
		return implode( '<br>', $output );
	}

	private function value( $field ) {
		global $post;
		if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
			$value = get_post_meta( $post->ID, $field['id'], true );
		} else if ( isset( $field['default'] ) ) {
			$value = $field['default'];
		} else {
			return '';
		}
		return str_replace( '\u0027', "'", $value );
	}

}
new Author_Personal_Blog_Meta_Box;
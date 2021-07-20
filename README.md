# wp-cmls-base
 Wordpress base theme for CMLS

## Custom action hooks

### Archives
cmls_template-archive-before_content
: Before archive post list

cmls_template-archive-after_content
: After archive post list

cmls_template-archive-before_posts
: Before individual posts in an archive

cmls_template-archive-after_posts
: After individual posts in an archive

### Singular
cmls_template-singular-before_post
: Before post content

cmls_template-singular-after_post
: After post content

## Overriding templates
This theme uses custom versions of Wordpress's own `get_template_part()` ( `cmls_get_template_part()` ) and `locate_template()` ( `cmls_locate_template()` ) for all template includes. The paths which will be searched for template files may be filtered using `cmls-locate_template_path` to alter/add paths.

```
\add_filter( 'cmls-locate_template_path', function($paths) {
	$paths[] = 'new/path/to/search';
	return $paths;
} );
```

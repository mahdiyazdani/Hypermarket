# Blurry Product Images

## Image types & sizes

* **Catalog Images:** Medium sized image used in a product loops (e.g., shop page, product category pages, related products, up-sells, cross-sells, etc.) - ```Default: 500 x 455 (px)```
* **Single Product Image:** The largest image on the individual product details page. ```Default: 954 x 782 (px)```
* **Product Thumbnails:** The smallest image, a thumbnail, commonly used underneath the Single Product Image, the cart, and widgets. ```Default: 160 x 131 (px)```

## Overwriting theme's image sizes

```php
// Single product image
function hypermarket_child_single_image_dimensions($single) {
	return array(
		'width' => '954', // px
		'height' => '782', // px
		'crop' => 1 // true
	);
}
add_filter('hypermarket_single_image_dimensions', 'hypermarket_child_single_image_dimensions', 10, 1);

// Catalog product image(s)
function hypermarket_child_catalog_image_dimensions($catalog) {
	return array(
		'width' => '954', // px
		'height' => '782', // px
		'crop' => 1 // true
	);
}
add_filter('hypermarket_single_image_dimensions', 'hypermarket_child_catalog_image_dimensions', 10, 1);

// Thumbnail product image(s)
function hypermarket_child_thumbnail_image_dimensions($thumbnail) {
	return array(
		'width' => '954', // px
		'height' => '782', // px
		'crop' => 1 // true
	);
}
add_filter('hypermarket_single_image_dimensions', 'hypermarket_child_thumbnail_image_dimensions', 10, 1);
```

?> Note that saving changes does **NOT** automatically update all previously uploaded product imagery. To update old images, WordPress needs to [regenerate the thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails). This is to ensure that all affected images are resized to match the new dimensions.

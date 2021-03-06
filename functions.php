<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add desktop menu walker */
require_once( 'library/menu-walker.php' );

/** Add off-canvas menu walker */
require_once( 'library/offcanvas-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Add protocol relative theme assets */
require_once( 'library/protocol-relative-theme-assets.php' );

/** Enqueue Posttypes and Taxonomies */
require_once( 'library/enqueue-post-types-taxonomies.php' );

/** register New Gear */
require_once( 'library/register-new-gear.php' );

/** add gear list */
require_once( 'library/all-gear-by-type.php' );

/** add gear list */
require_once( 'library/add-remove-gear.php' );

/** update gear */
require_once( 'library/update-gear.php' );

/** add gear list */
require_once( 'library/add-remove-sublist.php' );

/** sublists table */
require_once( 'library/sublists.php' );

/** Alert Boxes */
require_once( 'library/alert-boxes.php' );

/** force login */
require_once( 'library/force-login.php' );

/** Gearlist general functions */
require_once( 'library/gearlist-basic-functions.php' );


/** Gear Accordion */
require_once( 'library/gear-accordion.php' );


/** Filter */
require_once( 'library/filter.php' );


/** importer */
require_once( 'library/importer.php' );

?>

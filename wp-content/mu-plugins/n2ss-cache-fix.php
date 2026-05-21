<?php
/**
 * Smart Slider 3 cache directory fix.
 * Ensures wp-content/uploads/slider/cache/ is writable so Smart Slider can
 * generate image thumbnails. Self-deletes once the directory is confirmed writable.
 */
add_action('init', function () {
    $upload   = wp_upload_dir();
    $base     = $upload['basedir'];
    $slider   = $base . '/slider';
    $cache    = $base . '/slider/cache';

    // Create or fix slider/ dir
    if (!is_dir($slider)) {
        @mkdir($slider, 0755, true);
    } elseif (!is_writable($slider)) {
        @chmod($slider, 0755);
    }

    // Create or fix slider/cache/ dir
    if (!is_dir($cache)) {
        @mkdir($cache, 0755, true);
    } elseif (!is_writable($cache)) {
        @chmod($cache, 0755);
    }

    // Clear Smart Slider's compiled HTML cache so it regenerates
    // (forces fresh cache URLs to be generated and written on next load)
    if (is_writable($cache)) {
        global $wpdb;
        $wpdb->query(
            "DELETE FROM {$wpdb->prefix}nextend2_section_storage
             WHERE `section` LIKE 'smartslider%'"
        );

        // Self-delete — no longer needed once writable
        @unlink(__FILE__);
    }
}, 1);

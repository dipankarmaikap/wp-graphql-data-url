<?php
/**
 * Plugin Name: Graphql Featured Image DataUrl
 * Description: Add DataUrl of featured image in post query.
 * Version: 0.1.0
 * Author:      Dipankar Maikap
 * Author URI:  https://dipankarmaikap.com/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

add_action('plugins_loaded', function () {

    $dependencies = [
        'WPGraphQL' => class_exists('WPGraphQL'),
    ];

    $missing_dependencies = array_keys(array_diff($dependencies, array_filter($dependencies)));

    $display_admin_notice = function () use ($missing_dependencies) {
        ?>
        <div class="notice notice-error">
            <p>The Example Plugin core plugin can't be loaded because these dependencies are missing:</p>
            <ul>
                <?php foreach ($missing_dependencies as $missing_dependency): ?>
                    <li><?php echo esc_html($missing_dependency); ?></li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php
};

    // If dependencies are missing, display admin notice and return early.
    if ($missing_dependencies) {
        add_action('admin_notices', $display_admin_notice);
        add_action('network_admin_notices', $display_admin_notice); // Needed for multisite only.
        return;
    }

});
add_action('graphql_register_types', function () {

    register_graphql_field('ContentNode', 'featuredImageDataUrl', [
        'type' => 'String',
        'description' => __('DataUrl of Post featured Image', 'your-textdomain'),
        'resolve' => function (\WPGraphQL\Model\Post $post, $args, $context, $info) {
            $image = get_the_post_thumbnail_url($post->databaseId, 'thumbnail');
            $type = pathinfo($image, PATHINFO_EXTENSION);
            $data = file_get_contents($image);
            $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
            if ($image) {
                return $dataUri;
            }
            return null;
        },
    ]);

});

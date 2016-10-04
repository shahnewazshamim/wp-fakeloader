<?php
// Die if Basepath is not defined
defined('ABSPATH') or die('No script kiddies please!');

// Fetch the options from option table

$fakeloader = array(

    'delay_time' => get_option('fakeloader-delay-time'),

    'z_index' => get_option('fakeloader-z-index'),

    'bg_color' => get_option('fakeloader-bg-color'),

    'spinner' => get_option('fakeloader-spinner'),

    'is_image' => get_option('fakeloader-is-image'),

    'spinner_file' => get_option('fakeloader-spinner-file'),
);


echo '<h2>WP Fakeloader Settings</h2>';

echo '<hr>';

?>

<form method="post" action="options.php" enctype="multipart/form-data">

    <?php settings_fields("wp-fakeloader-settings"); ?>

    <?php do_settings_sections('wp-fakeloader-settings'); ?>

    <table class="form-table">

        <!-- Input for Delay Time -->

        <tr valign="top">

            <th scope="row">

                <label>Delay Time</label>

            </th>

            <td>

                <input type="text" value="<?php echo $fakeloader['delay_time']; ?>" name="fakeloader-delay-time" placeholder="Default value 1200"/>

            </td>

        </tr>

        <!-- Input for z-Index -->

        <tr valign="top">

            <th scope="row">

                <label>CSS z-Index</label>

            </th>

            <td>

                <input type="text" value="<?php echo $fakeloader['z_index']; ?>" name="fakeloader-z-index" placeholder="Default value 999"/>

            </td>

        </tr>

        <!-- Input for Spinner -->

        <tr valign="top">

            <th scope="row">

                <label>Spinner Style</label>

            </th>

            <td>

                <select name="fakeloader-spinner">

                    <option value="spinner1" <?php selected($fakeloader['spinner'], "spinner1"); ?>>Spinner 1</option>

                    <option value="spinner2" <?php selected($fakeloader['spinner'], "spinner2"); ?>>Spinner 2</option>

                    <option value="spinner3" <?php selected($fakeloader['spinner'], "spinner3"); ?>>Spinner 3</option>

                    <option value="spinner4" <?php selected($fakeloader['spinner'], "spinner4"); ?>>Spinner 4</option>

                    <option value="spinner5" <?php selected($fakeloader['spinner'], "spinner5"); ?>>Spinner 5</option>

                    <option value="spinner6" <?php selected($fakeloader['spinner'], "spinner6"); ?>>Spinner 6</option>

                    <option value="spinner7" <?php selected($fakeloader['spinner'], "spinner7"); ?>>Spinner 7</option>

                </select>

            </td>

        </tr>

        <!-- Input for Background color -->

        <tr valign="top">

            <th scope="row">

                <label>Background Color</label>

            </th>

            <td>

                <input type="text" value="<?php echo $fakeloader['bg_color']; ?>" name="fakeloader-bg-color" class="wp-fakeloader-color"/>

            </td>

        </tr>

        <!-- Input for Enabling image -->

        <tr valign="top">

            <th scope="row">

                <label>Enable Image</label>

            </th>

            <td>

                <input type="checkbox" value="true" <?php checked($fakeloader['is_image'], "true"); ?> name="fakeloader-is-image"/>

                <em> If <strong>checked</strong> this will be overwrite your spinner to below image</em>

            </td>

        </tr>

        <!-- Input for Spinner Image -->

        <tr valign="top">

            <th scope="row">

                <label>Custom Spinner (gif, png, jpg)</label>

            </th>

            <td>

                <input type="file" name="fakeloader-spinner-file"/>

            </td>

        </tr>

        <!-- Input for Spinner Image Preview-->

        <tr valign="top">

            <?php if ($fakeloader['spinner_file'] && isset($fakeloader['spinner_file'])) : ?>

                <th>

                    <label>Spinner Preview</label>

                </th>

                <td>

                    <img src="<?php echo $fakeloader['spinner_file']; ?>" alt="Fakeloader Spinner Image" width="100" height="100">

                </td>

            <?php endif; ?>

        </tr>

    </table>

    <?php submit_button(); ?>

</form>

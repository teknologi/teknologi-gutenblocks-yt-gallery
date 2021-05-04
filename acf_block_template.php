<?php

/**
 * DBT YouTube Gallery Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'dbt-yt-gallery-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dbt-yt-gallery';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if ( have_rows('yt-videos') ): ?>
        <div class="yt-videos">
            <?php while( have_rows('yt-videos') ): the_row(); ?>

            <?php
                $video_url = get_sub_field('video', false, false);
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match);
                $video_id = $match[1];

                $api_key = \getenv('YOUTUBE_API_KEY'); // change this

                $json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=' . $video_id . '&key=' . $api_key . '&part=snippet');
                $data = json_decode($json, true);
            ?>
            <a class="yt-video" href="<?php echo $video_url; ?>">
                <div class="yt-video-thumbnail">
                    <img src="<?php echo $data['items'][0]['snippet']['thumbnails']['standard']['url'] ?>">
                    <svg class="yt-video-thumbnail-button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 311.69 311.69"><path d="M155.84,0A155.85,155.85,0,1,0,311.69,155.84,155.84,155.84,0,0,0,155.84,0Zm0,296.42A140.58,140.58,0,1,1,296.42,155.84,140.58,140.58,0,0,1,155.84,296.42Z"></path><polygon points="218.79 155.84 119.22 94.34 119.22 217.34 218.79 155.84"></polygon></svg>
                </div>
                <p class="yt-video-title"> <?php echo $data['items'][0]['snippet']['title'] ?></p>
            </a>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>
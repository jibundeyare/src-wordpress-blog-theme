<?php
get_header();
?>

<div class="container">
<?php
if ( have_posts() ):
    while (have_posts()):
        the_post();
?>
    <article>
        <div class="row">
            <div class="col-lg-10 offset-lg-2">
                <h2><a href="<?= get_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div><em><?php the_time( get_option( 'date_format' ) ); ?></em></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 article-thumbnail">
<?php
        if ( has_post_thumbnail() ):
            the_post_thumbnail( 'thumbnail' );
        endif;
?>
            </div>
            <div class="col-lg-10">
                <div><?= wp_trim_excerpt(); ?></div>
            </div>
        </div>
    </article>
<?php
    endwhile;
endif;
?>
</div>

<?php
get_footer();


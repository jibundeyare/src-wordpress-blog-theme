<?php
get_header();
?>

<div class="container">
<?php
if ( have_posts() ):
    the_post();
?>
    <article>
        <div class="row">
            <div class="col-sm">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm article-illustration">
<?php
    if ( has_post_thumbnail() ):
        the_post_thumbnail( 'full' );
    endif;
?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div><?php the_content(); ?></div>
            </div>
        </div>
    </article>
<?php
endif;
?>
</div>

<?php
get_footer();


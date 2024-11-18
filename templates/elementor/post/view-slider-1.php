<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 *
 * @var $thumbnail_visibility       string
 * @var $project_thumbnail_size     string
 * @var $cat_visibility             string
 * @var $content_visibility         string
 * @var $readmore_visibility        string
 * @var $readmore_text              string
 * @var $author_visibility          string
 * @var $date_visibility            string
 * @var $comment_visibility         string
 * @var $reading_visibility         string
 * @var $content_limit              string
 * @var $views_visibility           string
 * @var $title_tag                  string
 * @var $title_count                string
 * @var $meta_icon_visibility       string
 * @var $args                       string
 * @var $delay                      string
 * @var $arrow_hover_visibility     string
 * @var $swiper_data                string
 * @var $duration                   string
 * @var $layout                     string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $display_arrow              string
 * @var $display_pagination         string
 */


$has_entry_meta  = ( $author_visibility || $cat_visibility || $comment_visibility || $reading_visibility ) ? true : false;


$query = new \WP_Query( $args );

?>

<div class="rt-swiper-slider <?php echo esc_attr( $arrow_hover_visibility ) ?>" data-xld ="<?php echo esc_attr( $swiper_data );?>">
    <div class="swiper-wrapper">
	    <?php if ( $query->have_posts() ) :
		    $ade = $delay; $adu = $duration;
		    while ( $query->have_posts() ) : $query->the_post();
			    $content = wp_trim_words( get_the_excerpt(), $content_limit, '.' );
			    $content = "<p>$content</p>";
			    $title = wp_trim_words( get_the_title(), $title_count, '' );
			    $comments_number = get_comments_number();
			    $comments_text   = sprintf( _n( 'Comment: %s', 'Comments: %s', $comments_number, 'foodymat-core' ), number_format_i18n( $comments_number ) );
            ?>
            <div class="swiper-slide">
                <article class="foodymat-post-card blog-grid-2 blog-<?php echo esc_attr( $layout)?> <?php echo esc_attr( $animation)?> <?php echo esc_attr( $animation_effect)?>" data-wow-delay="<?php esc_attr( $ade ); ?>ms" data-wow-duration="<?php esc_attr( $adu ); ?>ms">
                    <div class="article-inner-wrapper">
		                <?php if( 'visible' === $thumbnail_visibility ) { ?>
                            <div class="post-thumbnail-wrap">
                                <figure class="post-thumbnail">
                                    <a class="post-thumb-link alignwide" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						                <?php the_post_thumbnail( $project_thumbnail_size ); ?>
                                    </a>
                                </figure>
                            </div>
		                <?php } ?>
                        <div class="entry-wrapper">
                            <header class="entry-header">
				                <?php if ( $has_entry_meta ) { ?>
                                    <div class="rt-post-meta">
                                        <ul class="entry-meta">
							                <?php if ( $author_visibility ) { ?>
                                                <li><?php if ( $meta_icon_visibility ) { ?><i class="icon-rt-user-1"></i> <?php } ?> <?php echo foodymat_posted_by(esc_html__( 'by ', 'foodymat-core' )); ?></li>
							                <?php } if ( $cat_visibility )  { ?>
                                                <li><?php if ( $meta_icon_visibility ) { ?><i class="icon-rt-tag"></i> <?php } ?> <?php echo foodymat_posted_in(); ?></li>
							                <?php } if ( $date_visibility ) { ?>
                                                <li><?php if ( $meta_icon_visibility ) { ?><i class="icon-caleder-f"></i> <?php } ?> <?php echo foodymat_posted_on(); ?></li>
							                <?php } if ( $comment_visibility ) { ?>
                                                <li><?php if ( $meta_icon_visibility ) { ?><i class="icon-rt-comments"></i> <?php } ?> <a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $comments_text , 'allowed_html' );?></a></li>
							                <?php } if ( $reading_visibility ) { ?>
                                                <li><?php if ( $meta_icon_visibility ) { ?><i class="icon-rt-clock"></i> <?php } ?> <?php echo foodymat_reading_time(); ?></li>
							                <?php } if ( $views_visibility ) { ?>
                                                <li><?php if ( $meta_icon_visibility ) { ?><i class="icon-rt-eye"></i> <?php } ?> <?php echo rt_post_views(); ?></li>
							                <?php } ?>
                                        </ul>
                                    </div>
				                <?php } ?>

                                <<?php echo esc_attr( $title_tag ) ?> class="entry-title default-max-width"><a href="<?php the_permalink();?>"><?php foodymat_html( $title, 'allow_title' ); ?></a></<?php echo esc_attr( $title_tag ) ?>>
                            </header>
			                <?php if( 'visible' === $content_visibility ) { ?>
                                <div class="entry-content">
					                <?php foodymat_html( $content , false ); ?>
                                </div>
			                <?php } ?>
			                <?php if( 'visible' === $readmore_visibility ) { ?>
                                <div class="rt-button entry-footer">
                                    <a class="btn button-6" href="<?php the_permalink();?>">
						                <?php echo esc_html( $readmore_text );?><i class="icon-rt-arrow-right-1"></i>
                                    </a>
                                </div>
			                <?php } ?>
                        </div>
                    </div>
			    </article>
            </div>
            <?php $ade = $ade + 200; $adu = $adu + 0; endwhile; ?>
	    <?php endif; ?>
    </div>
	<?php if ( $display_arrow == 'yes' ) { ?>
        <div class="swiper-navigation">
            <div class="swiper-button swiper-button-prev"><i class="icon-rt-left-arrow"></i></div>
            <div class="swiper-button swiper-button-next"><i class="icon-rt-right-arrow"></i></div>
        </div>
	<?php } ?>
	<?php if ( $display_pagination == 'yes' ) { ?>
        <div class="swiper-pagination"></div>
	<?php } ?>
</div>




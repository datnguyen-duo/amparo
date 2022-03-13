<?php
/* Template Name: FAQ */

$faq_headline = get_field('faq_headline');
$faq_list = get_field('faq_list');
get_header(); ?>

<div class="faq_wrap">
    <div class="headline_wrap">
        <?php if($faq_headline): ?>
            <h1 class="letter_wrap"><?php echo $faq_headline; ?></h1>
        <?php endif; ?>
    </div>

    <?php if($faq_list): ?>
        <div class="accordions_wrap fade_up fadein_wrap">
            <div class="accordions">
                <?php foreach( $faq_list as $singleFaq ): ?>
                    <div class="single_accoridion">
                        <div class="header">
                            <h2><?php echo $singleFaq['single_headline'] ?></h2>
                            
                            <div class="accordion_icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/faq/accordion_shape.svg" alt="" class="shape">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/arrow_right.svg" alt="" class="arrow_icon">
                            </div>
                        </div>

                        <div class="description">
                            <p>
                                <?php echo $singleFaq['single_description'] ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer(); ?>
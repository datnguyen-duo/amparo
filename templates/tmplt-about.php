<?php
/* Template Name: About */

$hero_section_headline = get_field('hero_section_headline');
$hero_section_image_1 = get_field('hero_section_image_1');
$hero_section_image_2 = get_field('hero_section_image_2');
$hero_section_image_3 = get_field('hero_section_image_3');
$hero_section_image_4 = get_field('hero_section_image_4');

$second_section_headline = get_field('second_section_headline');
$second_section_description = get_field('second_section_description');

$section_3_headline = get_field('section_3_headline');
$section_3_list = get_field('section_3_list');

$team_section_headline = get_field('team_section_headline');
$team_list = get_field('team_list');

$cta_section_headline = get_field('cta_section_headline');
$cta_section_small_headline = get_field('cta_section_small_headline');
$cta_section_link = get_field('cta_section_link');
get_header(); ?>

<div class="about_wrap">
    
    <div class="hero_wrap">
        <?php  ?>
        <?php if($hero_section_image_3): ?>
            <img src="<?php echo $hero_section_image_3['url'] ?>" alt="<?php echo $hero_section_image_3['alt'] ?>" class="hero_image hero_image1">
        <?php endif; ?>

        <?php if($hero_section_image_4): ?>
            <img src="<?php echo $hero_section_image_4['url'] ?>" alt="<?php echo $hero_section_image_4['alt'] ?>" class="hero_image hero_image2">
        <?php endif; ?>

        <?php if($hero_section_image_1): ?>
            <img src="<?php echo $hero_section_image_1['url'] ?>" alt="<?php echo $hero_section_image_1['alt'] ?>" class="hero_image hero_image3">
        <?php endif; ?>
        
        <?php if($hero_section_image_2): ?>
            <img src="<?php echo $hero_section_image_2['url'] ?>" alt="<?php echo $hero_section_image_2['alt'] ?>" class="hero_image hero_image4">
        <?php endif; ?>

        <?php if($hero_section_headline): ?>
            <h1 class="letter_wrap"><?php echo $hero_section_headline; ?></h1>
        <?php endif; ?>

        <a class="scroll_down" href="#first_section_content">
            <img src="<?php echo get_template_directory_uri(); ?>/images/about/arrow_down.svg" alt="">
            <span>scroll down</span>
        </a>
    </div>

    <div class="first_section">
        <div class="first_section_content" id="first_section_content">
            <?php if($second_section_headline): ?>
                <h2 class="letter_wrap"><?php echo $second_section_headline; ?></h2>
            <?php endif; ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/about/shape.svg" alt="">
            <?php if($second_section_description): ?>
                <p>
                    <?php echo $second_section_description; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <div class="second_section">
        <div class="second_section_content">
        <div class="left">
            <div class="container">
                <img src="<?php echo get_template_directory_uri(); ?>/images/about/shape_big.svg" class="shape_image">
                <div class="image_holder_wrap">
                        <?php $counter = 1; ?>
                        <?php foreach( $section_3_list as $singleItem ): ?>
                            <div class="image_holder <?php if($counter == 1): ?>one<?php elseif($counter == 2): ?>two<?php elseif($counter == 3): ?>three<?php endif; ?>">
                                <img src="<?php echo $singleItem['list_image']['url']; ?>" class="bg <?php if($counter == 1): ?>one<?php elseif($counter == 2): ?>two<?php elseif($counter == 3): ?>three<?php endif; ?>">
                            </div>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="right_content">
                <div class="first_box">
                    <?php if($section_3_headline): ?>
                        <h2 class="letter_wrap"><?php echo $section_3_headline; ?></h2>
                    <?php endif; ?>
                </div>
                <?php if($section_3_list): $counter = 1; ?>
                    <?php foreach( $section_3_list as $singleItem ): ?>
                        <div class="single_box">
                        <div class="box_content fadein_wrap">
                            <div class="headline_holder">
                                <span class="counter_headline fadein_wrap">0<?php echo $counter++ ?></span>
                                <h2 class="letter_wrap fadein_wrap"><?php echo $singleItem['list_headline']; ?></h2>
                            </div>
                            <p><?php echo $singleItem['list_description']; ?></p>
                        </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        </div>
    </div>

    <div class="team_wrap">
        <div class="single_team_popup_holder">
            <div class="single_team_popup">
                <div class="popup_team_title">
                    MARK MAROTTA, FOUNDER
                </div>
                <div class="single_team">
                    <div class="team_image_holder">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/about/team.png" alt="">
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sagittis tortor in euismod placerat. Curabitur ultricies rhoncus ex, ut lacinia nisl venenatis vitae. Cras ut felis ipsum. Vivamus eu scelerisque sapien, vel congue mauris. Quisque dictum enim quam, vel rhoncus orci aliquam vel. Donec vel scelerisque urna. Fusce et urna orci. Aenean tempor quam sit amet fringilla accumsan. Mauris ut mauris neque. Curabitur sollicitudin mattis odio, quis luctus lectus scelerisque vel. Proin sed sodales metus. Pellentesque aliquet fermentum consectetur. 
                    </p>
                </div>
            </div>
        </div>
        <?php if($team_section_headline): ?>
            <h2 class="letter_wrap"><?php echo $team_section_headline; ?></h2>
        <?php endif; ?>

        <?php if($team_list): ?>
            <div class="team_wrap_content">
                <?php foreach( $team_list as $singleTeam ): ?>
                    <div class="single_team_wrap active">
                        <div class="position">
                            
                            <span><?php echo $singleTeam['single_team_name'] ?>, </span> <?php echo $singleTeam['single_team_position'] ?>
                        </div>
                        <div class="single_team">
                            <div class="team_image_holder">
                                <img src="<?php echo $singleTeam['single_team_image']['url'] ?>" alt="<?php echo $singleTeam['single_team_image']['alt'] ?>">
                            </div>
                            <p>
                                <?php echo $singleTeam['single_team_description'] ?>
                            </p>
                        </div>
                        <div class="name">
                            <?php echo $singleTeam['single_team_name'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="call_to_action_box">
        <div class="call_to_action_box_content">
            <div class="cta_info">
                <?php if($cta_section_small_headline): ?>
                    <p><?php echo $cta_section_small_headline; ?></p>
                <?php endif; ?>
                <?php if($cta_section_headline): ?>
                    <h2 class="big_headline letter_wrap"><?php echo $cta_section_headline; ?></h2>
                <?php endif; ?>
                <?php if($cta_section_link): ?>
                    <a href="<?php echo $cta_section_link['url'] ?>" target="<?php echo $cta_section_link['target'] ?>" class="btn dark" data-text="<?php echo $cta_section_link['title'] ?>"><?php echo $cta_section_link['title'] ?></a>
                <?php endif; ?>
            </div>

            <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_left.svg" alt="" class="left_shape">
            <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_right.svg" alt="" class="right_shape">
            
            <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_top_mobile.svg" alt="" class="top_shape">
            <img src="<?php echo get_template_directory_uri(); ?>/images/cta_shape_bottom_mobile.svg" alt="" class="bottom_shape">
        </div>
    </div>
</div>

<?php
get_footer(); ?>
<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

get_header();
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<?php
while ( have_posts() ) : the_post();
    ?>

    <main <?php post_class( 'site-main' ); ?> role="main">
        <?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
            <header class="page-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>
        <?php endif; ?>
        <div class="page-content">
            <?php $postID =get_the_ID(); ?>

            <p><strong>ИНН</strong> <?= get_post_meta( $postID,'inn', true ) ?></p>
            <p><strong>Дата регистрации</strong> <?= get_post_meta( $postID,'datareg', true ) ?></p>
            <p><strong>Город</strong> <?= get_post_meta( $postID,'city', true ) ?></p>
            <p><strong>ИФНС</strong> <?= get_post_meta( $postID,'ifns', true ) ?></p>
            <p><strong>Уставный капитал</strong> <?= get_post_meta( $postID,'kap', true ) ?> ₽</p>
            <p><strong>Система налогообложения</strong> <?= get_post_meta( $postID,'nalog', true ) ?></p>
            <p><strong>Расчетные счета</strong> <?= get_post_meta( $postID,'bank', true ) ?></p>
            <p><strong>Обороты</strong> <?= get_post_meta( $postID,'oboroti', true ) ?></p>
            <p><strong>Вид деятельности</strong> <?= get_post_meta( $postID,'vid', true ) ?></p>
            <p><strong>Основной ОКВЭД</strong> <?= get_post_meta( $postID,'okwed', true ) ?></p>
            <p><strong>Допуск СРО</strong> <?= get_post_meta( $postID,'dopusk', true ) ?></p>
            <p><strong>Лицензии</strong> <?= get_post_meta( $postID,'linece', true ) ?></p>
            <p><strong>Гос. контракты</strong> <?= get_post_meta( $postID,'contry_contract', true ) ?></p>
            <p><strong>Цена продажи</strong> <?= get_post_meta( $postID,'price', true ) ?> ₽</p>

            <?php the_content(); ?>


            <a href="#" class="elementor-button-link elementor-button elementor-size-sm popmake-3637" style="width: 100%" role="button">
						<span class="elementor-button-content-wrapper">
						    <span class="elementor-button-text">Задать вопрос о фирме</span>
		                </span>
            </a>

            <div class="post-tags">
                <?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'hello-elementor' ), null, '</span>' ); ?>
            </div>
            <?php wp_link_pages(); ?>
        </div>

        <?php comments_template(); ?>
    </main>

<?php
endwhile;

get_footer();
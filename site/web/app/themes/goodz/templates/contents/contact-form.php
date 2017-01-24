<?php
/**
 * Displays Contact Form on Contact Page Template
 *
 * @package  Goodz
 */


// Captcha on/off
$captcha_option = esc_attr( get_theme_mod( 'goodz_contact_captcha_setting' ) );

?>

<form method="GET" id="contactform" class="contact-form" action="#" >

    <!-- Name -->
    <div class="small-input">
        <label for="contactname"><?php esc_html_e( 'Name&nbsp;', 'goodz' ); ?></label>
        <input type="text" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo esc_attr($_SESSION['contactname']);} ?>" name="contactname" id="contactname" tabindex="1" />
    </div>
    <!-- Email -->
    <div class="small-input">
        <label for="contactemail"><?php esc_html_e( 'Email&nbsp;', 'goodz' ); ?></label>
        <input type="text" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo esc_attr($_SESSION['contactemail']);} ?>" name="email" id="contactemail" tabindex="2" />
    </div>
    <!-- Message -->
    <div>
        <label for="contactmessage"><?php esc_html_e( 'Message&nbsp;', 'goodz' ); ?></label>
        <textarea name="message" id="contactmessage" tabindex="3" rows="6"><?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo esc_attr($_SESSION['contactmessage']);} ?></textarea>

        <?php if ( $captcha_option ) { //Disable captcha ?>

            <div class="contact-captcha">
                <img src="<?php echo get_template_directory_uri(); ?>/inc/captcha/captcha.php" id="captcha" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                <div class="bg-input captcha-holder">
                    <div class="control-group clear">
                        <div class="input-prepend">
                            <input type="text" name="captcha" id="captcha-form" autocomplete="off" />
                        </div>
                        <div class="refresh-text">
                            <a onclick="document.getElementById('captcha').src='<?php echo get_template_directory_uri();?>/inc/captcha/captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();"
                        id="change-image" class="captcha-refresh"><?php esc_html_e( 'Cant read? Refresh Image', 'goodz' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php } //Disable captcha ?>

        <p class="contact-submit">
            <input name="submit" type="submit" id="send_contact" value="<?php esc_html_e( 'Submit', 'goodz' ); ?>">
        </p>

        <div id="contact-error"></div>

    </div>

</form>

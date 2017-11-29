<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uri-modern
 */

?>

	</div><!-- #content -->

    <div id="actionbar-wrapper">
        <div id="actionbar">
            <a href="#" id="action-apply"><span></span>Apply</a>
            <a href="#" id="action-tour"><span></span>Tour</a>
            <a href="#" id="action-give"><span></span>Give</a>
        </div>
    </div><!-- #actionbar-wrapper -->

	<footer id="globalfooter">
        <div id="basement">
            <div id="storagebins">
                <div>
                    <input id="sb-university" type="radio" name="storagebin" value="university">
                    <label for="sb-university"><span>University</span></label>
                    <ul>
                        <li><a href="#">Leadership</a></li>
                        <li><a href="#">Diveristy and Inclusion</a></li>
                        <li><a href="#">Global</a></li>
                        <li><a href="#">Campuses</a></li>
                        <li><a href="#">Safety</a></li>
                    </ul>
                </div>
                <div>
                    <input id="sb-student-life" type="radio" name="storagebin" value="student-life">
                    <label for="sb-student-life"><span>Student Life</span></label>
                    <ul>
                        <li><a href="#">Housing</a></li>
                        <li><a href="#">Dining</a></li>
                        <li><a href="#">Athletics and Recreation</a></li>
                        <li><a href="#">Health and Wellness</a></li>
                        <li><a href="#">Events</a></li>
                    </ul>
                </div>
                <div>
                    <input id="sb-academics" type="radio" name="storagebin" value="academics">
                    <label for="sb-academics"><span>Academics</span></label>
                    <ul>
                        <li><a href="#">Undergraduate</a></li>
                        <li><a href="#">Graduate</a></li>
                        <li><a href="#">Advising</a></li>
                        <li><a href="#">Library</a></li>
                        <li><a href="#">Colleges</a></li>
                    </ul>
                </div>
            </div>
            <div id="gimmicks">
                <!-- Tides Widget -->
                <?php 
                    if (function_exists('uri_tides_shortcode')) {
                        echo do_shortcode('[uri-tides darkmode=true height=20]');
                    }
                ?>
                <!-- Social Media Component -->
                <?php 
                    if (function_exists('uri_cl_shortcode_social')) {
                        $facebook = 'https://www.facebook.com/universityofri';
                        $instagram = 'https://www.instagram.com/universityofri/';
                        $twitter = 'https://twitter.com/universityofri';
                        $youtube = 'https://www.youtube.com/user/UniversityOfRI';
                        echo do_shortcode('[cl-social style="light" facebook="' . $facebook . '" instagram="' . $instagram . '" twitter="' . $twitter . '" youtube="' . $youtube . '"]');
                    }
                ?>
            </div>
        </div>
        <div id="tagline"></div>
        <div id="legal">
            <p>Copyright &copy; <a class="subtle" href="http://www.uri.edu/">University of Rhode Island</a> | University of Rhode Island, Kingston, RI 02881, USA | 1.401.874.1000</p>
            <p>URI is an equal opportunity employer committed to the principles of affirmative action.&nbsp;&nbsp;<a href="#">Work at URI</a></p>
        </div>
	</footer><!-- #globalfooter -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!--
            _o_
           / _ \
           \XX./X
        ___X| |_X__
      O(____  XX___)O
         X  | |
         X  | |
          X | |
           X| |
  o____     | |X    ____o
  |   /     / \ X   \   |
  |__ \_   |   | X _/ __|
     \  \_XX   \X_/  /
      \_    XXXX   _/
        X____^____/
        X
.__      X                
|  |__   ____ ______   ____  
|  |  \ /  _ \\____ \ / __ \ 
|   Y  |  (_) |  |_) |  ___/ 
|___|__/\____/|   __/ \____)
              |__|         

-->

</body>
</html>

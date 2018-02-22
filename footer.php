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
        <div id="actionbar" role="menu">
            <a href="https://www.uri.edu/apply" id="action-apply" role="menuitem"><span role="presentation"></span>Apply</a>
            <a href="https://www.uri.edu/tour" id="action-tour" role="menuitem"><span role="presentation"></span>Tour</a>
            <a href="https://www.uri.edu/give" id="action-give" role="menuitem"><span role="presentation"></span>Give</a>
        </div>
    </div><!-- #actionbar-wrapper -->

	<footer id="globalfooter">
        <div id="basement">
            <div id="storagebins">
                <div id="sb-university">
                    <input id="sb-university-toggle" type="radio" name="storagebin" value="university" role="presentation" aria-label="Open the University footer menu when browsing on mobile.">
                    <label for="sb-university-toggle"><span>University</span></label>
                    <ul role="menu" aria-label="The University footer menu.">
                        <li role="presentation"><a href="https://web.uri.edu/about/university-leadership/" role="menuitem">Leadership</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/diversity/" role="menuitem">Diversity and Inclusion</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/globaluri/" role="menuitem">Global</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/about/campuses/" role="menuitem">Campuses</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/publicsafety/" role="menuitem">Safety</a></li>
                    </ul>
                </div>
                <div id="sb-student-life">
                    <input id="sb-student-life-toggle" type="radio" name="storagebin" value="student-life" role="presentation" aria-label="Open the Student Life footer menu when browsing on mobile.">
                    <label for="sb-student-life-toggle"><span>Student Life</span></label>
                    <ul role="menu" aria-label="The Student Life footer menu.">
                        <li role="presentation"><a href="https://web.uri.edu/housing/" role="menuitem">Housing</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/dining/" role="menuitem">Dining</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/athletics/" role="menuitem">Athletics and Recreation</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/campus-life/health-and-safety/" role="menuitem">Health and Wellness</a></li>
                        <li role="presentation"><a href="https://events.uri.edu" role="menuitem">Events</a></li>
                    </ul>
                </div>
                <div id="sb-academics">
                    <input id="sb-academics-toggle" type="radio" name="storagebin" value="academics" role="presentation" aria-label="Open the Academics footer menu when browsing on mobile.">
                    <label for="sb-academics-toggle"><span>Academics</span></label>
                    <ul role="menu" aria-label="The Academics footer menu.">
                        <li role="presentation"><a href="https://web.uri.edu/academics/" role="menuitem">Undergraduate</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/graduate-school/" role="menuitem">Graduate</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/advising/" role="menuitem">Advising</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/library/" role="menuitem">Library</a></li>
                        <li role="presentation"><a href="https://web.uri.edu/about/departments/" role="menuitem">Colleges</a></li>
                    </ul>
                </div>
            </div>
            <div id="gimmicks">
                <!-- Tides Widget -->
                <?php 
                    if (function_exists('uri_tides_shortcode')) {
                        echo do_shortcode('[uri-tides darkmode=true height=22]');
                    }
                ?>
                
                <?php if (function_exists('uri_tides_shortcode') && function_exists('uri_cl_shortcode_social')) : ?> 
                <hr>
                <?php endif ?>
                
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
            <p>URI is an equal opportunity employer committed to the principles of affirmative action.&nbsp;&nbsp;<a href="https://jobs.uri.edu/">Work at URI</a></p>
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

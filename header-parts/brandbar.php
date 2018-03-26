    <header id="brandbar" class="site-header" role="banner">
        
        <div id="identity-print"><img src="<?php echo get_template_directory_uri() . '/images/logo-print.png'; ?>" width="120px" alt="University of Rhode Island"></div>
        
        <div id="globalsearch" role="search">
            <input type="checkbox" id="gsform-toggle" role="presentation" aria-label="Toggle visibility of the search box.">
            <label for="gsform-toggle" id="gsform"><span>Search</span></label>
            <form id="gs" method="get" action="https://www.uri.edu/search" name="global_general_search_form">
                <input type="hidden" name="cx" value="016863979916529535900:17qai8akniu" />
                <input type="hidden" name="cof" value="FORID:11" />
                <input role="searchbox" name="q" id="gs-query" value="<?php print (isset($_GET['q'])) ? htmlentities($_GET['q']) : '' ?>" type="text" placeholder="Search" />
                <input type="submit" id="gs-submit" class="searchsubmit" name="searchsubmit" value="Search" />
            </form>
        </div>
        
        <div id="globalbanner-wrapper">
            <div id="globalbanner">
                <a href="http://www.uri.edu/" title="University of Rhode Island"><div id="identity">University of Rhode Island</div></a>
                
                <?php if ( URI_BETA_FEATURES ) : ?>
                
                <input type="checkbox" id="gateways-toggle" role="presentation" aria-label="Open the audience gateways menu when browsing on mobile">
                <label for="gateways-toggle" id="gateways-label"><span>You</span></label>
                <ul id="gateways-menu" role="menu">
                    <li><a href="/gateway/prospectives" role="menuitem">Future Students</a></li>
                    <li><a href="/gateway/students" role="menuitem">Students</a></li>
                    <li><a href="/gateway/faculty" role="menuitem">Faculty</a></li>
                    <li><a href="/gateway/staff" role="menuitem">Staff</a></li>
                    <li><a href="/gateway/families" role="menuitem">Parents and Families</a></li>
                    <li><a href="https://alumni.uri.edu" role="menuitem">Alumni</a></li>
                    <li><a href="/gateway/community" role="menuitem">Community</a></li>
                </ul>
                
                <?php endif ?>
                                
            </div>
        </div>

	</header><!-- #brandbar -->
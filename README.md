# URI Modern

URI Modern is a WordPress theme designed for the University of Rhode Island. It's designed to replace all themes currently being used on the university's websites, and unify the online brand and experience. 

## Guiding Principles

URI Modern is a mobile-first design, built to embrace the latest web technologies and strictest accessibility standards. Our approach can be summarized by four guiding principles. We want to:

1. Design a clean, beautiful interface that elevates content
2. Be responsive and accessible
3. Use clean, modern, and efficient code
4. Avoid business logic

Built into each of these principles is the goal of being future-proof.  By building a theme with a lean, modern architecture that leverages as much native WordPress functionality as possible, we can reduce maintenance and avoid pitfalls as WordPress inevitably grows and changes.

Finally, as noted by the fourth guiding principle, it's important to emphasize that URI Modern is, by design, a theme, and *only* a theme.  This means that changing from this theme to another should change the look and feel of the website, but not impact its functionality.  Moving business logic out of the theme is a key developmental goal of this project, and will simplify maintenance and development of the website going forward.  To that end, many of the other URI Web repositories are plugins that add functionality outside the display layer.

## How do I get set up?

1. Install into your WordPress wp-content/themes directory
2. Activate it as your site's theme
3. Configure it with Customizer

## Development

Development on URI Modern uses a git model with two main branches, `master` and `develop`.  We're generally following [this model](http://nvie.com/posts/a-successful-git-branching-model/ "A successful Git branching model").

In this model, all development occurs on the `develop` branch, with features and experimental modifications occuring on `feature-*` branches which are created from, and later merged back into, `develop`.

When enough new features and changes have been amassed, a `release-#` branch is created from `develop`, where the version number is bumped and any final release preparations and bug fixes are made.  Changes to the `release-#` branch may be continuously merged back into `develop`.  When the release is ready, `release-#` is merged into `master` and tagged with the version number.

If a serious bug emerges in production, it can be fixed in a `hotfix-#` branch created from `master`.  When the fix is complete, the version number is bumped and `hotfix-#` is merged into both `master` (with a new tag) and `develop`.
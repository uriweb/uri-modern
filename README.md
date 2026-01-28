# URI Modern

[![GitHub release (latest by date)](https://img.shields.io/github/v/release/uriweb/uri-modern)](https://github.com/uriweb/uri-modern/releases/latest)
[![GitHub Release Date](https://img.shields.io/github/release-date/uriweb/uri-modern)](https://github.com/uriweb/uri-modern/releases/latest)
![GitHub License](https://img.shields.io/github/license/uriweb/uri-modern)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/fa900133ab854001a03182aa712eb6c2)](https://www.codacy.com/gh/uriweb/uri-modern/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=uriweb/uri-modern&amp;utm_campaign=Badge_Grade)
[![CodeFactor](https://www.codefactor.io/repository/github/uriweb/uri-modern/badge/master)](https://www.codefactor.io/repository/github/uriweb/uri-modern/overview/master)
![GitHub top language](https://img.shields.io/github/languages/top/uriweb/uri-modern?color=violet&branch=master)

URI Modern is the primary WordPress theme for the University of Rhode Island, designed to unify the online brand and experience.

## What's new in 4.1.3

* Fixes cache busting when a child theme is active

## What's new in 4.1.2

 * Enhances the accessibility of the You navigation menu and Search button 

## What's new in 4.1.1

* Updates EOE statement in footer (this was previously changed in v4.0.3 but was inadvertenty reverted in v4.1)
* Whitelists future Component Library Tooltip block for administrators

## New in 4.1.0

* Updates navigation, footer, banner, contrast, and more for better accessibility.

    - Add search role to search form in banner
    - Use `<nav>` tags for You menu dropdown
    - Use `<nav>` tags on global menu
    - Make date component admin only
    - Make metric component admin only
    - Increase contrast of source text for tides widget in footer
    - Put 'actionbar' links in region landmark
    - Increase contrast for 'Continue Reading' button on category pages
    - Increase contrast for feature-caption credit
    - Hardcode social media in footer; edit accessible name
    - Use $lightgold color on yellow notices
    - Remove aria-labels from `<label>` elements in footer
    - Remove menu role from links in footer--make them just links
    - Remove menu role from actionbar 'Quick Links'--make them just links
    - Consolidate banners into one under 'masthead'
    - Move 'Skip to Content' link into header
    - Enlarge touch target for legal links in footer
    - Edit the external and internal header templates

## How do I get set up?

### Typical installation

1. Grab a copy of the [latest version](https://github.com/uriweb/uri-modern/releases/latest)
2. Install it into your WordPress `wp-content/themes` directory
3. Activate it as your site's theme
4. Configure it with Customizer

### Using Packagist
If your site is built on a composer stack, you can add the latest version by running:
```shell
composer require uriweb/uri-modern
```

## Theme details

__Contributors:__ [bjcfuller](https://github.com/bjcfuller), [alexandragauss](https://github.com/alexandragauss), [johnpennypacker](https://github.com/johnpennypacker)  
__Tags:__ themes  
__Requires at least:__ 5.8  
__Tested up to:__ 6.8.3  
__Stable tag:__ 4.1.3  
__License:__ [GPL-3.0](https://www.gnu.org/licenses/gpl-3.0.html)

# Contributing to URI Modern

Thanks for your interest in contributing to URI Modern!  As a contributor, there are a few things we'd like you to know.

* [Have a question?](#questions)
* [Find a bug?](#bugs)
* [Have an idea for a feature?](#features)
* [Guiding Principles](#principles)
* [Submission Guidelines](#submission)
* [Development Guidelines](#development)
* [Code of Conduct](#conduct)

## <a name="questions"></a>Have a question?

If you have a question about using or contributing to URI Modern that isn't answered here, let us know.  However, we ask that you not open issues for general questions.

Instead, get in touch outside the repository by contacting someone below on the URI Web Communications team:

* __Brandon Fuller__ [bjcfuller@uri.edu](mailto:bjcfuller@uri.edu)
* __Alexandra Gauss__ [alexandra_gauss@uri.edu](mailto:alexandra_gauss@uri.edu)
* __Sarah Couch__ [scouch@uri.edu](mailto:scouch@uri.edu)

We will do our best to respond to your questions quickly and thoroughly.

If you think something is missing, doesn't work right, or could work better, consider [reporting a bug](#find-a-bug) or [requesting a feature](#features).

## <a name="bugs"></a>Find a bug?

We try, but we can't catch 'em all. If you find a bug in the source code, please let us know so we can fix it.  You can do that by [submitting an issue](#submit-issue) to our [GitHub repository](https://github.com/uriweb/uri-modern).

Better yet, if you can fix the bug yourself, [submit a pull request](#submit-pr) instead.

## <a name="features"></a>Have an idea for a feature?

If you have an idea for a new or improved feature, you can request it by [submitting an issue](#submit-issue) to the repository.

If there's a new feature you'd like to work on and eventually see implemented, we ask that you first submit an issue with a proposal of your work.  That way we can make sure that your work would be beneficial to the project, and you can avoid spending time on a feature that we wouldn't end up implementing.  It might be helpful to read about our [guiding principles](#principles).

## <a name="principles"></a>Guiding Principles

URI Modern is a mobile-first design, built to embrace the latest web technologies and strictest accessibility standards. Our approach can be summarized by four guiding principles. We want to:

1. Design a clean, beautiful interface that elevates content
2. Be responsive and accessible
3. Use clean, modern, and efficient code
4. Avoid business logic

Built into each of these principles is the goal of being future-proof.  By building a theme with a lean, modern architecture that leverages as much native WordPress functionality as possible, we can reduce maintenance and avoid pitfalls as WordPress inevitably grows and changes.

Finally, as noted by the fourth guiding principle, it's important to emphasize that URI Modern is, by design, a theme, and *only* a theme.  This means that changing from this theme to another should change the look and feel of the website, but not impact its functionality.  Moving business logic out of the theme is a key developmental goal of this project, and will simplify maintenance and development of the website going forward.  To that end, many of the other URI Web repositories are plugins that add functionality outside the display layer.

## <a name="submission"></a>Submission Guidelines

### <a name="submit-issue"></a>Submitting an Issue

First off, before you submit an issue, we ask that you search the [issue tracker](https://github.com/uriweb/uri-modern/issues) to see if it's already been documented.  Duplicate issues will be tagged as such and may be closed or merged with the most comprehensive submission.

If the issue hasn't been documented, file a [new issue](https://github.com/uriweb/uri-modern/issues/new).  In your comment, please describe the issue in as much detail as possible.  If you're reporting a bug, it's vital that you also include the steps necessary to reproduce the problem.  We can't investigate or fix bugs without that information.

If you think you came across a bug but aren't able to reproduce it, please hold off on submitting an issue.  If it's important enough, you can [get in touch](#questions) with us outside of GitHub, and we can decide how to proceed from there.

### <a name="submit-pr"></a>Submitting a Pull Request

If you're thinking about fixing a bug or developing a new feature, we ask that you first check for any open or closed [pull requests](https://github.com/uriweb/uri-modern/pulls) that relate to what you'd like to do.  It's possible that someone beat you to it.

Before you get to work, please consider our [development guidelines](#development).  Unless you have or request access to the repository, your changes will (and should) be made on a [fork](https://help.github.com/articles/fork-a-repo/).

Once you're satisfied with your work, we recommend [testing](#testing) your code for compliance with WordPress coding standards.  Once you've fixed any errors, send a [pull request](https://github.com/uriweb/uri-modern/compare) to `uri-modern:develop` so that we can consider merging it in.  If we have any suggestions, we'll let you know.  You can then make those updates, rebase your branch, and force push to your GitHub repository to update your pull request.

## <a name="development"></a>Development Guidelines

### Prerequisites

Before you can develop URI Modern, you'll need to install a few prerequisites.

* [Git](https://git-scm.com) and/or a Git client, such as [GitHub Desktop](https://desktop.github.com) or [Sourcetree](https://www.atlassian.com/software/sourcetree)
* [Node.js](https://nodejs.org/), (version specified in the engines field of [`package.json`](https://github.com/uriweb/uri-modern/blob/develop/package.json)) which is used to distribute [npm](https://www.npmjs.com)
* [npm](https://www.npmjs.com), (version specified in the engines field of [`package.json`](https://github.com/uriweb/uri-modern/blob/develop/package.json)) which is used to install dependencies (npm is included in Node.js but may need to be updated separately)
* [Gulp.js](https://gulpjs.com) and [gulp-cli](https://www.npmjs.com/package/gulp-cli), which is used to compile the source code

You'll need some [additional prerequisites](#testing) if you plan to test your code, which we recommend doing.

### Fork

To contribute to URI Modern, you'll need to fork and clone the repository:

1. Create or login to your GitHub account.
2. Fork the [main URI Modern repository](https://github.com/uriweb/uri-modern) (learn more about [forking on GitHub](http://help.github.com/forking)).
3. Clone your fork of the repository.
4. Configure Git to keep your fork in sync with the main repository by defining an `upstream` remote.

```shell
# Clone your GitHub repository:
$ git clone git@github.com:<github username>/uri-modern.git

# Go to the repository directory:
$ cd uri-modern

# Add the main repository as an upstream remote to your repository:
$ git remote add upstream https://github.com/uriweb/uri-modern.git
```

### Install Dependencies

URI Modern source files are compiled with [gulp.js](https://gulpjs.com/).  You'll need to install gulp and the JavaScript modules specified in the devDependencies field of [`package.json`](https://github.com/uriweb/uri-modern/blob/develop/package.json).

You might need to first remove any previous versions of gulp you may have installed globally:

```shell
$ npm rm -g gulp
```

Then install gulp-cli globally:

```shell
$ npm install -g gulp-cli
```

Finally, install gulp locally, along with dependencies:

```shell
# Hop into your project dir (if you're not there already)
$ cd <project_dir>

# Install gulp
$ npm install gulp

# Install gulp dependencies
$ npm install --save-dev
```

Run gulp to make sure everything worked:
```shell
$ gulp
```

__Note:__ It's probably a good idea to stop gulp before switching branches and restart after switching, in case there are differences in [`gulpfile.js`](https://github.com/uriweb/uri-modern/blob/develop/gulpfile.js) or added/removed partials.  That way you're guaranteed a clean compile.


### <a name="testing"></a>Test your code

After you've written some code and are thinking about [submitting a pull request](#submit-pr), we encourage you to test your code locally and fix any errors that occur.  This will make it easier for your PR to build successfully in Travis-CI.

You'll need to install some prerequisites first:

* [Composer](https://getcomposer.org), which is used to install PHP CodeSniffer
* [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer), which is used to test code locally
* [WordPress Coding Standards](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards#installation), a collection of PHP CodeSniffer rules for WordPress

#### Install Composer

There are a lot of PHP dependency managers out there, so if you have one you like or are already using, feel free to [install PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer#installation) that way.

For this guide, we'll use Composer.  Here's how to [install it](https://getcomposer.org/download/).

To make the `composer` command available, run:

```shell
# You may need to run with sudo
$ mv composer.phar /usr/local/bin/composer
```

#### Install PHP CodeSniffer

Install PHP CodeSniffer using their [instructions for Composer](https://github.com/squizlabs/PHP_CodeSniffer#composer).

Essentially, this involves running:

```shell
$ composer global require "squizlabs/php_codesniffer=*"
```

This will install PHP CodeSniffer globally and add a dependency in your `composer.json` file (it'll create it too, if it doesn't exist)

Then, hop into your `.composer` directory and make sure everything is up to date:

```shell
$ cd .composer
$ composer update
$ vendor/bin/phpcs --version
```

##### Make PHP CodeSniffer available system-wide

Right now, you won't be able to run PHP CodeSniffer from your project directory.  You'll have to run it from `~/.composer` and use absolute paths to any files and directories you want to test.  This will get old fast.

To use `phpcs` and `phpcbf` as global commands, symlink to them in `/usr/local/bin`:

```shell
$ sudo ln -s ~/.composer/vendor/bin/phpcs /usr/local/bin
$ sudo ln -s ~/.composer/vendor/bin/phpcbf /usr/local/bin
```

You should be able to run `phpcs -h` and `phpcbf -h` from anywhere now.

#### Install WordPress Coding Standards

Now install the WordPress ruleset for PHP CodeSniffer using their [instructions for Composer](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards#installation).

Essentially, this involves running:

```shell
# In the .composer directory:
$ composer create-project wp-coding-standards/wpcs --no-dev
```

Now we need to tell PHP CodeSniffer about the new rules.  If you're using the `phpcs` and `phpcbf` commands globally, you'll need to use the absolute path to the `wpcs` directory:
```shell
$ phpcs --config-set installed_paths ~/.composer/wpcs
```

Verify that the new rules have been added (you should see a bunch of WordPress standards in there now):
```shell
$ phpcs -i
```

#### Using PHP CodeSniffer

Gulp will automatically run PHP CodeSniffer when any PHP file changes by running the included `.sniff` bash script. This will run `phpcbf` and `phpcs` in sequence for the entire directory, using the custom ruleset and ignoring development files, much as you would if you were to run PHP CodeSniffer as described below.

If you want, you can always run `.sniff` on its own:

```shell
# In your project dir
$ ./.sniff
```

##### To use PHP CodeSniffer commands individually:

```shell
# Hop into your project dir
$ cd <project_dir>

# Test code with PHP CodeSniffer
$ phpcs  --ignore=node_modules,gulpfile.js,js/script.built.js --standard=WordPress some_file.php

# Automatically fix code with PHP Code Beautifier
$ phpcbf --ignore=node_modules,gulpfile.js,js/script.built.js --standard=WordPress some_file.php
```

Specifying the coding standard each time you run the test might get annoying.  To use the WordPress ruleset by default, run:

```shell
$ phpcs --config-set default_standard WordPress
```

To use the custom ruleset included in URI Modern, set the `--standard` arguement:

```shell
$ phpcs --standard=.codesniffer.ruleset.xml some_file.php
```

You can check out all the PHP CodeSniffer [config options](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Configuration-Options) on their [wiki](https://github.com/squizlabs/PHP_CodeSniffer/wiki).

### Git Model

Although you will be working in your own forked repository prior to sending any pull requests, it might be useful to know the development model used in the main URI Modern repository. URI Modern uses a Git model with two main branches, `master` and `develop`.  We'll explain it a bit here, but check out [this article](http://nvie.com/posts/a-successful-git-branching-model/ "A successful Git branching model") for a deeper dive.

#### Feature development

URI Modern uses `develop` as the default branch, which you may not be used to.  This ensures that any new branches are created from and merged back into `develop` by default, reducing the risk of inadvertently merging development code into production via a feature branch.

All development occurs off of the `develop` branch, with features and experimental modifications occuring on `feature-*` branches which are created from, and later merged back into, `develop`.

#### Release

When enough new features and changes have been amassed, a `release-#` branch is created from `develop`, where the version number is bumped and any final release preparations and bug fixes are made.  Changes to the `release-#` branch may be continuously merged back into `develop`.

When the release is ready, `release-#` is merged into `master` and tagged with the version number. `release-#` is also merged back into `develop` at this point, after which it can be deleted.

#### Hotfixes

If a serious bug emerges in production, it can be fixed in a `hotfix-#` branch created from `master`.  When the fix is complete, the version number is bumped and `hotfix-#` is merged into both `master` (with a new tag) and `develop`.

### Commit Messages

We don't have strict guidelines for writing commit messages.  However, we do ask that you follow a few simple rules.  Think of them more like best practices:

* __Use the imperative mood.__  For example, `"Limit paragraphs to 300 characters"`.  Commit messages should always be able to complete this sentense: _"If applied, this commit will..."_
* __Be as descriptive as possible.__  Don't write `"Fix a bug"`.  While someone might be able to look at what changed in the code, this type of commit message doesn't help anyone.
* __Include issue numbers if applicable.__  If your commit fixes an issue, mention that somewhere in your commit.  For example, if your commit fixes issue #16, include `fixes #16`.  This will automatically close that issue in GitHub when your commit is merged into the default branch.  Use any of these keywords to close an issue via a commit message: `close, closes, closed, fixes, fixed`

To learn more about writing good commit messages, check out [this article](https://chris.beams.io/posts/git-commit/).

## <a name="conduct"></a>Code of Conduct

URI Modern is open source.  We don't ask for much, so please be constructive and respectful in your contributions.  There isn't a specific Code of Conduct document for you to abide by, but there are some general norms when it comes to being part of a project like this.

Take a look at GitHub's [guide](https://opensource.guide/how-to-contribute/) to making open source contributions.  It's worth the read.

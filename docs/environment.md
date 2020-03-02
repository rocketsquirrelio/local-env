# Development Environment

## Requirements

| Software                             | Version           | Notes                                                                               |
|--------------------------------------|-------------------|-------------------------------------------------------------------------------------|
| [Ruby](https://www.ruby-lang.org/)   | v2.x or later     |                                                                                     |
| [Rake](https://github.com/ruby/rake) | v13.x or later    | A make-like task runner for Ruby. <br/><br/> `gem install rake`                     |
| [Node](https://nodejs.org/)          | v10.13.0 or later | Some CLI commands and included versioning options.                                  |
| [Composer](https://getcomposer.org)  | v1.9.3 or later   | On OSX, install with [Homebrew](https://brew.sh) <br/><br/> `brew install composer` |
| [ngrok](https://ngrok.com)           | v2.x or later     | *Optional*. <br/> Used for sharing `localhost` to a remote device.                  |

<!-- https://www.tablesgenerator.com/markdown_tables -->

## Running the Environment
### Spin Up the Environment
From the project root, run `rake local:up` to start the environment. This will install all dependencies from `composer` and `npm` as well as spin up the following environments.

| Environment URL                                                                                  | Description            |
|--------------------------------------------------------------------------------------------------|------------------------|
| [http://localhost](http://localhost)                                                             | WordPress Installation |
| [http://localhost:3000](http://localhost:3000)                                                   | Project Documentation  |
| [http://localhost:8025](http://localhost:8025)                                                   | Mailhog Mail Catcher   |
| [http://localhost:8080](http://localhost:8080)                                                   | phpMyAdmin             |
| [http://localhost:35729/livereload.js?snipver=1](http://localhost:35729/livereload.js?snipver=1) | LiveReload Server      |

<!-- https://www.tablesgenerator.com/markdown_tables -->

### Spin Down the Environment
From the project root, run `rake local:down` to turn off the environment from `localhost` and preserve any existing volumes for use later.

### Reset the Environment


.warning> This will **permanently delete** all database tables from the local environment.

It's best to run `rake local:database:backup` prior to destroying the environment. This will **permanently delete** all database tables. From the project root, run `rake local:destroy` to remove all volumes and container images associated with the environment. 

### Other Tasks
There are a few other tasks available for use (like importing a database backup). You can discover these by running `rake --tasks` from the project root.

### Connecting to the Database
It's easy to connect the database to a tool like [Sequel Pro](https://sequelpro.com). Use the following field and connection information.

| Field    | Value      |
|----------|------------|
| **Host**     | 127.0.0.1  |
| **Username** | wordpress  |
| **Password** | wordpress  |
| **Database** | wordpress  |
| **Port**     | 3306       |

## Environment Features

### Project Documentation
After starting the Docker environment, the `./docs` folder is served using [Docsify](https://docsify.js.org) and is located at `http://localhost:3000`.

### Mailhog
[Mailhog](https://github.com/mailhog/MailHog) is a catch-all email service that allows you to see all email being output from the local WordPress site.

### WP-CLI

[WP-CLI](https://wp-cli.org) is included as a part of this environment. You can access this through `npm run wp -- [command] [...args]`.

.info> When using a WP-CLI `scaffold` command that outputs via Stdout, be sure to append `--silent` after `npm run wp`.

### Live Reloading
This environment includes an open source version of a file watcher and reloading tool called LiveReload. It's [implemented in Node.js](https://github.com/napcs/node-livereload) and does not run when in an `ngrok` session.

### Tunneling via ngrok
[ngrok](https://ngrok.com) can be used to let others view this site from a non-local location.

A must-use plugin is included at `./ops/utils/ngrok.php` which uses [`ob_start()`](https://www.php.net/manual/en/function.ob-start.php) to replace all instances of the string `localhost` with `$_SERVER['HTTP_X_ORIGINAL_HOST']` whenever that header is set and differs from `localhost`.

.notice> Because this plugin rewrites all output during an ngrok sessions, editing content from the tunneled domain will result in editor errors.

## Third-party Plugins


### Default Plugins

| Plugin Name | Vendor | Description |
|:------------|:-------|:------------|
| [Redirection](https://redirection.me) | John Godley | Manage redirects and 404s. |
| [S3 Uploads](https://github.com/humanmade/S3-Uploads) | Human Made | Store uploads in S3 buckets. |

### Plugin Installation
Use composer and [WPackagist](https://wpackagist.org)! This treats plugins as dependencies of WordPress so that every time the environment is spinned up, it will always be running the same way. There are also other plugin providers that publish to the main composer package repository, [Packagist](https://packagist.org) (e.g. S3 Uploads).

```bash
composer require wpackagist-plugin/{wordpress.org-plugin-slug}
```

#### Automatic Plugin Activation during WordPress Install
All plugins in the `wp-content` plugins folder will be activated during the WordPress installation process. The `install.php` file will prevent the default content (post, comment, pages, taxonomies) from being inserted into the site. Specific plugins can be added to the `$do_not_activate` array in `wp-content/install.php`.

```php
$do_not_activate = array(
    'akismet/akismet.php',
    'hello.php',
);
```

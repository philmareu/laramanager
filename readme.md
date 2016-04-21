# LaraManager

LaraManager is a basic database interface for Laravel applications. It was created as a simple way for us to provide clients with a method for updating basic content.

## Support
I'm the only one supporting this package at the moment and bugs might exist. Issues and pull requests are welcome.

## Laravel 5.1
Currenting it is only available for Laravel 5.1.

## Installation
You can install this package with Composer.

```console
$ composer require philsquare/laramanager
```

You will need to add 2 providers to the ```config/app.php```

```
  'Philsquare\LaraManager\Providers\LaraManagerServiceProvider'
```

Publish the vendor assets and migrations

```console
$ php artisan vendor:publish
```

Then migrate the database
```console
$ php artisan migrate
```

You can then login at /admin with admin@admin.com and "password" as the email and password respectively

## Content Resourses
Resources are tables that contain website content. For example, a website might have a table called "events". In order to update the event data, you will need to setup a resource and add fields that map to the table.

### Fields
There are 12 fields avaiable.
* Checkbox
* Date
* Email
* Image (integer)
* Images
* Password
* Relational (integer)
* Select
* Slug
* Text
* Textarea
* WYSIWYG

These fields should match up with your existing database fields appropriately. Make sure to make these fields fillable in your Laravel Model.

## Objects
Objects allow you to provide users with a way to "build" content onto a resourse. There are 4 default objects.
* Text
* WYSIWYG
* Photo Gallery
* Embed

The display for these objects can be overloaded by adding your own in the `view/vendor/laramanager/objects/` folder. For example, by creating `view/vendor/laramanager/objects/text/display.blade.php` LaraManager will use this file to display instead of the default.

### Adding objects to resources
In order to be able to add objects to your resources, you will need add a trait to your Laravel Model.

```php
class Event extends Model {

use Philsquare\Laramanager\Database\Objectable;

}
```

### Creating custom objects
Docs to come...

## Feeds
LaraManager can create custom RSS feeds for your resources such as www.my-site.com/feed/events. Before adding the feed you will need to use the interface `Philsquare\LaraManager\Contracts\RssFeedInterface` on your model and impliment the contract methods.

## Customizing Admin Panel
You can use all your own routes, controllers, models, etc and just use LaraManager as an admin interface. Just load the layout in your blade file.

```blade
@extends('laramanager::default')
```

## License
LaraManager is licensed under the [MIT License](http://opensource.org/licenses/MIT).
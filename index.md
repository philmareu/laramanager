LaraManager is a basic database interface for Laravel applications. It was created as a simple way for us to provide clients with a method for updating basic content.

![LaraManager Screenshot](http://philmareu.com/uploads/laramanager-screenshot.jpg)

## Support
I'm the only one supporting this package at the moment and bugs might exist. Issues and pull requests are welcome. Currently, LaraManager is available for Laravel 5.1 (v0.6.x), 5.3 (v1.0.x) & 5.4 (v1.1.x). Please check the [releases page](https://github.com/philsquare/LaraManager/releases) for updates and change log.

## Introduction
LaraManager started out as a super simple admin panel for some of my basic Laravel website projects. However, I just couldn't stop tinkering and now it does a bit more. All I needed was a way for clients and myself to interact with basic customizable content resources such as events, posts and pages. It was never created to be a stand alone build-your-own-website CMS type product. For that, I would recommend PyroCMS. Instead, it provides some basic admin boiler plate such as auth, crud actions and panel.

## Installation
You can install this package with Composer.

```console
$ composer require philsquare/laramanager
```

You will need to add the following provider to ```config/app.php```

```
'Philsquare\LaraManager\Providers\LaraManagerServiceProvider'
```

In order to record exceptions the following will need to be added in the ```report()``` method in ```App/Exceptions/Handler.php```

```
new Philsquare\LaraManager\Logging\ExceptionLogging($e);
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

## Admin Panel
The admin panel consists of the side navigation, top bar and content area. The side navigation has a few topic areas with some default links. These topic areas are reporting, resources, uploads and system.
### Dashboard
The dashboard is basically a blank canvas. It is used as the main landing page and can be customized per project.
### Errors
This section lists any exceptions and groups them by count. The list can easily for sorted as to find 404s or any other exception.
### Images
This image manager will contain all images uploaded to LaraManager. These images can then be accessed and used by resources and fields.
### Settings
Not much to see here yet. Basically just set your site name.
### Resources
Create resources such as Posts, Locations and Events.
### Objects
Objects are generally used to provide design and content flexibility.
### Feeds
Easily create an RSS feed for any of your resources
### Redirects
Create 301 or 302 redirects
### Users
Basic user management

## Adding a Resource
Resources are items such as Events, Pages and Posts. They map up to your tables to help handle the CRUD actions. Since LaraManager is built as just an "interface" to your existing Laravel application, you will need to have these tables created and an Eloquent Model defined.

You will be adding fields to the resource that will match up to your columns. Make sure you add these fields to your `$fillable` array.

## Fields
There are 12 fields that can be assigned to any resource. Make sure these fields map up to appropriate column types (i.e. email as `VARCHAR`, date as `DATE`, etc).

### Checkbox
`TINYINT(1)` - Checkbox with a value of 1 or 0
### Date
`DATE` - Date picker
### Email
`VARCHAR` - Text field
### Image
`INT` - Displays the image browser. This fields requires a relational method added to the `Model`. For example, adding a "Featured Image" to `Event`.
```
public function featuredImage()
{
    return $this->belongsTo('Philsquare\LaraManager\Models\Image');
}
```

### Images
This field is similar to Image but allows for selection and reordering of multiple images. This field requires a pivot table such as `event_image` and a method added to the `Model`. For example, adding a "Gallery" to `Event`.
```
public function gallery()
{
    return $this->belongsToMany('Philsquare\LaraManager\Models\Image')->orderBy('ordinal', 'asc');
}
```

The `orderBy('ordinal', 'asc')` is required to order the images correctly. **Make sure your pivot table contains an ordinal column**

### Password
`VARCHAR` - Password field
### Relational
`INT` - This field will display a dropdown with options from the related (lookup) table. This field required a relational method added to the `Model`. For example, adding `User` to `Event`.
```
public function user()
{
    return $this->belongsTo('App\Models\User');
}
```
In this example, the dropdown will have a list of all the users.

### Select
`ENUM` - Basic select field that is populated with a defined static list of options.
### Slug
`VARCHAR` - Text field that auto-creates a slug from a targeted field.
### Text
Basic text field
### Textarea
Basic textarea field
### WYSIWYG
`TEXT` - A ckeditor instance
### HTML
`TEXT` - A HTML editor that also supports markdown

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
Once you have added this trait to your model, you can then add objects to your resources entities.

### Rendering objects views
You can easily render the objects views for your entities by using the `@each` directive. Make sure you pass the objects to the view. For example, if you had a resource "Events" then you more than likely would use this on your event show page.
```blade
@each('laramanager::objects.render', $event->objects, 'object')
```

### Creating custom objects
You can easily make objects. The most basic object needs 2 files, a `display.blade.php` and `fields.blade.php`. Optionally, you can add a `scripts.blade.php`. These files should be located in `resources/views/vendor/laramanager/objects/<your-custom-object-name>`. After you create the object, you will need to add it in the "Objects" section in LaraManager.

#### fields.blade.php
The *fields* file can contain HTML form fields to receive input. These inputs should have names in the `data` array (e.x. `<input type="text" name="data[introduction]">`). The `data` array is serialized and saved.

If you want to access the image browser, you can use the use the special object fields "Image" and "Images" using an include (Note that these are different than the resource fields). For example if you need to add a field that will allow users/clients to select one image, add the following.

```blade
@include('laramanager::objects.fields.image', ['name' => 'file_id', 'label' => 'Photo'])
```

...or select multiple images.

```
@include('laramanager::objects.fields.images', ['name' => 'file_ids', 'label' => 'Photos'])
```

#### display.blade.php
The *display* file will receive an `$object` variable that will contain the input data. The data can be accessed using the `data()` method (e.x. `$object->data('introduction')`).

If you are using the "Image" or "Images" object fields, you can access the image(s) using either `$object->file('file_id')` or `$object->files('file_ids')`.

Be careful about the type of input your are acquiring. There is no validation and all the data is just serialized and stored in a `TEXT` field. I'm sure there are limitations and security issues. However, these objects are meant for display purposes only. I do not recommend receiving any form input data from the public side using objects. In other words, no forms in the display.blade.php view.

#### scripts.blade.php
Use this if your object needs JS or other assets loaded on the object form page.

## Feeds
LaraManager can create custom RSS feeds for your resources such as www.my-site.com/feed/events. Before adding the feed you will need to use the interface `Philsquare\LaraManager\Contracts\RssFeedInterface` on your model and impliment the contract methods.

## Customizing Admin Panel
You can use all your own routes, controllers, models, etc and just use LaraManager as an admin interface. Just load the layout in your blade file.

```blade
@extends('laramanager::default')
```

## License
LaraManager is licensed under the [MIT License](http://opensource.org/licenses/MIT).

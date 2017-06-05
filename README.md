<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center"> <b>View & Action Helpers</b> </p>

<p align="center">
<a href="https://cubes.rs/"><img src="https://badge.fury.io/gh/unckleg%2Flaravel-helpers.svg" alt="Version"></a>
<a href="https://mit-license.org/"><img src="http://img.shields.io/badge/license-MIT-ff69b4.svg?style=flat-square" alt="License"></a>
</p>

<hr>

*Laravel helpers package lets you use and create custom view/action helpers.*

## Installation
Pull package:
```php
composer require unckleg/laravel-helpers
```
Register service provider in config/app
```php
...
Unckleg\Helpers\HelpersServiceProvider::class,
```

## Example
Create app/Helpers directory or run command:
```php
php artisan make:helper Hello --type=View
```
* Hello   - Name of View Helper
* type    - View or Action

Command will create directory and Helper for you.

- Helper
```php
<?php

namespace App\Helpers;

class Test
{
    /**
     *
     * Blade calling: @test::helloWorld()
     *
     * @return string
     */
    public function helloWorld()
    {
        return 'Hello world';
    }

    /**
     *
     * Blade calling: @test::helloTo(array $people)
     *
     * @param  array  $people
     * @return string
     */
    public function helloTo(array $people)
    {
        return implode(', ', $people);
    }
    
    /**
     * 
     * Blade calling: @test::navigation()
     *
     * @return string   
     */
    public static function navigation() 
    { 
        $pages = App\Page::all();    
    ?>
        
        <div class="navigation">
            <ul> 
                @foreach($pages as $page)
                    <li> 
                        <a href="{{ Url::slugify(app()->baseUrl($page->title)) }}"> 
                            {{ $page->title }} 
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    <?php }
}
```
- In blade 
```blade 
@test:helloWorld()
// outputs: Hello world

@test::helloTo(['One', 'Two', 'Three', 'Four', 'Five'])
// outputs: One, Two, Three, Four, Five

@test::navigation()
// outputs: This will output whole html provided in navigation method
```

#### Built-in helpers
- <a>@javascripts()  &nbsp;@includeJs() &nbsp;&nbsp;&nbsp;@endjavascripts()</a>
- <a>@stylesheets()  @includeCss() @endstylesheets()</a>
- <a>@routeName() </a>

## Notes
If you experience permission error while using commands make sure you grant permissions
for Helpers directory.

**_Toccata_** is a **_PHP_** MVC framework intended mostly for practice and learning. It's kind of like a playground were I can try new ideas, practice some coding, test different patterns, etc. Maybe in the future I could expand it a little bit and add some way of teaching through it, or even it could be used in some app as a real framework, but for the moment it's just that, a playground.

The explanation for the name is simple: **_Toccata_** is never going to be as good nor as big as **_Symfony_**.

> **Notice**: This framework uses features of **_PHP 7_**, so it's not made to support older versions.

Features
======

Router
------

You can create simple routes (no regex at the moment) by filling the config file _routes.json_ in the project root.

The route format is:

```JSON
"route": ["NameOfController", "NameOfMethod"]
```

The default method is `index`, so the following is a valid routes.json file:

```JSON
{
  "/": ["MainController"],
  "/testPage": ["MainController", "test"]
}
```

The router will try to find the `route` among the JSON keys and, if found, try to call the `method` (defined in "NameOfMethod", or `index` as default) from the `controller` (defined in "NameOfController"). If any of these actions fails, a simple 404 page will be shown and a **warning** will be written in the _warnings log_.

Controllers
------

If the `Router` path resolution works, it will be calling a method in a `Controller` defined by you. For the moment, Controllers are simple clases that extend from the base class `Controller`, like so:

```PHP
class MainController extends Controller {
}
```

You should define some methods also, which will be called by the `Router`:

```PHP
class MainController extends Controller {
  public function index() {
    echo "Index";
  }

  public function test() {
    echo "Test!";
  }
}
```

Anything you print on the controller's methods will be printed on the page, but to do things the right way you should probably use...

Renderers
-------

At the moment of writing this README, the base class `Renderer` just has a simple method called, well... `Render`. It takes an array with options as the only argument, and each Renderer that extends from the base class can use this options as they please. I know, not extremely useful, but it's enough for me as a start.

There are two simple `Renderers` shipped with **_Toccata_**:
- `PlainRenderer` is mostly for testing purposes, but in the future it will probably be aimed to be a PHP-based renderer, without any kind of template language.
- `JSONRenderer` is what you've already guessed, and if you haven't, well... think harder, it'll come to you.

I'm thinking about adding support for other template languages (like **_Twig_** or **_Mustache_**), but the main idea is to write the `Renderer` base class so anyone would be able to add their own template/renderer.

Models
------

This is still a WIP, nothing to see here, move along!

Security
------

It has NONE!

I mean, at least for the moment. But I will surely add some code related to this in the future, so stay tuned!

Collaborating
======

Are you sure that you want to collaborate with **THIS**? Well, it's your time! Don't hesitate to contact me at paulmdorr.me/contact if you have suggestions or questions. Also, feel free to create a _new issue_ or make a _pull request_!
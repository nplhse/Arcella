Contributing to Arcella
============================

Any contribution to Arcella is appreciated, whether it is related to fixing bugs, suggestions or improvements. Feel free to take your part in the development of Arcella!

However you should follow these simple guidelines for your contribution to be properly recived:

* Arcella uses the [GitFlow branching model](http://nvie.com/posts/a-successful-git-branching-model/) for the process from development to release. 
* Because of GitFlow contributions can only be accepted via pull requests on [Github](https://github.com/nplhse/arcella).
* Please keep in mind, that Arcella follows [SemVer v2.0.0](http://semver.org/).
* Also you should make sure to follow the [PHP Standards Recommendations](http://www.php-fig.org/psr/) and the [Symfony best practices](http://symfony.com/doc/current/best_practices/index.html).

## How to contribute?

To make a long story short you should at first fork and install Arcella from this repo. Now you make sure all the tests pass. Make your changes to the code and add tests for your changes. If all the tests pass push to your fork and submit a pull request to the `development` branch.

* **Add tests** - None of your code will be accepted if it doesn't have proper tests.
* **Stick to the standards** - Make sure to follow the [Symfony coding standards](http://symfony.com/doc/current/contributing/code/standards.html).
* **Document any change in behaviour** - Make sure the [Readme](README.md) and any other relevant documentation are kept up-to-date.
* **Create feature branches** - Don't ever make a pull request from your master branch.
* **One pull request per feature** - If you want to contribute more than one thing, please send multiple pull requests.
* **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## Common tasks

### Run the Tests

As Arcella uses [PHPUnit](https://phpunit.de/) for testing it's quite easy to run the tests. Just navigate to the project folder, e.g. `~/webroot/arcella` and run PHPUnit.

    $ cd ~/webroot/arcella
    $ vendor/bin/phpunit

### Validate the Code

To make sure that our code does not violate the [Symfony coding standards](http://symfony.com/doc/current/contributing/code/standards.html) we're using [EasyCodingStandard](https://github.com/Symplify/EasyCodingStandard) that automatically detects violations to these coding standards and can fix a lot of them like magic.

    $ cd ~/webroot/arcella
    $ vendor/bin/ecs check src  

FlyFinder
================================================================================================================

FlyFinder is a plugin for [Flysystem](http://flysystem.thephpleague.com/) that will enable you to find files
based on certain criteria.

FlyFinder can search for files and directories that are hidden, that have a certain extension or that exist in a
certain path.

## Installation

The easiest way to install this library is with [Composer](https://getcomposer.org) using the following command:

    $ composer require phpdocumentor/flyfinder

## Examples

Ready to dive in and don't want to read through all that text below? Just consult the [examples](examples) folder and
check which type of action that your want to accomplish.

## Usage

In order to use the FlyFinder plugin you first need a Flyfinder filesystem with an adapter,
for instance the local adapter.

    use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter;
    use Flyfinder\Finder;

    $filesystem = new Filesystem(new Adapter\Local(__DIR__.'/path/to/files/'));

Now you can add the plugin as follows:

    $filesystem->addPlugin(new Finder());

FlyFinder will need specifications to know what to look for. The following specifications are available:

- IsHidden (this specification will return `true` when a file or directory is hidden,
- HasExtension (this specification will return `true` when a file or directory has the specified extension),
- InPath (this specification will return `true` when a file is in the given path. Wildcards are allowed.)

Specifications can be instantiated as follows:

    use Flyfinder\Path;
    use Flyfinder\Specification\IsHidden;
    use Flyfinder\Specification\HasExtension;
    use Flyfinder\Specification\InPath;

    $isHidden = new IsHidden();
    $hasExtension = new HasExtension(['txt']);
    $inPath = new InPath(new Path('mydir'));

### Combining specifications

You can search on more criteria by combining the specifications. Specifications can be chained as follows:

`$isHidden->andSpecification($hasExtension)` will find all files and directories that are hidden AND have the given
extension.

`$isHidden->orSpecification($hasExtension)` will find all files and directories that are hidden OR have the given
extension.

`$isHidden->notSpecification` will find all files and directories that are NOT hidden.

You can also make longer chains like this:

` $specification = $inPath->andSpecification($hasExtension)->andSpecification($isHidden->notSpecification());`

This will find all files in the given path, that have the given extension and are not hidden.

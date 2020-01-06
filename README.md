# Arr - Array Utilities for PHP

- [ArrayDot](#arraydot)
- [ArrayStack](#arraystack)

<a name="arraydot"></a>
## ArrayDot
ArrayDot provides an easy access to arrays of data with dot notation in a lightweight and fast way. Inspired by Laravel Collection.

ArrayDot implements PHP's ArrayAccess interface and ArrayDot object can also be used the same way as normal arrays with additional dot notation.

### Examples

With ArrayDot you can change this regular array syntax:

```php
$array['info']['home']['address'] = 'Kings Square';

echo $array['info']['home']['address'];

// Kings Square
```

to this (ArrayDot object):

```php
$dot->set('info.home.address', 'Kings Square');

echo $dot->get('info.home.address');
```

or even this (ArrayAccess):

```php
$dot['info.home.address'] = 'Kings Square';

echo $dot['info.home.address'];
```

## Install

Install the latest version using [Composer](https://getcomposer.org/):

```
$ composer require vayes/arr
```

Not available via composer yet.

## Usage

Create a new ArrayDot object:

```php
$dot = new Vayes\Arr\ArrayDot;

// With existing array
$dot = new Vayes\Arr\ArrayDot($array);
```

## Methods

ArrayDot has the following methods:

- [add()](#add)
- [all()](#all)
- [clear()](#clear)
- [count()](#count)
- [delete()](#delete)
- [flatten()](#flatten)
- [get()](#get)
- [has()](#has)
- [isEmpty()](#isempty)
- [merge()](#merge)
- [mergeRecursive()](#mergerecursive)
- [mergeRecursiveDistinct()](#mergerecursivedistinct)
- [pull()](#pull)
- [push()](#push)
- [replace()](#replace)
- [set()](#set)
- [setArray()](#setarray)
- [setReference()](#setreference)
- [toJson()](#tojson)

<a name="add"></a>
### add()

Sets a given key / value pair if the key doesn't exist already:
```php
$dot->add('user.name', 'John');

// Equivalent vanilla PHP
if (!isset($array['user']['name'])) {
    $array['user']['name'] = 'John';
}
```

Multiple key / value pairs:
```php
$dot->add([
    'user.name' => 'John',
    'page.title' => 'Home'
]);
```

<a name="all"></a>
### all()

Returns all the stored items as an array:
```php
$values = $dot->all();
```

<a name="clear"></a>
### clear()

Deletes the contents of a given key (sets an empty array):
```php
$dot->clear('user.settings');

// Equivalent vanilla PHP
$array['user']['settings'] = [];
```

Multiple keys:
```php
$dot->clear(['user.settings', 'app.config']);
```

All the stored items:
```php
$dot->clear();

// Equivalent vanilla PHP
$array = [];
```

<a name="count"></a>
### count()

Returns the number of items in a given key:
```php
$dot->count('user.siblings');
```

Items in the root of ArrayDot object:
```php
$dot->count();

// Or use coun() function as ArrayDot implements Countable
count($dot);
```

<a name="delete"></a>
### delete()

Deletes the given key:
```php
$dot->delete('user.name');

// ArrayAccess
unset($dot['user.name']);

// Equivalent vanilla PHP
unset($array['user']['name']);
```

Multiple keys:
```php
$dot->delete([
    'user.name',
    'page.title'
]);
```

<a name="flatten"></a>
### flatten()

Returns a flattened array with the keys delimited by a given character (default "."):
```php
$flatten = $dot->flatten();
```

<a name="get"></a>
### get()

Returns the value of a given key:
```php
echo $dot->get('user.name');

// ArrayAccess
echo $dot['user.name'];

// Equivalent vanilla PHP < 7.0
echo isset($array['user']['name']) ? $array['user']['name'] : null;

// Equivalent vanilla PHP >= 7.0
echo $array['user']['name'] ?? null;
```

Returns a given default value, if the given key doesn't exist:
```php
echo $dot->get('user.name', 'some default value');
```

<a name="has"></a>
### has()

Checks if a given key exists (returns boolean true or false):
```php
$dot->has('user.name');

// ArrayAccess
isset($dot['user.name']);
```

Multiple keys:
```php
$dot->has([
    'user.name',
    'page.title'
]);
```

<a name="isempty"></a>
### isEmpty()

Checks if a given key is empty (returns boolean true or false):
```php
$dot->isEmpty('user.name');

// ArrayAccess
empty($dot['user.name']);

// Equivalent vanilla PHP
empty($array['user']['name']);
```

Multiple keys:
```php
$dot->isEmpty([
    'user.name',
    'page.title'
]);
```

Checks the whole ArrayDot object:
```php
$dot->isEmpty();
```

<a name="merge"></a>
### merge()

Merges a given array or another ArrayDot object:
```php
$dot->merge($array);

// Equivalent vanilla PHP
array_merge($originalArray, $array);
```

Merges a given array or another ArrayDot object with the given key:
```php
$dot->merge('user', $array);

// Equivalent vanilla PHP
array_merge($originalArray['user'], $array);
```

<a name="mergerecursive"></a>
### mergeRecursive()

Recursively merges a given array or another ArrayDot object:
```php
$dot->mergeRecursive($array);

// Equivalent vanilla PHP
array_merge_recursive($originalArray, $array);
```

Recursively merges a given array or another ArrayDot object with the given key:
```php
$dot->mergeRecursive('user', $array);

// Equivalent vanilla PHP
array_merge_recursive($originalArray['user'], $array);
```

<a name="mergerecursivedistinct"></a>
### mergeRecursiveDistinct()

Recursively merges a given array or another ArrayDot object. Duplicate keys overwrite the value in the
original array (unlike [mergeRecursiveDistinct()](#mergerecursivedistinct), where duplicate keys are transformed
into arrays with multiple values):
```php
$dot->mergeRecursiveDistinct($array);
```

Recursively merges a given array or another ArrayDot object with the given key. Duplicate keys overwrite the value in the
original array.
```php
$dot->mergeRecursiveDistinct('user', $array);
```

<a name="pull"></a>
### pull()

Returns the value of a given key and deletes the key:
```php
echo $dot->pull('user.name');

// Equivalent vanilla PHP < 7.0
echo isset($array['user']['name']) ? $array['user']['name'] : null;
unset($array['user']['name']);

// Equivalent vanilla PHP >= 7.0
echo $array['user']['name'] ?? null;
unset($array['user']['name']);
```

Returns a given default value, if the given key doesn't exist:
```php
echo $dot->pull('user.name', 'some default value');
```

Returns all the stored items as an array and clears the ArrayDot object:
```php
$items = $dot->pull();
```

<a name="push"></a>
### push()

Pushes a given value to the end of the array in a given key:
```php
$dot->push('users', 'John');

// Equivalent vanilla PHP
$array['users'][] = 'John';
```

Pushes a given value to the end of the array:
```php
$dot->push('John');

// Equivalent vanilla PHP
$array[] = 'John';
```

<a name="replace"></a>
### replace()

Replaces the values with values having the same keys in the given array or ArrayDot object:
```php
$dot->replace($array);

// Equivalent vanilla PHP
array_replace($originalArray, $array);
```

Replaces the values with values having the same keys in the given array or ArrayDot object with the given key:
```php
$dot->merge('user', $array);

// Equivalent vanilla PHP
array_replace($originalArray['user'], $array);
```
`replace()` is not recursive.

<a name="set"></a>
### set()

Sets a given key / value pair:
```php
$dot->set('user.name', 'John');

// ArrayAccess
$dot['user.name'] = 'John';

// Equivalent vanilla PHP
$array['user']['name'] = 'John';
```

Multiple key / value pairs:
```php
$dot->set([
    'user.name' => 'John',
    'page.title'     => 'Home'
]);
```

<a name="setarray"></a>
### setArray()

Replaces all items in ArrayDot object with a given array:
```php
$dot->setArray($array);
```

<a name="setreference"></a>
### setReference()

Replaces all items in ArrayDot object with a given array as a reference and all future changes to ArrayDot will be made directly to the original array:
```php
$dot->setReference($array);
```

<a name="tojson"></a>
### toJson()

Returns the value of a given key as JSON:
```php
echo $dot->toJson('user');
```

Returns all the stored items as JSON:
```php
echo $dot->toJson();
```

<a name="arraystack"></a>
## ArrayStack

Usage: 

```php
$stack = new ArrayStack($array);
```

Now you have access to:

```php
# Now you have access to:
public function getData(): array
public function getMeta(): ArrayMeta
public function loop(\Closure $closure)
```

If you call `getMeta()`, then you have access to:

```php
public function getCount(): int
public function getFirstIndex(): int
public function getFirstKey()
public function getFirstValue()
public function getLastIndex(): int
public function getLastKey()
public function getLastValue()
public function offsetSet($offset, $value)
public function offsetExists($offset)
public function offsetUnset($offset)
public function offsetGet($offset)
```

## License

[MIT license](LICENSE.md)

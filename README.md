# TimeNormalize
A basic validator and filter for time input.

[![Build Status](https://travis-ci.org/dillchuk/TimeNormalize.svg?branch=master)](https://travis-ci.org/dillchuk/TimeNormalize)

## Installation

Install with `composer require illchuk/time-normalize`.

You may install in your ZendFramework app by adding to your `modules.config.php` the following:
~~~
return [..., 'TimeNormalize' ,...]; // validator and filter both called 'Time'
~~~

Or use in a direct fashion:
~~~
use TimeNormalize\Validator\Time as TimeValidator;
use TimeNormalize\Filter\Time as TimeFilter;

$validator = new TimeValidator;
echo $validator->isValid('12:34am'); // true
echo $validator->isValid('12:34jm'); // false

$filter = new TimeFilter;
echo $filter->filter('12:34 am'); // '00:34'
echo $filter->filter('12:34 pm'); // '12:34'
echo $filter->filter('junk'); // 'junk'
~~~

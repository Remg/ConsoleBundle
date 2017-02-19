ConsoleBundle
-------------

A bundle to help writing commands with a lots of interactions that requires a lot of logics.

### Introduction
The goal of this bundle is, like the Form types in the Form Component, to define Question types with a given context for each question.

### Usage:

* install the bundle with composer 
 composer require remg/console-bundle dev-master
* define your Style class, that must extend ConsoleStyle
* create a style instance and set the QuestionFactory to it
* build your questions like you build your forms!

You can even define your questions as services, by tagging them with the "question.type" tag. (just very like the Form component).

# What is this project for?

I have created this project to demonstrate some principles and patterns at one of our internal workshops at Yahoo!7.

# Intro

Refactoring is a difficult task, i thought it would be a good idea to go through some examples of how can you
refactor a monolythic script following some design principles like S.O.L.I.D and using some of the most popular
design patterns.

# Dependency Injection

Almost every class here uses dependency injection as it is one of the most fundamental principles.

# Coding to contract

All the classes depend on interfaces. This way implementations can be swapped out at any time.

# Running tests

Execute ant composer target to download all pre-requisites:

    ant setup

Then run phpunit tests by running:

    ant phpunit

# Contributors

* Artur Esjmont (https://github.com/ejsmont-artur) (http://artur.ejsmont.org/blog/)

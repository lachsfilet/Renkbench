[![Build Status](https://dev.azure.com/janrenken/Renkbench/_apis/build/status/lachsfilet.Renkbench?branchName=master)](https://dev.azure.com/janrenken/Renkbench/_build/latest?definitionId=1&branchName=master)
[![Release Status](https://vsrm.dev.azure.com/janrenken/_apis/public/Release/badge/efce0c4b-a0fc-45d4-b52e-d8852f6bf714/2/3)](https://vsrm.dev.azure.com/janrenken/_apis/public/Release/badge/efce0c4b-a0fc-45d4-b52e-d8852f6bf714/2/3)
[![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](https://github.com/lachsfilet/Renkbench/blob/master/LICENSE)

# Renkbench
A Javascript Amiga Workbench 1.3.3 look and feel clone.

## Goal
For getting some Javascript practice, in the year 2009 I created an [Amiga Workbench](https://en.wikipedia.org/wiki/Workbench_(AmigaOS)#Workbench_1.x) clone and hosted it on [Lachsfilet.de](http://www.lachsfilet.de/).
Since not all look and feel features of the orginal Workbench were implemented, in December of 2018 I started to refactor the code and added some missing features.

In the meantime I put the whole page into a [Docker](https://www.docker.com/) container to simplify the deployment process.

## Frontend features
Currently, the Workbench clone contains the following features:

* Drag and drop functionality for icons and windows
* Topaz style font
* Original window behavior with resizing and scrolling
* Window to the front and to the back buttons
* Closing of windows
* Directories displayed as drawers
* Context menu in the main title bar triggered by mouse right click
* Touch events for handheld usage
* Customized keyboard input using Topaz font

## To-do
* Bugfixing
* Content
* Introduce applications
* Further refactoring
* Continue splitting frontend code into multiple files
* Put the workbench.json data into the NoSQL database [CouchDB](https://couchdb.apache.org/) in an own container
* Setup for setup and running Renkbench and database

## Backend
The Node.js backend currently delivers the menu and windows tree as JSON. It has now success on the Couch DB container. The next task here is to migrate the content of the static workbench.json file into the database and change the whole data success and its application integration.

## Docker
The system is setup with [Docker Compose](https://docs.docker.com/compose/), consisting of two containers:

* The renkbench app
* The CouchDB instance

Putting the application into a Docker image enhanced the delivery process and brought the advantage to run it locally without setting up a Node.js deamon. For CI build and release I added the Azure DevOps pipelines as YAML code.

## Unit tests
I started with unit testing using [Jasmine](https://github.com/jasmine/jasmine), [jasmine-es6](https://github.com/vinsonchuong/jasmine-es6) and [window](https://github.com/lukechilds/window), after I cut the createNode builder out of the monolith.

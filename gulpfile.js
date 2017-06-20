var	requireDir	= require('require-dir');

/* Require all tasks in gulp/tasks; include subdirectories */

requireDir('./gulp/tasks', { recurse: true});
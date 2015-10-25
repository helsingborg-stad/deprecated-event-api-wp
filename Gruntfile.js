'use strict';
module.exports = function(grunt) {

	var username = process.env.USER || process.env.USERNAME;

	grunt.initConfig({
		rsync: {
			options: {
				args: ["--verbose"],
				exclude: ['wp-config.php', 'package.json','Gruntfile.js','composer.json', 'wordpress-rules.xml', '.git*', 'node_modules', '.sass-cache', 'Gruntfile.js', 'package.json', '.DS_Store', 'README.md', 'config.rb', '.jshintrc'],
				recursive: true
			},
			stage: {
				options: {
					src: "./",
					dest: "/var/www/event-api-wp/",
					host: "root@37.18.209.106",
					delete: false
				}
			}
		}
	});

	// Load tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// deploy reruns minification and concatenation before rsyncing the files
	// deploy:stage and deploy:prod are supported
	grunt.registerTask('deploy', 'deploy code to stage or prod', function(target) {
		if (target == null) {
			return grunt.warn('Build target must be specified, like deploy:stage.');
		}
		grunt.task.run('rsync:' + target);
	});
	// Register tasks
	grunt.registerTask('default', [
		'deploy:stage',
	]);

	grunt.registerTask('test', [
		'phpcs'
	]);

};

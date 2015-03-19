module.exports = function(grunt) {
	'use strict';

	var configBridge = grunt.file.readJSON('./grunt/configBridge.json', { encoding: 'utf8' });
	var generateCommonJSModule = require('./grunt/commonjs-generator.js');

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),
		banner: '/*!\n' +
		' * <%= pkg.name %> v<%= pkg.version %> (<%= pkg.homepage %>)\n' +
		' * Copyright 2014-<%= grunt.template.today("yyyy") %> <%= pkg.author %>\n' +
		' * Licensed under <%= pkg.license.type %> (<%= pkg.license.url %>)\n' +
		' */\n',
		jqueryCheck: configBridge.config.jqueryCheck.join('\n'),
		jqueryVersionCheck: configBridge.config.jqueryVersionCheck.join('\n'),

		clean: {
			css: './css',
			js: './js'
		},

		concat: {
			options: {
				//banner: '<%= banner %>\n<%= jqueryCheck %>\n<%= jqueryVersionCheck %>',
				banner: '<%= banner %>\n',
				stripBanners: false
			},
			theme: {
				src: [
					'./bower_components/jquery/dist/jquery.js',
					'./bower_components/bootstrap/js/transition.js',
					'./bower_components/bootstrap/js/alert.js',
					'./bower_components/bootstrap/js/button.js',
					'./bower_components/bootstrap/js/carousel.js',
					'./bower_components/bootstrap/js/collapse.js',
					'./bower_components/bootstrap/js/dropdown.js',
					'./bower_components/bootstrap/js/modal.js',
					'./bower_components/bootstrap/js/tooltip.js',
					'./bower_components/bootstrap/js/popover.js',
					'./bower_components/bootstrap/js/scrollspy.js',
					'./bower_components/bootstrap/js/tab.js',
					'./bower_components/bootstrap/js/affix.js',
					'./assets/js/script.js'
				],
				dest: './js/<%= pkg.name %>.js'
			}
		},

		uglify: {
			options: {
				preserveComments: 'some'
			},
			core: {
				src: '<%= concat.theme.dest %>',
				dest: './js/<%= pkg.name %>.min.js'
			}
		},

		less: {
			compileCore: {
				options: {
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: '<%= pkg.name %>.css.map',
					sourceMapFilename: './css/<%= pkg.name %>.css.map'
				},
				src: './assets/less/import.less',
				dest: './css/<%= pkg.name %>.css'
			}
		},

		autoprefixer: {
			options: {
				browsers: configBridge.config.autoprefixerBrowsers
			},
			core: {
				options: {
					map: true
				},
				src: './css/<%= pkg.name %>.css'
			}
		},

		csslint: {
			options: {
				csslintrc: './assets/less/.csslintrc'
			},
			dist: [
				'./css/<%= pkg.name %>.css'
			]
		},

		cssmin: {
			options: {
				compatibility: 'ie8',
				keepSpecialComments: '*',
				advanced: false
			},
			minifyCore: {
				src: './css/<%= pkg.name %>.css',
				dest: './css/<%= pkg.name %>.min.css'
			}
		},

		usebanner: {
			options: {
				position: 'top',
				banner: '<%= banner %>'
			},
			files: {
				src: './css/*.css'
			}
		},

		csscomb: {
			options: {
				config: './assets/less/.csscomb.json'
			},
			dist: {
				expand: true,
				cwd: './css/',
				src: ['*.css', '!*.min.css'],
				dest: './css/'
			}
		},

		copy: {
			bootstrapfonts: {
				expand: true,
				cwd: './bower_components/bootstrap/',
				src: 'fonts/*',
				dest: './css/',
				filter: 'isFile'
			},
			fontawesomefonts: {
				expand: true,
				cwd: './bower_components/fontawesome/',
				src: 'fonts/*',
				dest: './css/',
				filter: 'isFile'
			},
			html5shiv: {
				files: [
					{
						expand: true,
						flatten: true,
						src: ["./bower_components/html5shiv/dist/html5shiv.min.js"],
						dest: "js"
					},
				]
			},
			respond: {
				files: [
					{
						expand: true,
						flatten: true,
						src: ["./bower_components/respond/dest/respond.min.js"],
						dest: "js"
					},
				]
			},
			bootstrapvariables: {
				files: [
					{
						expand: true,
						flatten: true,
						src: ["./bower_components/bootstrap/less/variables.less"],
						dest: "assets/less/custombootstrap"
					},
				]
			},
			fontawesomevariables: {
				files: [
					{
						expand: true,
						flatten: true,
						src: ["./bower_components/fontawesome/less/variables.less"],
						dest: "assets/less/customfontawesome"
					},
				]
			}

		},

		browserSync: {
			default_options: {
				bsFiles: {
					src: [
						"./assets/less/**/*.less",
						"./assets/js/**/*.js",
						"*.html"
					]
				},
				options: {
					proxy:"localhost",
					ghostMode: false,
					port: 3000,
					open: false,
					watchTask: true,
					reloadDelay: 2000
				}
			}
		},

		watch: {
			less: {
				files: "./assets/less/**/*.less",
				tasks: ["less:compileCore"]
			},
			js: {
				files: "./assets/js/**/*.js",
				tasks: ["concat"]
			}
		}
	});

	// These plugins provide necessary tasks.
	require('load-grunt-tasks')(grunt, { scope: 'devDependencies' });
	require('time-grunt')(grunt);

	// CSS distribution task.
	grunt.registerTask('create-css', ['less:compileCore', 'autoprefixer:core', 'usebanner', 'csscomb:dist', 'cssmin:minifyCore']);

	// JS distribution task.
	grunt.registerTask('create-js', ['concat', 'uglify:core', 'commonjs']);

	// Default task.
	grunt.registerTask('cleantemplate', ['clean:css', 'clean:js']);
	grunt.registerTask('firststart', ['copy']);

	// define default task
	grunt.registerTask('startwatch', ["browserSync", "watch"]);

	grunt.registerTask('commonjs', 'Generate CommonJS entrypoint module in dist dir.', function () {
		var srcFiles = grunt.config.get('concat.theme.src');
		var destFilepath = './js/npm.js';
		generateCommonJSModule(grunt, srcFiles, destFilepath);
	});
};
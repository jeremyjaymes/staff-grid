module.exports = function(grunt) {
  require('jit-grunt')(grunt);

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      css: {
        files: ['css/*.css'],
        tasks: ['cssmin']
      },
      scripts: {
        files: ['js/team-grid.js'],
        tasks:  ['uglify']
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      dist: {
        files: {
          'js/team-grid.min.js' : ['js/team-grid.js'],
        }
      }
    },
    cssmin: {
      options: {
        shorthandCompacting: false,
        roundingPrecision: -1
      },
      target: {
        files: {
          'css/team-grid.min.css': ['css/team-grid.css']
        }
      }
    }
  });

  // Default task(s).
  grunt.registerTask('default', ['watch']);

};
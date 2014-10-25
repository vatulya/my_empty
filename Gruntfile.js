module.exports = function (grunt) {

    grunt.initConfig({
//        concat: {
//
//        },
//        uglify: {
//
//        },
//        jshint: {
//
//        },
        less: {
            development: {
                options: {
                    paths: ['public/css']
                },
                files: {
                    "public/css/common.css": "public/css/common.less"
                }
            },
            production: {
                options: {
                    paths: ['public/css']
                },
                files: {
                    "public/css/common.css": "public/css/common.less"
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');

    grunt.registerTask('development', ['less:development']);
    grunt.registerTask('production', ['less:production']);
    grunt.registerTask('default', ['development']);

};

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
                files: {
                    "public/css/common.css": "public/less/common.less"
                }
            },
            production: {
                files: {
                    "public/css/common.css": "public/less/common.less"
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');

    grunt.registerTask('development', ['less:development']);
    grunt.registerTask('production', ['less:production']);
    grunt.registerTask('default', ['development']);

};

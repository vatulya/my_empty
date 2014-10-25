module.exports = function (grunt) {

    grunt.initConfig({
        less: {
            development: {
                files: {
                    "public/css/pages/index__common.css": "public/less/pages/index/common.less"
                }
            },
            production: {
                files: {
                    "public/css/pages/index__common.css": "public/less/pages/index/common.less"
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-less');

    grunt.registerTask('development', ['less:development']);
    grunt.registerTask('production', ['less:production']);
    grunt.registerTask('default', ['development']);

};

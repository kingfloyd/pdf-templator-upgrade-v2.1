$(function($){
    var namespace;
    namespace = {
        something : function() {
            console.log("this is something function");
        },
        bodyInfo : function() {
            console.log("this is the body info");
        }
    };
    window.ns = namespace;
});




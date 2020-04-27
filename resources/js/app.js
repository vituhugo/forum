/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

require('jquery');
require('jquery.transit');
require('bootstrap');

require('slick-slider');

$('.user-warnings').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1
});

var background = {}

background.initializr = function (){

    var $this = this;



    //option
    $this.id = "background_css3";
    $this.style = {bubbles_color:"#fff",stroke_width:0, stroke_color :"black"};
    $this.bubbles_number = 80;
    $this.speed = [1500,8000]; //milliseconds
    $this.max_bubbles_height = $this.height;
    $this.shape = false // 1 : circle | 2 : triangle | 3 : rect | false :random

    if($("#"+$this.id).lenght > 0){
        $("#"+$this.id).remove();
    }
    $this.object = $("<div style='z-inde:-1;margin:0;opacity:0.5;padding:0; overflow:hidden;position:absolute;bottom:0' id='"+$this.id+"'> </div>'").appendTo(".banner-animate");

    $this.ww = $(window).width()
    $this.wh = $(window).height()
    $this.width = $this.object.width($this.ww);
    $this.height = $this.object.height($this.wh);


    $(".banner-animate").prepend("<style>.shape_background {transform-origin:center; width:20px; height:20px; background: "+$this.style.bubbles_color+"; position: absolute; z-index: 0}</style>");


    for (i = 0; i < $this.bubbles_number; i++) {
        $this.generate_bubbles()
    }

}





background.generate_bubbles = function() {
    var $this = this;
    var base = $("<div class='shape_background'></div>");
    var shape_type = $this.shape ? $this.shape : Math.floor($this.rn(1,3));
    if(shape_type == 1) {
        var bolla = base.css({borderRadius: "50%"})
    }else if (shape_type == 2){
        var bolla = base.css({width:0, height:0, "border-style":"solid","border-width":"0 40px 69.3px 40px","border-color":"transparent transparent "+$this.style.bubbles_color+" transparent", background:"transparent"});
    }else{
        var bolla = base;
    }
    var rn_size = $this.rn(.8,1.2);

    bolla.css({"transform":"scale("+rn_size+") rotate("+$this.rn(-360,360)+"deg)", top:$this.wh+30, left:$this.rn(-12, $this.ww+20)});
    bolla.appendTo($this.object);
    bolla.transit({top: $this.rn($this.wh/2,$this.wh/2-30), "transform":"scale("+rn_size+") rotate("+$this.rn(-360,360)+"deg)", opacity: 0},$this.rn($this.speed[0],$this.speed[1]), function(){
        $(this).remove();
        $this.generate_bubbles();
    })

}


background.rn = function(from, to, arr) {
    if(arr){
        return Math.random() * (to - from + 1) + from;
    }else{
        return Math.floor(Math.random() * (to - from + 1) + from);
    }
}
background.initializr()

$('[data-href]').click(function(event) {
    window.location = this.getAttribute('data-href');
})

window.SimpleMDE = require('simplemde');
// var simplemde = new SimpleMDE({element: $(".markdown-editor")});

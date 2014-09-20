(function($){
    var sb_option = $("div.sb-option"),
        option_form = $("#sb-options-form");

    (function(){
        $("div.sb-option .section-item > a").on("click", function(){
            var that = $(this);
            if(that.parent().hasClass("active")) {
                return false;
            }
        });
    })();

    (function(){
        if(!option_form.find("h3.setting-title").length && option_form.attr("data-page") != "sb-options") {
            option_form.css({"display": "none"});
        }
    })();

    (function(){
        setTimeout(function(){
            sb_option.find("div.updated").fadeOut(3000);
        }, 2000);
    })();

})(jQuery);
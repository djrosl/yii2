/**
 * Created by rosl on 19.10.16.
 */


(function(){
    $('.remove-audio').click(function(e){
        e.preventDefault();
        var that = this;
        $.get($(this).attr('href'), {}, function(r){
            console.log(r);
            $(that).parents('.audio-wrap').remove();
        });
    });
    $('.save-audio').click(function(e){
        e.preventDefault();
        var that = this;
        $.get($(this).attr('href')+'&name='+$(this).prev().val(), {}, function(r){
            console.log(r);
        });
    });
})($);
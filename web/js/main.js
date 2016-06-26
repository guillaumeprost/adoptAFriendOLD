/**
 * Created by guillaumeprost on 25/06/2016.
 */

$( document ).ready(function() {
    if($(".skeu-input").val() != ''){
        $(".skeu-input").parent().addClass("skeu-filled");
    }
});


$(".skeu-input").focus(function(){
    $(this).parent().addClass("skeu-filled");
});

$(".skeu-input").focusout(function(){
    if($(this).val() === '')
        $(this).parent().removeClass("skeu-filled");
})

$("#demand-form").submit(function(e){
    e.preventDefault()
    $('.wrap').hide();
    $('.spinner').removeClass('hide');

    this.submit();
});
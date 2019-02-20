"use strict";
$(document).ready(function(){
    $('input[name="daterange"]').daterangepicker();
    $(function() {
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                language: "es",
                format: 'dd MM yyyy'
                //format: 'DD d [del] MM yyyy'
            });
        });
    });

// Date-dropper js start

$("#dropper-default").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c"
    }),
$("#dropper-animation").dateDropper( {
        dropWidth: 200,
        init_animation: "bounce",
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c"
    }),
$("#dropper-format").dateDropper( {
        dropWidth: 200,
        format: "F S, Y",
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c"
    }),
$("#dropper-lang").dateDropper( {
        dropWidth: 200,
        format: "F S, Y",
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        lang: "ar"
    }),
$("#dropper-lock").dateDropper( {
        dropWidth: 200,
        format: "F S, Y",
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        lock: "from"
    }),
$("#dropper-max-year").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        maxYear: "2020"
    }),
$("#dropper-min-year").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        minYear: "1990"
    }),
$("#year-range").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        yearsRange: "5"
    }),
$("#dropper-width").dateDropper( {
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        dropWidth: 500
    }),
$("#dropper-dangercolor").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#e74c3c",
        dropBorder: "1px solid #e74c3c",
    }),
$("#dropper-backcolor").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        dropBackgroundColor: "#bdc3c7"
    }),
$("#dropper-txtcolor").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#46627f",
        dropBorder: "1px solid #46627f",
        dropTextColor: "#FFF",
        dropBackgroundColor: "#e74c3c"
    }),
$("#dropper-radius").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        dropBorderRadius: "0"
    }),
$("#dropper-border").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "2px solid #1abc9c"
    }),
$("#dropper-shadow").dateDropper( {
        dropWidth: 200,
        dropPrimaryColor: "#1abc9c",
        dropBorder: "1px solid #1abc9c",
        dropBorderRadius: "20px",
        dropShadow: "0 0 20px 0 rgba(26, 188, 156, 0.6)"
    })
// Date-dropper js end

// Color picker js start
function change_checkbox_color() {
    $('.color-box .show-box').on('click', function() {
        $(".color-box").toggleClass("open");
    });

    $('.colors-list a').on('click', function() {
        var curr_color = $('main').data('checkbox-color');
        var color = $(this).data('checkbox-color');
        var new_colot = 'checkbox-' + color;

        $('.rkmd-checkbox .input-checkbox').each(function(i, v) {
            var findColor = $(this).hasClass(curr_color);

            if (findColor) {
                $(this).removeClass(curr_color);
                $(this).addClass(new_colot);
            }

            $('main').data('checkbox-color', new_colot);

        });
    });
}
// Color picker
$("#custom").spectrum({
    color: "#f00"
});
$("#flat").spectrum({
    flat: true,
    showInput: true
});
$("#flatClearable").spectrum({
    flat: true,
    showInput: true,
    allowEmpty: true
});
// Color picker js end

// Mini-color js start
$('.demo').each( function() {
                //
                // Dear reader, it's actually very easy to initialize MiniColors. For example:
                //
                //  $(selector).minicolors();
                //
                // The way I've done it below is just for the demo, so don't get confused
                // by it. Also, data- attributes aren't supported at this time...they're
                // only used for this demo.
                //
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    format: $(this).attr('data-format') || 'hex',
                    keywords: $(this).attr('data-keywords') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom left',
                    swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
                    change: function(value, opacity) {
                        if( !value ) return;
                        if( opacity ) value += ', ' + opacity;
                        if( typeof console === 'object' ) {
                            console.log(value);
                        }
                    },
                    theme: 'bootstrap'
                });

            });
// Mini-color js ends
});

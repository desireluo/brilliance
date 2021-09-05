(function( $ ){

    var methods = {
        init : function( options ) {
            // 这
        },
        show : function( ) {
            // 很
        },
        hide : function( ) {
            // 好
        },
        update : function( ...content ) {
            // !!!

            console.log(content.join(','));
        }
    };

    $.fn.tooltip = function( method ) {

        // console.log(arguments);

        // console.log(Array.prototype.slice.call( arguments, 1 ));
        // Method calling logic
        if ( methods[method] ) {
            console.log('>', Array.prototype.slice.call( arguments, 1 ));

            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.tooltip' );
        }

    };

})( jQuery );

// 调用  init 方法
$('div').tooltip();

// 调用  init 方法
$('div').tooltip({
    foo : 'bar'
});

// 调用 hide 方法
    $('div').tooltip('hide');

// 调用 update 方法
    $('div').tooltip('update', 'This is the new tooltip content!','hello world');

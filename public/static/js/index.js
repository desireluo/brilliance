(function( $ ){

    $.fn.maxHeight = function() {

        var max = 0;

        this.each(function() {
            max = Math.max( max, $(this).height() );

            console.log($(this).height());

        });

        return max;
    };
})( jQuery );

var tallest = $('div').maxHeight(); // 返回最高 div 的高度
console.log(tallest);

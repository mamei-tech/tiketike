/**
 * Created by deux on 23/04/2016.
 */
$('document').ready(function () {

    $('.chart').easyPieChart({
        easing: 'easeOutBounce',
        lineWidth: '8',
        barColor: '#70438F',
        trackColor:"transparent",
        scaleColor:"transparent",
        onStep: function (from, to, percent) {
            $(this.el).find('.percent').text(Math.round(percent));
        }
    });
    $('.chartB').easyPieChart({
        easing: 'easeOutBounce',
        lineWidth: '8',
        barColor: '#70438F',
        trackColor:"transparent",
        scaleColor:"transparent",
        onStep: function (from, to, percent) {
            $(this.el).find('.percent').text(Math.round(percent));
        }
    });

    $('.chart-porciento').easyPieChart({
        easing: 'easeOutBounce',
        lineWidth: '10',
        barColor: '#70438F',
        trackColor:"transparent",
        scaleColor:"transparent",
    });

    $('.chart-porcientoB').easyPieChart({
        easing: 'easeOutBounce',
        lineWidth: '10',
        barColor: '#ffffff',
        trackColor:"transparent",
        scaleColor:"transparent",
    });

});


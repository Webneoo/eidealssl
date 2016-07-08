$(function() {




    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Elie',
            a: 100,
            b: 90
        }, {
            y: 'Rhea',
            a: 75,
            b: 65
        }, {
            y: 'Dany',
            a: 50,
            b: 40
        }, {
            y: 'Jihane',
            a: 75,
            b: 65
        }, {
            y: 'Rabih',
            a: 50,
            b: 40
        }, {
            y: 'Nathalie',
            a: 75,
            b: 65
        }, {
            y: 'May',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});

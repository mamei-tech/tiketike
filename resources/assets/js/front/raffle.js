import axios from 'axios';





/* On ready */
$(document).ready(function () {


    var clipboard = new ClipboardJS('.btncopy');

    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });


    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    // $('#buyTickets').on('click',function (e) {
    //     e.preventDefault();
    //     var tickets = [];
    //     var count = 0;
    //     var raffle = $('input#raffle').val();
    //     var siChequeados = $('input:checkbox:checked').map(function() {
    //         return this.value;
    //     }).get();
    //     axios.post('/tiketike/public/raffles/'+raffle+'/tickets/buy',{
    //         'availabletickets': siChequeados
    //     }).then(function (response) {
    //         alert('Usted ha comprado los tickets '+tickets);
    //
    //     }).catch(function (error) {
    //         console.log(error);
    //     })
    // // });
    //
    //
    //
    // $('#buyTickets').on('click', function(e) {
    //     var siChequeados = $('input:checkbox:checked').map(function() {
    //         return this.value;
    //     }).get();
    //     var price = $('#raffleprice').html();
    //     var amountInCents = parseFloat(price).toFixed(2) * siChequeados.length * 100;
    //     var displayAmount = parseFloat(amountInCents/100).toFixed(2);
    //     // Open Checkout with further options
    //     handler.open({
    //         name: 'TikeTikes tickets buy',
    //         description: 'Tickets price ($' + displayAmount + ')',
    //         amount: amountInCents,
    //     });
    //     e.preventDefault();
    // });

    $('input.tickets').on('change',function () {
        var amount = $('#countTickets').html();
        var update = parseInt(amount) + 1;
        $('#countTickets').html(update);
    })
});

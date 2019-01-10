import axios from 'axios';

/* On ready */
$(document).ready(function () {
    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    $('#buyTickets').on('click',function (e) {
        e.preventDefault();
        var tickets = [];
        var count = 0;
        var raffle = $('input#raffle').val();
        var siChequeados = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        axios.post('/tiketike/public/raffles/'+raffle+'/tickets/buy',{
            'availabletickets': siChequeados
        }).then(function (response) {
            alert('Usted ha comprado los tickets '+tickets);

        }).catch(function (error) {
            console.log(error);
        })
    });

    $('input.tickets').on('change',function () {
        var amount = $('#countTickets').html();
        var update = parseInt(amount) + 1;
        $('#countTickets').html(update);
    })
});

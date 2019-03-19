// import axios from "axios";
//
// if ($('#mesiguen .active')){
//
//     $('#normalSlick-followers').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
//         var followerid = $("[data-slick-index='" + nextSlide + "'] .slick-list").attr('id');
//
//         console.log(followerid);
//
//         axios.post(route('get.user'), {
//             'userid': followerid
//
//         }).then(function (response) {
//             $('#name').html(response.data['name']);
//             $('#country').html(response.data['country']);
//             $('#created_raffles').html(response.data['created_raffles']);
//             $('#winned_raffles').html(response.data['winned_raffles']);
//             $('#sold_tickets').html(response.data['sold_tickets']);
//             $('#shared_raffles').html(response.data['shared_raffles']);
//             $('#link_to_profile').href = '';
//             $('#link_to_profile').attr('href', route('profile.info', {'userid' : followerid}));
//             $('.field-item .even');
//         }).catch(function (error) {
//             console.log(error);
//         })
//     });
//
//
//     $('#normalSlick-follows').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
//         var followid = $("[data-slick-index='" + nextSlide + "'] .slick-list").attr('id');
//
//         // console.log(followid);
//
//         axios.post(route('get.user'), {
//             'userid': followid
//
//         }).then(function (response) {
//             $('#name_follows').html(response.data['name']);
//             $('#country_follows').html(response.data['country']);
//             $('#created_raffles_follows').html(response.data['created_raffles']);
//             $('#winned_raffles_follows').html(response.data['winned_raffles']);
//             $('#sold_tickets_follows').html(response.data['sold_tickets']);
//             $('#shared_raffles_follows').html(response.data['shared_raffles']);
//             $('#link_to_profile_follows').href = '';
//             $('#link_to_profile_follows').attr('href', route('profile.info', {'userid' : followid}));
//             $('.field-item .even');
//         }).catch(function (error) {
//             console.log(error);
//         })
//     });


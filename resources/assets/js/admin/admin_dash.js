
/* Core Js */
require('../bootstrap');
require('./now-ui-dashboard');
require('../plugins/perfect-scrollbar.jquery.min');
require('../plugins/moment.min');

/* Custom Components */
require('./component/navbar');
require('./component/messagebox_notifications');

/* Plugins */
/* Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc */
require('../plugins/jquery-jvectormap');
require('chart.js');
require('../plugins/jquery.dataTables.min');

/* Customs */
require('./views/admin/customadmin');
require('./groups');

/* do always this the lastone */
require('./boot');

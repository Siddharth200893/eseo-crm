 <footer class="footer">
     <div class="container-fluid">

         <div class="copytext_center">
             <p>@2023 All Rights Reserved</p>
         </div>
         <!-- <div class="row text-muted">
             <div class="col-6 text-start">
                 <p class="mb-0">
                     <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>ll</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a> &copy;
                 </p>
             </div>
             <div class="col-6 text-end">
                 <ul class="list-inline">
                     <li class="list-inline-item">
                         <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                     </li>
                     <li class="list-inline-item">
                         <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                     </li>
                     <li class="list-inline-item">
                         <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                     </li>
                     <li class="list-inline-item">
                         <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                     </li>
                 </ul>
             </div>
         </div> -->
     </div>
 </footer>
 </div>

 </div>


 <script src="<?= base_url(); ?>assets/js/app.js"></script>
 <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.21/sweetalert2.all.min.js" integrity="sha512-9pxXmgs5Ol+b8ko21zSalDCVBeUEeKXFqDt1oRHrZJ04WIjhLWsbXmS+0QogsYLnb7r/U9pZWULgZaqIGK/K1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script>
     function change_flag(status, id, el) {
         let url = `<?= base_url('manager/is-flag/') ?>${id}`;
         $.ajax({
             url: url,
             type: "get",
             success: function(response) {
                 if (response == 1) {
                     // alert('flagged successfully');
                     console.log(el.parentNode.parentNode);
                     $(el).html('<i class="fa fa-flag" aria-hidden="true"></i>');

                     $(el.parentNode.parentNode).addClass('highlight_flag');
                     // el.html();
                 } else if (response == 0) {
                     // alert(23);
                     $(el).html('<i class="fa fa-flag-o" aria-hidden="true"></i>');
                     $(el.parentNode.parentNode).removeClass('highlight_flag');

                 }
             },
             error: function(xhr, status, error) {
                 console.log(error);
             },
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
         });
     };
 </script>
 <script>
     function payemnt_approvel(payment, id, el) {
         if (payment === 0) {
             //  alert('Payment status is still pending');
             Swal.fire({
                 icon: 'error',
                 title: 'Oops...',
                 text: 'Payment status is still pending!',

             })
         } else {
             Swal.fire({
                 title: 'Are you sure?',
                 text: "You won't be able to revert this!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, approve this!'
             }).then((result) => {
                 if (result.isConfirmed) {
                     window.location.href = `<?= base_url('manager/approve-payment/') ?>${id}`
                     Swal.fire(
                         'Approved!',
                         'Payment has been approved.',
                         'success'
                     )

                 }
             })
         }
     }
 </script>

 <script>
     document.addEventListener("DOMContentLoaded", function() {
         var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
         var gradient = ctx.createLinearGradient(0, 0, 0, 225);
         gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
         gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
         // Line chart
         new Chart(document.getElementById("chartjs-dashboard-line"), {
             type: "line",
             data: {
                 labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                 datasets: [{
                     label: "Sales ($)",
                     fill: true,
                     backgroundColor: gradient,
                     borderColor: window.theme.primary,
                     data: [
                         2115,
                         1562,
                         1584,
                         1892,
                         1587,
                         1923,
                         2566,
                         2448,
                         2805,
                         3438,
                         2917,
                         3327
                     ]
                 }]
             },
             options: {
                 maintainAspectRatio: false,
                 legend: {
                     display: false
                 },
                 tooltips: {
                     intersect: false
                 },
                 hover: {
                     intersect: true
                 },
                 plugins: {
                     filler: {
                         propagate: false
                     }
                 },
                 scales: {
                     xAxes: [{
                         reverse: true,
                         gridLines: {
                             color: "rgba(0,0,0,0.0)"
                         }
                     }],
                     yAxes: [{
                         ticks: {
                             stepSize: 1000
                         },
                         display: true,
                         borderDash: [3, 3],
                         gridLines: {
                             color: "rgba(0,0,0,0.0)"
                         }
                     }]
                 }
             }
         });
     });
 </script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         // Pie chart
         new Chart(document.getElementById("chartjs-dashboard-pie"), {
             type: "pie",
             data: {
                 labels: ["Chrome", "Firefox", "IE"],
                 datasets: [{
                     data: [4306, 3801, 1689],
                     backgroundColor: [
                         window.theme.primary,
                         window.theme.warning,
                         window.theme.danger
                     ],
                     borderWidth: 5
                 }]
             },
             options: {
                 responsive: !window.MSInputMethodContext,
                 maintainAspectRatio: false,
                 legend: {
                     display: false
                 },
                 cutoutPercentage: 75
             }
         });
     });
 </script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         // Bar chart
         new Chart(document.getElementById("chartjs-dashboard-bar"), {
             type: "bar",
             data: {
                 labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                 datasets: [{
                     label: "This year",
                     backgroundColor: window.theme.primary,
                     borderColor: window.theme.primary,
                     hoverBackgroundColor: window.theme.primary,
                     hoverBorderColor: window.theme.primary,
                     data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                     barPercentage: .75,
                     categoryPercentage: .5
                 }]
             },
             options: {
                 maintainAspectRatio: false,
                 legend: {
                     display: false
                 },
                 scales: {
                     yAxes: [{
                         gridLines: {
                             display: false
                         },
                         stacked: false,
                         ticks: {
                             stepSize: 20
                         }
                     }],
                     xAxes: [{
                         stacked: false,
                         gridLines: {
                             color: "transparent"
                         }
                     }]
                 }
             }
         });
     });
 </script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         var markers = [{
                 coords: [31.230391, 121.473701],
                 name: "Shanghai"
             },
             {
                 coords: [28.704060, 77.102493],
                 name: "Delhi"
             },
             {
                 coords: [6.524379, 3.379206],
                 name: "Lagos"
             },
             {
                 coords: [35.689487, 139.691711],
                 name: "Tokyo"
             },
             {
                 coords: [23.129110, 113.264381],
                 name: "Guangzhou"
             },
             {
                 coords: [40.7127837, -74.0059413],
                 name: "New York"
             },
             {
                 coords: [34.052235, -118.243683],
                 name: "Los Angeles"
             },
             {
                 coords: [41.878113, -87.629799],
                 name: "Chicago"
             },
             {
                 coords: [51.507351, -0.127758],
                 name: "London"
             },
             {
                 coords: [40.416775, -3.703790],
                 name: "Madrid "
             }
         ];
         var map = new jsVectorMap({
             map: "world",
             selector: "#world_map",
             zoomButtons: true,
             markers: markers,
             markerStyle: {
                 initial: {
                     r: 9,
                     strokeWidth: 7,
                     stokeOpacity: .4,
                     fill: window.theme.primary
                 },
                 hover: {
                     fill: window.theme.primary,
                     stroke: window.theme.primary
                 }
             },
             zoomOnScroll: false
         });
         window.addEventListener("resize", () => {
             map.updateSize();
         });
     });
 </script>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
         var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
         document.getElementById("datetimepicker-dashboard").flatpickr({
             inline: true,
             prevArrow: "<span title=\"Previous month\">&laquo;</span>",
             nextArrow: "<span title=\"Next month\">&raquo;</span>",
             defaultDate: defaultDate
         });
     });
 </script>
 <script>
     $(document).ready(function() {
         //  alert(1);
         $('.focus').focus();

     })
 </script>
 <script>
     $(document).ready(function() {
         var currentUrl = window.location.href;
         var paymentMode = currentUrl.substr(-4) === 'mode' ? 'active' : '';
         var currency = currentUrl.substr(-8) === 'currency' ? 'active' : '';

         if (paymentMode === "active" || currency === "active") {
             //  console.log('yes');
             $('.sidebar-link').attr('aria-expanded', 'true');
             $('.sidebar-link').removeClass('collapsed');
             $('#collapseExample').addClass('show');
         }
     })
 </script>
 <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/daterangepicker.js"></script>
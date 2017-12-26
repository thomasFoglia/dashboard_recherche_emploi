<!-- Bootstrap core JavaScript-->
<script src="public/vendor/jquery/jquery.min.js"></script>
<script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<!-- <script src="public/vendor/chart.js/Chart.min.js"></script> -->
<script src="public/vendor/datatables/jquery.dataTables.js"></script>
<script src="public/vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="public/js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<script src="public/js/sb-admin-datatables.js"></script>
<!-- <script src="public/js/sb-admin-charts.min.js"></script> -->
<script>

$(document).ready(function() {

  // get GET parameter
  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
      }
    }
  };

  var name_added = getUrlParameter('name_added');
  if (typeof(name_added) !== "undefined") {
    $('#alertTop .text').html("<strong>" + name_added + "</strong> a été ajouté.");
    $('#alertTop').show();
  }


  $(".btn_rappel").on('click', function() {
    var id_to_update = $(this).parent().parent().find('.id_to_update').text();

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10) {
      dd = '0'+dd
    }
    if(mm<10) {
      mm = '0'+mm
    }
    today = yyyy + '/' + mm + '/' + dd;

    $.ajax({
      url: 'ajax/updateRappel.php',
      type: 'POST',
      data: jQuery.param({id: id_to_update, rappel: today}),
      contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
      success: function (response) {
        location.reload();
      }
    });
  });

  $(".btn_reponse").on('change', function() {
    if (this.value == "non") {
      var id_to_update = $(this).parent().parent().find('.id_to_update').text();
      var rep = this.value;

      $.ajax({
        url: 'ajax/updateReponse.php',
        type: 'POST',
        data: jQuery.param({id: id_to_update, reponse: rep}),
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function (response) {
          location.reload();
        }
      });
    }
  });

});
</script>

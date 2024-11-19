(function($) {
  'use strict';
  $(function() {
    $('#order-listing').DataTable({
      "aLengthMenu": [
        [15, 50, 100, 250, -1],
        [15, 50, 100, 250, "Tous"]
      ],
      "iDisplayLength": 15,
      "language": {
        search: ""
      }
    });
    $('#order-listing').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Rechercher');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      //var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      //length_sel.removeClass('form-control-sm');
    });
  });
})(jQuery);

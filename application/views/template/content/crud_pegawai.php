<!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Pegawai</h1>
          <p class="mb-4">Data Pegawai menggunakan Bootstrap-Table.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <span class="float-left">
              <h6 class="m-0 font-weight-bold text-primary text-left">List Data Pegawai</h6>
             </span>
              
            </div>
            <div class="card-body">
              <span class=""><a class="btn btn-info" href="<?php echo site_url('crud/tambah');?>"><i class="fa fa-add"></i> Tambah Data</a></span>
              <div class="table-responsive">
                <table class="table table-bordered" id="list" width="100%" cellspacing="0"
                  data-toggle="table" 
              data-show-columns="true"  
              data-locale="en-US"
              data-show-refresh="false"
              data-show-toggle="true"
              data-show-fullscreen="true"
              data-show-columns-toggle-all="true"
              data-detail-view="false"
              data-show-export="true"
              data-export-data-type="all"
              data-export-types ="['doc','xml','csv','json','png']"
              data-click-to-select="true"
              data-detail-formatter="detailFormatter"
              data-minimum-count-columns="2"
              data-show-pagination-switch="true"
              data-id-field="id"
              data-page-size="10"
              data-page-list="[10, 25, 50, 100, 500, all]"
              data-show-footer="true"
              data-ajax="ajaxRequest"
              data-search="true"
              data-search-on-enter-key="true"
              data-side-pagination="server"
              data-pagination="true"
              data-query-params="queryParams"
              data-show-jump-to="true">
                  <thead>
                    <tr>
                    <th data-field="id"><i class="icon_profile"></i> ID</th>
                    <th data-field="nama"><i class="icon_profile"></i> Nama</th>
                    <th data-field="tempat_lahir"><i class="icon_calendar"></i> Tempat Lahir</th>
                    <th data-field="tanggal_lahir"><i class="icon_mail_alt"></i> Tanggal Lahir</th>
                    <th data-field="alamat"><i class="icon_pin_alt"></i> Alamat</th>
                    <th data-field="telepon"><i class="icon_mobile"></i> Telepon</th>
                    <th data-field="email"><i class="icon_mail"></i> Email</th>
                    <th data-field="action"><i class="icon_cogs"></i> Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>

<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/page-jump-to/bootstrap-table-page-jump-to.min.css" rel="stylesheet">
<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table-locale-all.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/page-jump-to/bootstrap-table-page-jump-to.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>

<script>

    var $table = $('#list');
    var saved_page = 1, saved_size = 10, saved_search = "";

    function queryParams(params) {
      return params
    }

    function ajaxRequest(params) {

      var limit = parseInt(params.data.limit);
      var offset = parseInt(params.data.offset);
      var page = offset >= limit ? (offset/limit)+1: 1;
      params.data.page = page;

      localStorage.setItem('summary_datatable', JSON.stringify(params.data))
      var url = '<?php echo site_url('crud/data') ?>'
      $.get(url + '?' + $.param(params.data)).then(function (res) {
        params.success(res)
      })
    }
    function doSearch() {
      $table.bootstrapTable('refresh');
    }

    window.onload = function () {
      var saved_summary_datatable = localStorage.getItem('summary_datatable');
      
      if ( typeof saved_summary_datatable === "string" && saved_summary_datatable !== null ) {
        saved_summary_datatable = JSON.parse(saved_summary_datatable);
        saved_page = (saved_summary_datatable.page || 1);
        saved_size = (saved_summary_datatable.limit || 10);
        saved_search = (saved_summary_datatable.search || "");
      }

      $table.attr("data-page-number", saved_page)
      $table.attr("data-page-size", saved_size)
      $table.attr("data-search-text", saved_search)
    }
 
    </script>
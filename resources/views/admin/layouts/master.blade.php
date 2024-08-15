<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Painel Administrativo &mdash; Murilo Nascimento</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">

  <!-- CSS Datatable -->
  <link rel="stylesheet" href="//cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap5.css">

  <!-- CSS Toastr -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">

  <!-- Icones -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-iconpicker.min.css') }}">

<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <!-- INICIO NAVBAR -->
      @include('admin.layouts.navbar')
      <!-- FIM NAVBAR -->
      <!-- INICIO SIDEBAR -->
      @include('admin.layouts.sidebar')
      <!-- FIM SIDEBAR -->
      <!-- INICIO MAIN CONTENT -->
      <div class="main-content">
        @yield('content')
      </div>
      <!-- FIM MAIN CONTENT -->
      <!-- INICIO FOOTER -->
      <footer class="main-footer d-flex justify-content-center">
        <div class="footer-left">
          Todos os direitos reservados &copy; <?= date('Y') ?>
        </div>
      </footer>
      <!-- FIM FOOTER -->
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

  <!-- JS Datatable -->
  <script src="//cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap5.js"></script>

  <!-- JS Sweet -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- JS Toastr -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Icones -->
  <script src="{{ asset('backend/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('backend/assets/js/page/index-0.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

  <script>
    $(document).ready(function(){
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });

      $('body').on('click', '.delete-item', function(event){
        event.preventDefault();

        let deleteUrl = $(this).attr('href');

        Swal.fire({
          title: "Tem certeza?",
          text: "Você não poderá reverter isso!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sim, excluir"
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: 'DELETE',
              url: deleteUrl,
              success: function(data){
                if(data.status == 'success'){

                  Swal.fire({
                  title: "Excluído!",
                  text: "Seu arquivo foi excluído com sucesso!",
                  icon: "success"
                  });

                  window.location.reload();
                }
              },
              error: function(xhr, status, error){
                console.log(error);
              }
            })
          }
        });
      })
    });
/*    document.addEventListener('DOMContentLoaded', () => {
      const getCSRFToken = () => {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      }

      const modalDelete = () => {
        const deleteItems = document.querySelectorAll('.delete-item');
        console.log('Itens encontrados:', deleteItems.length);
        deleteItems.forEach(item => {
          item.addEventListener('click', (event) => {
            console.log('clicou');
            event.preventDefault();

            let url = item.getAttribute('href');

            Swal.fire({
              title: "Tem certeza?",
              text: "Você não poderá reverter essa ação!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Sim, excluir"
            }).then((result) => {
              if (result.isConfirmed) {
                fetch(url, {
                  method: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': getCSRFToken(),
                    'Content-Type': 'application/json'
                  }
                }).then(response =>
                  response.json()
                ).then(data => {
                  if (data.status === 'success') {
                    Swal.fire({
                      title: "Excluído!",
                      text: "Seu arquivo foi excluído com sucesso.",
                      icon: "success"
                    }).then(() => {
                      window.location.reload();
                    });
                  } else {
                    Swal.fire({
                      title: "Erro!",
                      text: data.message || "Erro ao excluir.",
                      icon: "error"
                    })
                  }
                });
              }
            }).catch(error => {
              Swal.fire({
                title: "Erro!",
                text: "Erro ao excluir.",
                icon: "error"
              });
            });
          });
        });
      }

      modalDelete();
    }); */
  </script>
  @stack('scripts')
</body>
</html>

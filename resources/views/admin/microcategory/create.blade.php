@extends('admin.layouts.master')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Cadastro de Microcategoria</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="{{ route('admin.dashboard') }}">
            Painel
          </a>
        </div>
        <div class="breadcrumb-item active">
          <a href="{{ route('microcategory.index') }}">
            Listar
          </a>
        </div>
        <div class="breadcrumb-item">Criar</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Criar Microcategoria</h4>
              <div class="card-header-action">
                <a
                  href=""
                  class="btn btn-primary"
                >
                  Ajuda
                </a>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('microcategory.store') }}" method="POST"
                enctype="multipart/form-data"
              >
                @csrf
                <div class="form-group">
                  <label>Categoria</label>
                  <select name="category_id" class="form-control category">
                    <option>Selecione</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Subcategoria</label>
                  <select name="subcategory_id" class="form-control subcategory">
                    <option value="">Selecione</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" name="name"
                    placeholder="Nome da Microcategoria" class="form-control"
                  >
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">
                  Salvar
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <script>
    $(document).ready(function () {
      $('body').on('change', '.category', function (m) {
        // alert('OK');
        let id = $(this).val();
        $.ajax({
          method: 'GET',
          url: "{{ route('admin.microcategory.get-subcategories') }}",
          data: {
            id: id,
          },
          success: function (data) {
            $('.subcategory').html(`<option value="">Selecione</option>`);
            $.each(data, function (i, item) {
              $('.subcategory').append(`
                <option value="${item.id}">${item.name}</option>
              `);
            });
          },
          error: function (xhr, status, error) {
            console.log(error);
          },
        });
      });
    });
  </script>
@endpush

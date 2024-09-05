@extends('admin.layouts.master')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Editar Subcategoria</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="{{ route('admin.dashboard') }}">
            Painel
          </a>
        </div>
        <div class="breadcrumb-item active">
          <a href="{{ route('subcategory.index') }}">
            Listar
          </a>
        </div>
        <div class="breadcrumb-item">Editar</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar</h4>
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
              <form action="{{ route('subcategory.update', $category->id) }}" method="POST"
                enctype="multipart/form-data"
              >
                @csrf
                @method('PUT')
                </div>
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" name="name" placeholder="Nome da Categoria"
                    class="form-control" value="{{ old('name', $category->name) }}"
                  >
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option
                      value="1"
                      {{ $category->status == 1 ? 'selected' : null }}
                    >
                      Ativo
                    </option>
                    <option
                      value="0"
                      {{ $category->status == 0 ? 'selected' : null }}
                    >
                      Inativo
                    </option>
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
@extends('admin.layouts.master')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Cadastro de Subcategoria</h1>
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
        <div class="breadcrumb-item">Criar</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Criar Subcategoria</h4>
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
              <form action="{{ route('subcategory.store') }}" method="POST"
                enctype="multipart/form-data"
              >
                @csrf
                <div class="form-group">
                  <label>Categoria</label>
                  <select name="category_id" class="form-control">
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" name="name"
                    placeholder="Nome da Subcategoria" class="form-control"
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

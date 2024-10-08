@extends('admin.layouts.master')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Cadastro de Categoria</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="{{ route('admin.dashboard') }}">
            Painel
          </a>
        </div>
        <div class="breadcrumb-item active">
          <a href="{{ route('category.index') }}">
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
              <h4>Criar Categoria</h4>
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
              <form action="{{ route('category.store') }}" method="POST"
                enctype="multipart/form-data"
              >
                @csrf
                <div class="form-group">
                  <div>
                    <button class="btn btn-primary" data-selected-class="btn-danger"
                      data-unselected-class="btn-primary" data-iconset="fontawesome5"
                      data-icon="fas fa-award" role="iconpicker" data-rows="5"
                      data-cols="7" name="icon"
                    ></button>
                  </div>
                </div>
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" name="name" placeholder="Nome da Categoria"
                    class="form-control"
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

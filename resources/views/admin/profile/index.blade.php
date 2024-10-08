@extends('admin.layouts.master')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Meus dados</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="{{ route('admin.dashboard') }}">Painel</a>
        </div>
        <div class="breadcrumb-item">Perfil</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
            <form action="{{ route('admin.profile.update') }}" method="POST"
              class="needs-validation" novalidate="" enctype="multipart/form-data"
            >
              @csrf
              <div class="card-header">
                <h4>Editar Perfil</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-12">
                    <label>Foto de Perfil</label>
                    @if (Auth::user()->image !== null)
                      <img src="{{ asset(Auth::user()->image) }}"
                        alt="{{ Auth::user()->name }}"
                        class="img-thumbnail mb-3 w-25 h-auto d-block object-fit-cover rounded-circle"
                      >
                    @else
                      <img src="{{ asset('backend/assets/img/avatar/avatar-1.png') }}"
                        alt="{{ Auth::user()->name }}"
                        class="img-thumbnail mb-3 w-25 h-auto d-block object-fit-cover rounded-circle"
                      >
                    @endif
                    <input type="file" class="form-control" name="image">
                  </div>
                  <div class="form-group col-12">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="name"
                      value="{{ Auth::user()->name }}" required=""
                    >
                  </div>
                  <div class="form-group col-12">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email"
                      value="{{ Auth::user()->email }}" required=""
                    >
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
            <form action="{{ route('admin.profile.password') }}" method="POST"
              class="needs-validation" novalidate="" enctype="multipart/form-data"
            >
              @csrf
              <div class="card-header">
                <h4>Atualizar Senha</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-12">
                    <label>Senha Atual</label>
                    <input type="password" class="form-control"
                      name="current_password"
                    >
                  </div>
                  <div class="form-group col-12">
                    <label>Nova Senha</label>
                    <input type="password" class="form-control"
                      name="password"
                    >
                  </div>
                  <div class="form-group col-12">
                    <label>Confirme Nova Senha</label>
                    <input type="password" class="form-control"
                      name="password_confirmation"
                    >
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

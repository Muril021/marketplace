@extends('admin.layouts.master')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Editar Slide</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="{{ route('admin.dashboard') }}">
            Painel
          </a>
        </div>
        <div class="breadcrumb-item active">
          <a href="{{ route('slider.index') }}">
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
              <form action="{{ route('slider.update', $slider->id) }}"
                method="POST" enctype="multipart/form-data"
              >
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label>Capa</label>
                  <br>
                  <img src="{{ asset($slider->banner) }}"
                    alt="{{ $slider->title_one }}"
                    style="width:20%; height:auto;"
                  >
                </div>
                <div class="form-group">
                  <label>Imagem (1300x500px)</label>
                  <input type="file" name="banner" class="form-control">
                </div>
                <div class="form-group">
                  <label>Título 1</label>
                  <input type="text" name="title_one"
                    class="form-control"
                    value="{{ old('title_one', $slider->title_one) }}"
                  >
                </div>
                <div class="form-group">
                  <label>Título 2</label>
                  <input type="text" name="title_two"
                    class="form-control"
                    value="{{ old('title_two', $slider->title_two) }}"
                  >
                </div>
                <div class="form-group">
                  <label>Valor</label>
                  <input type="text" name="starting_price"
                    class="form-control"
                    value="{{ old('starting_price', $slider->starting_price) }}"
                  >
                </div>
                <div class="form-group">
                  <label>Link</label>
                  <input type="url" name="link"
                    class="form-control"
                    value="{{ old('link', $slider->link) }}"
                  >
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="1"
                      {{ $slider->status === 1 ? 'selected' : null }}
                    >
                      Ativo
                    </option>
                    <option value="0"
                    {{ $slider->status === 0 ? 'selected' : null }}
                    >
                      Inativo
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Ordem</label>
                  <input type="number" name="serial"
                    class="form-control"
                    value="{{ old('serial', $slider->serial) }}"
                  >
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

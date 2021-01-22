<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Пример CRUD-приложения на Laravel">
        
        <title>Пример CRUD-приложения на Laravel. Журналы</title>
        
        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


        
    </head>
    <body>
      <div class="container">
        <div class="py-5 text-center">
          <ul class="list-inline">
            <li class="list-inline-item"><a href="/">Главная</a></li>
            <li class="list-inline-item"><a href="/magazines">Журналы</a></li>
            <li class="list-inline-item"><a href="/authors">Авторы</a></li>
          </ul>
          <h2>Журналы</h2>
        </div>
        @if(session('status'))
        <div class="alert alert-success" role="alert">
        {{ session('status') }}
        </div>
        @endif
        <div class="row">
          <div class="col-md-8 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Список журналов</span>
              <span class="badge badge-secondary badge-pill">{{$magazines->count()}}</span>
            </h4>
            <ul class="list-group mb-3">
              @foreach ($magazines as $magazine)    
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">{{$magazine->name}}</h6>
                    <small>Дата выпуска: {{$magazine->issue_date ? $magazine->issue_date->format('d/m/Y') : '' }}</small><br>
                    @foreach ($magazine->authors as $author)
                    <small class="text-muted">{{$author->name}} {{$author->patronymic}} {{$author->surname}}</small><br>
                    @endforeach
                    <p>{{$magazine->short_description}}</p>   
                    <div style="margin-bottom: 10px;"><a class="btn btn-danger" href="/magazines/delete/{{$magazine->magazine_id}}" role="button">Удалить</a></div>
                    <div><a class="btn btn-primary" href="/magazines/edit/{{$magazine->magazine_id}}" role="button">Редактировать</a></div>
                  </div>
                    <span style="max-width: 30%;"><img class="w-100" src="{{'/storage/'.$magazine->image}}" /></span>
                </li>
              @endforeach
              
            </ul>            
          </div>
          <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Добавить журнал</h4>
            <form class="needs-validation" novalidate action="{{route('createMagazine')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name">Название <span class="text-muted">(Обязательное поле)</span></label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Название журнала не более 255 символов" value="{{ session('name') }}" required maxlength="255">
                  <div class="invalid-feedback">
                    Введите название журнала не более 255 символов
                  </div>
                </div>
                <div class="mb-3">
                  <label for="short_description">Короткое описание</label>
                  <input type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" placeholder="Короткое описание не более 500 символов" value="" maxlength="500">
                  <div class="invalid-feedback">
                    Введите корректное описание не более 500 символов
                  </div>
                </div>
              

              <div class="mb-3">
                <label for="image">Изображение <span class="text-muted">(jpg или png, не больше 2 Мб)</span></label>
                <div class="input-group">
                  <input type="file" accept=".png, .jpg, .jpeg" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                  <div class="invalid-feedback" style="width: 100%;">
                    Загрузите изображение jpg или png, не больше 2 Мб
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="issue_date">Дата выпуска журнала</label>
                <input type="date" class="form-control @error('issue_date') is-invalid @enderror"  id="issue_date" name="issue_date">
                <div class="invalid-feedback">
                  Введите корректную дату
                </div>
              </div>
                
              <div class="mb-3">
                  <label for="author">Автор(ы) журнала<span class="text-muted">(Обязательное поле)</span><br>
                  <span class="text-muted">(Выберите несколько авторов с нажатой клавишей CTRL или SHIFT)</span></label>
                  <select multiple class="custom-select d-block w-100 @error('authors') is-invalid @enderror" id="author" name="authors[]" required>
                    @foreach ($all_authors as $author)
                    <option value="{{$author->author_id}}">{{$author->surname}} {{$author->name}} {{$author->patronymic}} </option>
                    @endforeach                    
                  </select>
                  <div class="invalid-feedback">
                    Выберите хотя бы одного автора
                  </div>
                </div>  

              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Создать журнал</button>
            </form>
          </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
          <p class="mb-1">&copy; 2020 Magazines & Authors</p>
          <ul class="list-inline">
            <li class="list-inline-item"><a href="/">Главная</a></li>
            <li class="list-inline-item"><a href="/magazines">Журналы</a></li>
            <li class="list-inline-item"><a href="/authors">Авторы</a></li>
          </ul>
        </footer>
      </div>
      <script src="/js/jquery-3.5.1.min.js"></script>
      <script src="/js/bootstrap.bundle.min.js"></script>
      <script src="/js/form-validation.js"></script>      
    </body>
</html>

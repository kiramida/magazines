<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Пример CRUD-приложения на Laravel">
        
        <title>Пример CRUD-приложения на Laravel. Авторы</title>
        
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
          <h2>Авторы</h2>
        </div>
        @if(session('status'))
        <div class="alert alert-success" role="alert">
        {{ session('status') }}
        </div>
        @endif
        <div class="row">
          <div class="col-md-8 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Список авторов</span>
              <span class="badge badge-secondary badge-pill">{{$authors->count()}}</span>
            </h4>
            <ul class="list-group mb-3">
              @foreach ($authors as $author)    
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <form class="needs-validation" novalidate action="/authors/update/{{$author->author_id}}" method="POST">
                        @csrf
                      <div class="mb-3">
                        <input type="text" class="form-control @error('surname.'.($author->author_id)) is-invalid @enderror" name="surname[{{$author->author_id}}]" placeholder="Фамилия автора" value="{{$author->surname}}" maxlength="255" minlength="3" required>
                        <div class="invalid-feedback">
                            Введите фамилию не меньше 3 и не более 255 символов
                        </div>
                      </div>
                      <div class="mb-3">  
                        <input type="text" class="form-control @error('name.'.($author->author_id)) is-invalid @enderror" name="name[{{$author->author_id}}]" placeholder="Имя автора" required maxlength="255" value="{{$author->name}}">
                        <div class="invalid-feedback">
                            Введите имя не более 255 символов
                        </div>
                      </div>
                      <div class="mb-3">
                        <input type="text" class="form-control @error('patronymic.'.($author->author_id)) is-invalid @enderror" name="patronymic[{{$author->author_id}}]" placeholder="Отчество автора" value="{{$author->patronymic}}" maxlength="255">
                        <div class="invalid-feedback">
                            Введите отчество не более 255 символов
                        </div>
                      </div>
                        <br><button class="btn btn-primary btn-sm" type="submit" style="margin-top: 10px;">Редактировать автора</button>
                    </form>
                    <div style="margin: 10px 0 10px 0;"><a class="btn btn-danger btn-sm" href="/authors/delete/{{$author->author_id}}" role="button">Удалить автора</a></div>                    
                    <h6>Список журналов автора:</h6>
                    @foreach ($author->magazines as $magazine)
                        <h7 class="my-0">{{$magazine->name}}</h7>
                        <div style="max-width: 30%;"><img class="w-100" src="{{'/storage/'.$magazine->image}}" /></div>
                        <small>Дата выпуска: {{$magazine->issue_date ? $magazine->issue_date->format('d/m/Y') : '' }}</small><br>
                        @foreach ($magazine->authors as $author)
                            <small class="text-muted">{{$author->name}} {{$author->patronymic}} {{$author->surname}}</small><br>
                        @endforeach
                        <p>{{$magazine->short_description}}</p> 
                    @endforeach
                  </div>
                    
                </li>
              @endforeach
              
            </ul>            
          </div>
          <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Добавить автора</h4>
            <form class="needs-validation" novalidate action="{{route('createAuthor')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="name">Имя <span class="text-muted">(Обязательное поле)</span></label>
                  <input type="text" class="form-control @error('name.new') is-invalid @enderror" id="name" name="name[new]" placeholder="Имя автора" required maxlength="255">
                  <div class="invalid-feedback">
                    Введите имя не более 255 символов
                  </div>
                </div>
                <div class="mb-3">
                  <label for="short_description">Отчество</label>
                  <input type="text" class="form-control @error('patronymic.new') is-invalid @enderror" id="patronymic" name="patronymic[new]" placeholder="Отчество автора" value="" maxlength="255">
                  <div class="invalid-feedback">
                    Введите отчество не более 255 символов
                  </div>
                </div>
                <div class="mb-3">
                  <label for="surname">Фамилия</label>
                  <input type="text" class="form-control @error('surname.new') is-invalid @enderror" id="surname" name="surname[new]" placeholder="Фамилия автора" value="" maxlength="255" minlength="3" required>
                  <div class="invalid-feedback">
                    Введите фамилию не меньше 3 и не более 255 символов
                  </div>
                </div>

              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Создать автора</button>
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

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
        <div style="padding: 100px 15%;">
        <h4 class="mb-3">Редактировать журнал</h4>
            <form class="needs-validation" novalidate action="/magazines/update/{{ $magazine->magazine_id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name">Название <span class="text-muted">(Обязательное поле)</span></label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Название журнала не более 255 символов" value="{{ $magazine->name }}" required maxlength="255">
                  <div class="invalid-feedback">
                    Введите название журнала не более 255 символов
                  </div>
                </div>
                <div class="mb-3">
                  <label for="short_description">Короткое описание</label>
                  <input type="text" class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" placeholder="Короткое описание не более 500 символов" value="{{ $magazine->short_description }}" maxlength="500">
                  <div class="invalid-feedback">
                    Введите корректное описание не более 500 символов
                  </div>
                </div>
              

              <div class="mb-3">
                <label for="image">Изображение <span class="text-muted">(jpg или png, не больше 2 Мб):</span></label>
                <div class="text-muted">Если не выбрать файл и не ставить галочку, сохранится текущее изображение</div>
                <div class="input-group">
                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="withoutImage" value="yes">
                    <label class="form-check-label" for="exampleCheck1">Без картинки (картинка выбранная ниже не будет загружаться)</label>
                  </div>                    
                  <input type="file" accept=".png, .jpg, .jpeg" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                  <div class="invalid-feedback" style="width: 100%;">
                    Загрузите изображение jpg или png, не больше 2 Мб
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="issue_date">Дата выпуска журнала</label>
                <input type="date" class="form-control @error('issue_date') is-invalid @enderror"  id="issue_date" name="issue_date" value="{{ $magazine->issue_date ? $magazine->issue_date->format('Y-m-d') : '' }}">
                <div class="invalid-feedback">
                  Введите корректную дату
                </div>
              </div>
                
              <div class="mb-3">
                  <label for="author">Автор(ы) журнала<span class="text-muted">(Обязательное поле)</span><br>
                  <span class="text-muted">(Выберите несколько авторов с нажатой клавишей CTRL или SHIFT)</span></label>
                  <select multiple class="custom-select d-block w-100 @error('authors') is-invalid @enderror" id="author" name="authors[]" required>
                    @foreach ($all_authors as $author)
                    <option value="{{$author->author_id}}" @if($magazine->authors()->find($author->author_id)) selected @endif>{{$author->surname}} {{$author->name}} {{$author->patronymic}} </option>
                    @endforeach                    
                  </select>
                  <div class="invalid-feedback">
                    Выберите хотя бы одного автора
                  </div>
                </div>  

              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Редактировать журнал</button>
            </form>
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
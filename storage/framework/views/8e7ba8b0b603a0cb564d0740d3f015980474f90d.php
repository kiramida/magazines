<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
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
        <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
        <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-8 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Список журналов</span>
              <span class="badge badge-secondary badge-pill"><?php echo e($magazines->count()); ?></span>
            </h4>
            <ul class="list-group mb-3">
              <?php $__currentLoopData = $magazines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $magazine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0"><?php echo e($magazine->name); ?></h6>
                    <small>Дата выпуска: <?php echo e($magazine->issue_date ? $magazine->issue_date->format('d/m/Y') : ''); ?></small><br>
                    <?php $__currentLoopData = $magazine->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="text-muted"><?php echo e($author->name); ?> <?php echo e($author->patronymic); ?> <?php echo e($author->surname); ?></small><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($magazine->short_description); ?></p>   
                    <div style="margin-bottom: 10px;"><a class="btn btn-danger" href="/magazines/delete/<?php echo e($magazine->magazine_id); ?>" role="button">Удалить</a></div>
                    <div><a class="btn btn-primary" href="/magazines/edit/<?php echo e($magazine->magazine_id); ?>" role="button">Редактировать</a></div>
                  </div>
                    <span style="max-width: 30%;"><img class="w-100" src="<?php echo e('/storage/'.$magazine->image); ?>" /></span>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </ul>            
          </div>
          <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Добавить журнал</h4>
            <form class="needs-validation" novalidate action="<?php echo e(route('createMagazine')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="name">Название <span class="text-muted">(Обязательное поле)</span></label>
                  <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" placeholder="Название журнала не более 255 символов" value="<?php echo e(session('name')); ?>" required maxlength="255">
                  <div class="invalid-feedback">
                    Введите название журнала не более 255 символов
                  </div>
                </div>
                <div class="mb-3">
                  <label for="short_description">Короткое описание</label>
                  <input type="text" class="form-control <?php $__errorArgs = ['short_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="short_description" name="short_description" placeholder="Короткое описание не более 500 символов" value="" maxlength="500">
                  <div class="invalid-feedback">
                    Введите корректное описание не более 500 символов
                  </div>
                </div>
              

              <div class="mb-3">
                <label for="image">Изображение <span class="text-muted">(jpg или png, не больше 2 Мб)</span></label>
                <div class="input-group">
                  <input type="file" accept=".png, .jpg, .jpeg" class="form-control-file <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="image" name="image">
                  <div class="invalid-feedback" style="width: 100%;">
                    Загрузите изображение jpg или png, не больше 2 Мб
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="issue_date">Дата выпуска журнала</label>
                <input type="date" class="form-control <?php $__errorArgs = ['issue_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"  id="issue_date" name="issue_date">
                <div class="invalid-feedback">
                  Введите корректную дату
                </div>
              </div>
                
              <div class="mb-3">
                  <label for="author">Автор(ы) журнала<span class="text-muted">(Обязательное поле)</span><br>
                  <span class="text-muted">(Выберите несколько авторов с нажатой клавишей CTRL или SHIFT)</span></label>
                  <select multiple class="custom-select d-block w-100 <?php $__errorArgs = ['authors'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="author" name="authors[]" required>
                    <?php $__currentLoopData = $all_authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($author->author_id); ?>"><?php echo e($author->surname); ?> <?php echo e($author->name); ?> <?php echo e($author->patronymic); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
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
<?php /**PATH /var/www/www-root/data/www/magazines/resources/views/magazines.blade.php ENDPATH**/ ?>
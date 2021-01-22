<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
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
        <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
        <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-8 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Список авторов</span>
              <span class="badge badge-secondary badge-pill"><?php echo e($authors->count()); ?></span>
            </h4>
            <ul class="list-group mb-3">
              <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <form class="needs-validation" novalidate action="/authors/update/<?php echo e($author->author_id); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                      <div class="mb-3">
                        <input type="text" class="form-control <?php $__errorArgs = ['surname.'.($author->author_id)];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="surname[<?php echo e($author->author_id); ?>]" placeholder="Фамилия автора" value="<?php echo e($author->surname); ?>" maxlength="255" minlength="3" required>
                        <div class="invalid-feedback">
                            Введите фамилию не меньше 3 и не более 255 символов
                        </div>
                      </div>
                      <div class="mb-3">  
                        <input type="text" class="form-control <?php $__errorArgs = ['name.'.($author->author_id)];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name[<?php echo e($author->author_id); ?>]" placeholder="Имя автора" required maxlength="255" value="<?php echo e($author->name); ?>">
                        <div class="invalid-feedback">
                            Введите имя не более 255 символов
                        </div>
                      </div>
                      <div class="mb-3">
                        <input type="text" class="form-control <?php $__errorArgs = ['patronymic.'.($author->author_id)];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="patronymic[<?php echo e($author->author_id); ?>]" placeholder="Отчество автора" value="<?php echo e($author->patronymic); ?>" maxlength="255">
                        <div class="invalid-feedback">
                            Введите отчество не более 255 символов
                        </div>
                      </div>
                        <br><button class="btn btn-primary btn-sm" type="submit" style="margin-top: 10px;">Редактировать автора</button>
                    </form>
                    <div style="margin: 10px 0 10px 0;"><a class="btn btn-danger btn-sm" href="/authors/delete/<?php echo e($author->author_id); ?>" role="button">Удалить автора</a></div>                    
                    <h6>Список журналов автора:</h6>
                    <?php $__currentLoopData = $author->magazines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $magazine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h7 class="my-0"><?php echo e($magazine->name); ?></h7>
                        <div style="max-width: 30%;"><img class="w-100" src="<?php echo e('/storage/'.$magazine->image); ?>" /></div>
                        <small>Дата выпуска: <?php echo e($magazine->issue_date ? $magazine->issue_date->format('d/m/Y') : ''); ?></small><br>
                        <?php $__currentLoopData = $magazine->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <small class="text-muted"><?php echo e($author->name); ?> <?php echo e($author->patronymic); ?> <?php echo e($author->surname); ?></small><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($magazine->short_description); ?></p> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                    
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </ul>            
          </div>
          <div class="col-md-4 order-md-1">
            <h4 class="mb-3">Добавить автора</h4>
            <form class="needs-validation" novalidate action="<?php echo e(route('createAuthor')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                  <label for="name">Имя <span class="text-muted">(Обязательное поле)</span></label>
                  <input type="text" class="form-control <?php $__errorArgs = ['name.new'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name[new]" placeholder="Имя автора" required maxlength="255">
                  <div class="invalid-feedback">
                    Введите имя не более 255 символов
                  </div>
                </div>
                <div class="mb-3">
                  <label for="short_description">Отчество</label>
                  <input type="text" class="form-control <?php $__errorArgs = ['patronymic.new'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="patronymic" name="patronymic[new]" placeholder="Отчество автора" value="" maxlength="255">
                  <div class="invalid-feedback">
                    Введите отчество не более 255 символов
                  </div>
                </div>
                <div class="mb-3">
                  <label for="surname">Фамилия</label>
                  <input type="text" class="form-control <?php $__errorArgs = ['surname.new'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="surname" name="surname[new]" placeholder="Фамилия автора" value="" maxlength="255" minlength="3" required>
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
<?php /**PATH /var/www/www-root/data/www/magazines/resources/views/authors.blade.php ENDPATH**/ ?>
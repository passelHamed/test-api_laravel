<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .mail{
            background-color: #ffffff;
            border-color: #e8e5ef;
            border-radius: 2px;
            border-width: 1px;
            box-shadow: 0 2px 0 rgb(0 0 150 / 3%), 2px 4px 0 rgb(0 0 150 / 2%);
            margin: 0 auto;
            padding: 0;
            width: 570px;
            position: relative;
            max-width: 100vw;
            padding: 32px;
            border-collapse: separate;
            text-indent: initial;
            border-spacing: 2px;
        }
    </style>
</head>
<body style="background-color: #edf2f7">

    <div  class="mail">
        <h2 style="color: #3d4852;font-size: 18px;font-weight: bold;text-align: left;">New Posts In Website</h2>
        <br>
        <?php $__currentLoopData = $postsDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <h3 style="font-size: 16px;color:#718096">Title Post : <?php echo e($post['title']); ?></h3>
                <h4 style="font-size: 16px;color:#718096">Description Post : <?php echo e($post['description']); ?></h4>
            </div>
            <hr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\server\1-web devlopment\2-back_end\2-laravel\inisev_test\inisev_test\resources\views/mails/PostMail.blade.php ENDPATH**/ ?>
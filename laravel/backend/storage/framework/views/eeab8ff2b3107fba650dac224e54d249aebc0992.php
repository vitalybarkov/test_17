<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            table {
                margin: 0 10%;
            }

            th {
                text-align: left;
            }

            th, td {
                padding: .5em;
                vertical-align: top;
                color: #8E9A9E;
            }
        </style>
        <title>MAGICSTONE</title>
    </head>
    <body>
        <table>
            <tr>
                <th>id</th>
                <th>description</th>
                <th>completed</th>
            </th>
<?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($movie->id); ?></td>
                <td><?php echo e($movie->description); ?></td>
                <td><?php echo e($movie->completed); ?></td>
            </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\l_test\blog\resources\views/content.blade.php ENDPATH**/ ?>